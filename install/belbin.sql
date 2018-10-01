create table `belbin_role` (
       `belbin_role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_role_name` varchar(100),
       `belbin_role_color` varchar(20),
       `belbin_role_description` text,

       PRIMARY KEY (`belbin_role_id`)
) ENGINE=InnoDB;

create table `belbin_test` (
  `belbin_test_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `belbin_test_user_id` INT UNSIGNED NOT NULL,
  `belbin_test_start_date` DATETIME NOT NULL,
  `belbin_test_end_date` DATETIME NULL,
  `belbin_test_duration` INT UNSIGNED NULL,
  `belbin_test_sex` BOOLEAN NULL,
  `belbin_test_age` TINYINT UNSIGNED NULL,

  PRIMARY KEY (`belbin_test_id`),
  INDEX `belbin_tests_end_date_index` (`belbin_test_end_date`),
  CONSTRAINT `belbin_test_user_fk`
    FOREIGN KEY (`belbin_test_user_id`)
    REFERENCES `user` (`user_id`)
    ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TRIGGER IF EXISTS update_belbin_test_trigger;

DELIMITER //
CREATE TRIGGER update_belbin_test_trigger BEFORE UPDATE ON belbin_test
  FOR EACH ROW
	BEGIN
		SET NEW.belbin_test_duration = TIME_TO_SEC(TIMEDIFF(NEW.belbin_test_end_date, NEW.belbin_test_start_date));
	END //
DELIMITER ;

create table `belbin_question` (
       `belbin_question_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_question_index` TINYINT UNSIGNED,
       `belbin_question_text` varchar(2000),

       PRIMARY KEY (`belbin_question_id`),
		UNIQUE INDEX `belbin_questions_index_unique` (`belbin_question_index` ASC)
) ENGINE=InnoDB;

create table `belbin_answer` (
       `belbin_answer_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_answer_question_id` INT UNSIGNED NOT NULL,
       `belbin_answer_index` TINYINT UNSIGNED,
       `belbin_answer_text` varchar(2000),
       `belbin_answer_role_id` INT UNSIGNED NOT NULL,

       PRIMARY KEY (`belbin_answer_id`),
       UNIQUE INDEX `belbin_answers_index_unique` (`belbin_answer_question_id`, `belbin_answer_index` ASC),
       CONSTRAINT `belbin_answers_question_fk` FOREIGN KEY (`belbin_answer_question_id`) REFERENCES `belbin_question` (`belbin_question_id`) ON DELETE CASCADE,
       CONSTRAINT `belbin_answers_role_fk` FOREIGN KEY (`belbin_answer_role_id`) REFERENCES `belbin_role` (`belbin_role_id`) ON DELETE CASCADE
) ENGINE=InnoDB;

create table `belbin_result` (
       `belbin_result_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
       `belbin_result_test_id` INT UNSIGNED NOT NULL,
       `belbin_result_question_id` INT UNSIGNED NOT NULL,
       `belbin_result_answer_id` INT UNSIGNED NOT NULL,
       `belbin_result_score` TINYINT UNSIGNED NOT NULL,

       PRIMARY KEY (`belbin_result_id`),
       CONSTRAINT `belbin_result_test_fk` FOREIGN KEY (`belbin_result_test_id`) REFERENCES `belbin_test` (`belbin_test_id`) ON DELETE CASCADE,
       CONSTRAINT `belbin_result_question_fk` FOREIGN KEY (`belbin_result_question_id`) REFERENCES `belbin_question` (`belbin_question_id`) ON DELETE CASCADE,
       CONSTRAINT `belbin_result_answer_fk` FOREIGN KEY (`belbin_result_answer_id`) REFERENCES `belbin_answer` (`belbin_answer_id`) ON DELETE CASCADE
);

/*
 * Simple view of belbin tests.
 */
DROP VIEW IF EXISTS `viewBelbinTests`;

CREATE VIEW viewBelbinTests AS
	SELECT *
    FROM belbin_test t
    JOIN user u ON (u.user_id = t.belbin_test_user_id);

/*
 * Raw view of belbin test results.
 * Shows score for each role by test. Roles that were not assigned any score are missing!
 */
