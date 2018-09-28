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

DROP VIEW IF EXISTS `viewBelbinTests`;

CREATE VIEW viewBelbinTests AS
	SELECT *
    FROM belbin_test t
    JOIN user u ON (u.user_id = t.belbin_test_user_id);

DROP VIEW IF EXISTS `viewBelbinResults`;

CREATE VIEW viewBelbinResults AS
	SELECT t.belbin_test_id as test_id, a.belbin_answer_role_id as role_id, r.belbin_result_score as score
    FROM belbin_result r
    JOIN belbin_test t ON (t.belbin_test_id = r.belbin_result_test_id)
    JOIN belbin_answer a ON (a.belbin_answer_id = r.belbin_result_answer_id)
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
    FROM belbin_role roles
    INNER JOIN belbin_test tests
    LEFT OUTER JOIN viewBelbinTestResultsSummary results ON (roles.belbin_role_id = results.role_id and tests.belbin_test_id = results.test_id);

DROP VIEW IF EXISTS `viewBelbinResultsStatistics`;

CREATE VIEW viewBelbinResultsStatistics AS
	SELECT roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, coalesce(results.score, 0) as score
    FROM belbin_role roles
    LEFT OUTER JOIN viewBelbinRoleResultsSummary results ON (roles.belbin_role_id = results.role_id);

DROP VIEW IF EXISTS `viewFinishedTestsStats`;

CREATE VIEW viewFinishedTestsStats AS
	SELECT count(*) as total_tests_finished, sum(belbin_test_duration) as total_duration, round(avg(belbin_test_duration)) as average_duration
    FROM belbin_test
    WHERE belbin_test_end_date is not null;
