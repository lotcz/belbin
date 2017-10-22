<?php

class AnswerModel extends zModel {

	public $table_name = 'belbin_answers';
	public $id_name = 'belbin_answer_id';

	static function loadAllForQuestion($db, $question_id) {
		return AnswerModel::Select(
		/* db */		$db,
		/* table */		'belbin_answers',
		/* where */		'belbin_answer_question_id = ?',
		/* bindings */	[$question_id],
		/* types */		'i',
		/* paging */	null,
		/* orderby */	'belbin_answer_index'
		);
	}

}
