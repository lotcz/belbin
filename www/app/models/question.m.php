<?php

class QuestionModel extends zModel {

	public $table_name = 'belbin_questions';
	public $id_name = 'belbin_question_id';

	static function loadFirstQuestion($db) {
		$questions = QuestionModel::Select(
		/* db */		$db,
		/* table */		'belbin_questions',
		/* where */		null,
		/* bindings */	null,
		/* types */		null,
		/* paging */	new zPaging(0, 1),
		/* orderby */	'belbin_question_index'
		);
		return $questions[0];
	}

	static function loadPreviousQuestion($db, $index) {
		$questions = QuestionModel::Select(
		/* db */		$db,
		/* table */		'belbin_questions',
		/* where */		'belbin_question_index < ?',
		/* bindings */	[$index],
		/* types */		'i',
		/* paging */	new zPaging(0, 1),
		/* orderby */	'belbin_question_index DESC'
		);
		return $questions[0];
	}

	static function loadNextQuestion($db, $index) {
		$questions = QuestionModel::Select(
		/* db */		$db,
		/* table */		'belbin_questions',
		/* where */		'belbin_question_index > ?',
		/* bindings */	[$index],
		/* types */		'i',
		/* paging */	new zPaging(0, 1),
		/* orderby */	'belbin_question_index DESC'
		);
		return $questions[0];
	}

}
