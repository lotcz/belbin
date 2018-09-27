<?php

class ResultModel extends zModel {

	public $table_name = 'belbin_result';

	static function deleteAllQuestionResults($db, $question_id, $test_id) {
		$db->executeDeleteQuery('belbin_result', 'belbin_result_question_id = ? and belbin_result_test_id = ?', [$question_id, $test_id], [PDO::PARAM_INT, PDO::PARAM_INT]);
	}

	static function loadAllForTestQuestion($db, $test_id, $question_id) {
		return AnswerModel::Select(
		/* db */		$db,
		/* table */		'belbin_result',
		/* where */		'belbin_result_test_id = ? and belbin_result_question_id = ?',
		/* orderby */	'belbin_result_answer_id',
		/* limit */	null,
		/* bindings */	[$test_id, $question_id],
		/* types */		[PDO::PARAM_INT, PDO::PARAM_INT]
		);
	}

}
