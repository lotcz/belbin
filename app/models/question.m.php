<?php

class QuestionModel extends zModel {

	public $table_name = 'belbin_question';

	static function loadFirstQuestion($db) {
		$questions = QuestionModel::select(
		/* db */		$db,
		/* table */		'belbin_question',
		/* where */		null,
		/* orderby */	'belbin_question_index',
		/* limit */		'0,1'
		);
		if (count($questions) > 0) {
			return $questions[0];
		} else {
			return null;
		}
	}

	static function loadPreviousQuestion($db, $index) {
		$questions = QuestionModel::select(
		/* db */		$db,
		/* table */		'belbin_question',
		/* where */		'belbin_question_index < ?',
		/* orderby */	'belbin_question_index DESC',
		/* limit */		'0,1',
		/* bindings */	[$index],
		/* types */		[PDO::PARAM_INT]
		);
		if (count($questions) > 0) {
			return $questions[0];
		} else {
			return null;
		}
	}

	static function loadNextQuestion($db, $index) {
		$questions = QuestionModel::select(
		/* db */		$db,
		/* table */		'belbin_question',
		/* where */		'belbin_question_index > ?',
		/* orderby */	'belbin_question_index',
		/* limit */		'0,1',
		/* bindings */	[$index],
		/* types */		[PDO::PARAM_INT]
		);
		if (count($questions) > 0) {
			return $questions[0];
		} else {
			return null;
		}
	}

}
