create table belbin_roles (
       belbin_role_id int,
       belbin_role_name nvarchar(100),
       belbin_role_description text
);

create table belbin_tests (
       belbin_test_id int,
       belbin_test_user_id int,
       belbin_test_date datetime
);

create table belbin_questions (
       belbin_question_id int,
       belbin_question_index tinyint,
       belbin_question_text nvarchar(2000),
);

create table belbin_answers (
       belbin_answer_id int,
       belbin_answer_question_id int,
       belbin_answer_index tinyint,
       belbin_answer_text nvarchar(2000),
       belbin_answer_role_id int
);

create table belbin_results (
       belbin_result_id int
       belbin_result_test_id int,
       belbin_result_question_id int,
       belbin_result_answer_id int,
       belbin_result_score tinyint
);