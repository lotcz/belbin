/*
DROP DATABASE IF EXISTS belbin;
CREATE DATABASE belbin DEFAULT char set utf8;
USE belbin;
*/

/*
	now run zEngine.sql
*/

USE belbin;

create table `belbin_roles` (
       `belbin_role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_role_name` varchar(100),
       `belbin_role_color` varchar(20),
       `belbin_role_description` text,
       
       PRIMARY KEY (`belbin_role_id`)
) ENGINE=InnoDB;

create table `belbin_tests` (
  `belbin_test_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `belbin_test_customer_id` INT UNSIGNED NOT NULL,
  `belbin_test_start_date` DATETIME NOT NULL,
  `belbin_test_end_date` DATETIME NULL,

  PRIMARY KEY (`belbin_test_id`),
  CONSTRAINT `belbin_test_customer_fk`
    FOREIGN KEY (`belbin_test_customer_id`)
    REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB;

create table `belbin_questions` (
       `belbin_question_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_question_index` TINYINT UNSIGNED,
       `belbin_question_text` varchar(2000),
       
       PRIMARY KEY (`belbin_question_id`)
) ENGINE=InnoDB;

create table `belbin_answers` (
       `belbin_answer_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_answer_question_id` INT UNSIGNED NOT NULL,
       `belbin_answer_index` TINYINT UNSIGNED,
       `belbin_answer_text` varchar(2000),
       `belbin_answer_role_id` INT UNSIGNED NOT NULL,
       
       PRIMARY KEY (`belbin_answer_id`),
       CONSTRAINT `belbin_answers_question_fk` FOREIGN KEY (`belbin_answer_question_id`) REFERENCES `belbin_questions` (`belbin_question_id`),
       CONSTRAINT `belbin_answers_role_fk` FOREIGN KEY (`belbin_answer_role_id`) REFERENCES `belbin_roles` (`belbin_role_id`)
) ENGINE=InnoDB;

create table `belbin_results` (
       `belbin_result_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_result_test_id` INT UNSIGNED NOT NULL,
       `belbin_result_question_id` INT UNSIGNED NOT NULL,
       `belbin_result_answer_id` INT UNSIGNED NOT NULL,
       `belbin_result_score` TINYINT UNSIGNED NOT NULL,
       
       PRIMARY KEY (`belbin_result_id`),
       CONSTRAINT `belbin_result_test_fk` FOREIGN KEY (`belbin_result_test_id`) REFERENCES `belbin_tests` (`belbin_test_id`),
       CONSTRAINT `belbin_result_question_fk` FOREIGN KEY (`belbin_result_question_id`) REFERENCES `belbin_questions` (`belbin_question_id`),
       CONSTRAINT `belbin_result_answer_fk` FOREIGN KEY (`belbin_result_answer_id`) REFERENCES `belbin_answers` (`belbin_answer_id`)
);

DROP VIEW IF EXISTS `viewBelbinResults`;
  
CREATE VIEW viewBelbinResults AS
	SELECT t.belbin_test_id as test_id, a.belbin_answer_role_id as role_id, r.belbin_result_score as score
    FROM belbin_results r    
    JOIN belbin_tests t ON (t.belbin_test_id = r.belbin_result_test_id)
    JOIN belbin_answers a ON (a.belbin_answer_id = r.belbin_result_answer_id)
    WHERE t.belbin_test_end_date is not null;
    
DROP VIEW IF EXISTS `viewBelbinTestResultsSummary`;
  
CREATE VIEW viewBelbinTestResultsSummary AS
	SELECT test_id, role_id, sum(score) as score
    FROM viewBelbinResults
    GROUP BY test_id, role_id;

DROP VIEW IF EXISTS `viewBelbinRoleResultsSummary`;
  
CREATE VIEW viewBelbinRoleResultsSummary AS
	SELECT role_id, sum(score) as score
    FROM viewBelbinResults
    GROUP BY role_id;

DROP VIEW IF EXISTS `viewBelbinTestResults`;
  
CREATE VIEW viewBelbinTestResults AS
	SELECT roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, tests.belbin_test_id, coalesce(results.score, 0) as score
    FROM belbin_roles roles
    INNER JOIN belbin_tests tests
    LEFT OUTER JOIN viewBelbinTestResultsSummary results ON (roles.belbin_role_id = results.role_id and tests.belbin_test_id = results.test_id);

DROP VIEW IF EXISTS `viewBelbinResultsStatistics`;
  
CREATE VIEW viewBelbinResultsStatistics AS
	SELECT roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, coalesce(results.score, 0) as score
    FROM belbin_roles roles    
    LEFT OUTER JOIN viewBelbinRoleResultsSummary results ON (roles.belbin_role_id = results.role_id);
