<?php

class ResultModel extends zModel {

	public $table_name = 'belbin_results';
	public $id_name = 'belbin_result_id';

	static function deleteAllQuestionResults($db, $question_id, $test_id) {
		zSqlQuery::executeSQL($db, 'delete from belbin_results where belbin_result_question_id = ? and belbin_result_test_id = ?', [$question_id, $test_id], 'ii');
	}

	static function loadAllForTestQuestion($db, $test_id, $question_id) {
		return AnswerModel::Select(
		/* db */		$db,
		/* table */		'belbin_results',
		/* where */		'belbin_result_test_id = ? and belbin_result_question_id = ?',
		/* bindings */	[$test_id, $question_id],
		/* types */		'ii',
		/* paging */	null,
		/* orderby */	'belbin_result_answer_id'
		);
	}

}