DROP VIEW IF EXISTS `viewBelbinResults`;

CREATE VIEW viewBelbinResults AS
	SELECT t.belbin_test_id, a.belbin_answer_role_id as belbin_role_id, sum(r.belbin_result_score) as score
    FROM belbin_result r
    JOIN belbin_test t ON (t.belbin_test_id = r.belbin_result_test_id)
    JOIN belbin_answer a ON (a.belbin_answer_id = r.belbin_result_answer_id)
    WHERE t.belbin_test_end_date is not null
   	group by t.belbin_test_id, a.belbin_answer_role_id;
  
/*
 * Simple view of belbin test results.
 * Shows score for each role for each test. All roles included.
 */
DROP VIEW IF EXISTS `viewBelbinTestResults`;

CREATE VIEW viewBelbinTestResults AS
	SELECT roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, tests.belbin_test_id, tests.belbin_test_sex, tests.belbin_test_age, coalesce(results.score, 0) as score
    FROM belbin_role roles
    INNER JOIN belbin_test tests
    LEFT OUTER JOIN viewBelbinResults results ON (roles.belbin_role_id = results.belbin_role_id and tests.belbin_test_id = results.belbin_test_id);

/*
 * Shows aggregated result statistics of all tests in database.
 */  
DROP VIEW IF EXISTS `viewBelbinTestResultsStatistics`;

CREATE VIEW viewBelbinTestResultsStatistics AS
	SELECT results.belbin_role_id, results.belbin_role_name, results.belbin_role_color, sum(results.score) as score
    FROM viewBelbinTestResults results
   	group by results.belbin_role_id, results.belbin_role_name, results.belbin_role_color;

/*
 * Shows aggregated result statistics by gender of tests where gender is available.
 */  
DROP VIEW IF EXISTS `viewBelbinTestResultsStatisticsByGender`;

CREATE VIEW viewBelbinTestResultsStatisticsByGender AS
	SELECT results.belbin_role_id, results.belbin_role_name, results.belbin_role_color, results.belbin_test_sex, sum(results.score) as score
    FROM viewBelbinTestResults results
    where results.belbin_test_sex is not null
   	group by results.belbin_role_id, results.belbin_role_name, results.belbin_role_color, results.belbin_test_sex;

/*
 * Shows aggregated result statistics by age of tests where age is available.
 */  
DROP VIEW IF EXISTS `viewBelbinTestResultsStatisticsByAge`;

CREATE VIEW viewBelbinTestResultsStatisticsByAge AS
	SELECT results.belbin_role_id, results.belbin_test_age, sum(results.score) as score
    FROM viewBelbinTestResults results
    where results.belbin_test_age is not null
   	group by results.belbin_role_id, results.belbin_test_age;

/*
 * Statistics about finished tests - total number, average time, etc. 
 */
DROP VIEW IF EXISTS `viewFinishedTestsStats`;

CREATE VIEW viewFinishedTestsStats AS
	SELECT count(*) as total_tests_finished, round(avg(belbin_test_duration)) as average_duration
    FROM belbin_test
    WHERE belbin_test_end_date is not null;

/*
 * Statistics about finished tests grouped by gender. Tests with no gender info will not be included. 
 */
DROP VIEW IF EXISTS `viewFinishedTestsStatsByGender`;

CREATE VIEW viewFinishedTestsStatsByGender AS
	SELECT belbin_test_sex, count(*) as total_tests_finished, sum(belbin_test_duration) as total_duration, round(avg(belbin_test_duration)) as average_duration
    FROM belbin_test    
    WHERE belbin_test_end_date IS NOT NULL AND belbin_test_sex IS NOT NULL
   	GROUP BY belbin_test_sex;
   
/*
 * Statistics about finished tests where users shared their age.
 */
DROP VIEW IF EXISTS `viewFinishedTestsStatsByAge`;

CREATE VIEW viewFinishedTestsStatsByAge AS
	SELECT count(*) as total_tests_finished, round(avg(belbin_test_age)) as average_age, min(belbin_test_age) as min_age, max(belbin_test_age) as max_age
    FROM belbin_test    
    WHERE belbin_test_end_date IS NOT NULL AND belbin_test_age IS NOT NULL;
