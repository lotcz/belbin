/*
DROP DATABASE IF EXISTS belbin;
CREATE DATABASE belbin DEFAULT char set utf8;
USE belbin;
*/

/*
	now run zEngine.sql
*/

create table `belbin_roles` (
       `belbin_role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_role_name` varchar(100),
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
	SELECT *
    FROM belbin_results r    
    JOIN belbin_tests t ON (t.belbin_test_id = r.belbin_result_test_id)
    JOIN belbin_questions q ON (q.belbin_question_id = r.belbin_result_question_id)
    JOIN belbin_answers a ON (a.belbin_answer_id = r.belbin_result_answer_id)
    JOIN belbin_roles roles ON (roles.belbin_role_id = a.belbin_answer_role_id);
    
DROP VIEW IF EXISTS `viewBelbinTestResultsSummary`;
  
CREATE VIEW viewBelbinTestResultsSummary AS
	SELECT belbin_test_id, belbin_role_id, belbin_role_name, sum(belbin_result_score) as score
    FROM viewBelbinResults
    GROUP BY belbin_test_id, belbin_role_id, belbin_role_name
    ORDER BY score DESC
