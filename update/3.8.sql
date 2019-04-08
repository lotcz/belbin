CREATE INDEX belbin_answer_role_index ON belbin_answer (belbin_answer_role_id);
CREATE INDEX belbin_result_answer_index ON belbin_result (belbin_result_answer_id);
CREATE INDEX belbin_result_stats_index ON belbin_result (belbin_result_answer_id, belbin_result_test_id);
CREATE INDEX belbin_result_test_index ON belbin_result (belbin_result_test_id);
CREATE INDEX belbin_test_sex_index ON belbin_test (belbin_test_sex);
CREATE INDEX belbin_test_age_index ON belbin_test (belbin_test_age);

/*
 * Shows aggregated result statistics of all tests in database.
 */  
DROP VIEW IF EXISTS `viewBelbinTestResultsStatistics`;

CREATE VIEW viewBelbinTestResultsStatistics AS
	SELECT roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, sum(results.belbin_result_score) as score
    FROM belbin_role as roles
    JOIN belbin_answer answers ON (answers.belbin_answer_role_id = roles.belbin_role_id)
    JOIN belbin_result results ON (results.belbin_result_answer_id = answers.belbin_answer_id)
    JOIN belbin_test tests ON (tests.belbin_test_id = results.belbin_result_test_id)    
    WHERE tests.belbin_test_end_date is not null
   	group by roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color;


 /*
 * Shows aggregated result statistics by gender of tests where gender is available.
 */  
DROP VIEW IF EXISTS `viewBelbinTestResultsStatisticsByGender`;

CREATE VIEW viewBelbinTestResultsStatisticsByGender AS
	SELECT roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, tests.belbin_test_sex, sum(results.belbin_result_score) as score
    FROM belbin_role as roles
    JOIN belbin_answer answers ON (answers.belbin_answer_role_id = roles.belbin_role_id)
    JOIN belbin_result results ON (results.belbin_result_answer_id = answers.belbin_answer_id)
    JOIN belbin_test tests ON (tests.belbin_test_id = results.belbin_result_test_id)    
    WHERE tests.belbin_test_end_date is not null and tests.belbin_test_sex is not null
   	group by roles.belbin_role_id, roles.belbin_role_name, roles.belbin_role_color, tests.belbin_test_sex;
   
   
/*
 * Shows aggregated result statistics by age of tests where age is available.
 */  
DROP VIEW IF EXISTS `viewBelbinTestResultsStatisticsByAge`;

CREATE VIEW viewBelbinTestResultsStatisticsByAge AS
	SELECT roles.belbin_role_id, tests.belbin_test_age, sum(results.belbin_result_score) as score
    FROM belbin_role as roles
    JOIN belbin_answer answers ON (answers.belbin_answer_role_id = roles.belbin_role_id)
    JOIN belbin_result results ON (results.belbin_result_answer_id = answers.belbin_answer_id)
    JOIN belbin_test tests ON (tests.belbin_test_id = results.belbin_result_test_id)    
    WHERE tests.belbin_test_end_date is not null and tests.belbin_test_age is not null
   	group by roles.belbin_role_id, tests.belbin_test_age;
