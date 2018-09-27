<?php

class AnswerModel extends zModel {

	public $table_name = 'belbin_answer';

	static function loadAllForQuestion($db, $question_id) {
		return AnswerModel::select(
		/* db */		$db,
		/* table */		'belbin_answer',
		/* where */		'belbin_answer_question_id = ?',
		/* orderby */	'belbin_answer_index',
		/* limit */	null,
		/* bindings */	[$question_id],
		/* types */		[PDO::PARAM_INT]
		);
	}

}
