<?php

	require_once __DIR__ . '/../models/question.m.php';

	$question_id = $this->getPath(-1);
	$question = null;
	$prev_question = null;
	$next_question = null;

	if ($this->parseInt($question_id) > 0) {
		$question = new QuestionModel($this->db, $question_id);
		if ($question->is_loaded) {
			$prev_question = QuestionModel::loadPreviousQuestion($this->db, $question->ival('belbin_question_index'));
		}
	} else {
		$question = QuestionModel::loadFirstQuestion($this->db);
	}

	if ($question->is_loaded) {
		$this->setPageTitle($this->t('Question %d', $question->ival('belbin_question_index')));
		$next_question = QuestionModel::loadNextQuestion($this->db, $question->ival('belbin_question_index'));
		$answers = AnswerModel::loadAllForQuestion($this->db, $question->ival('belbin_question_id'))
		$this->setData('question_text', $question->val('belbin_question_text'));
		$this->setData('answers', $answers);
		$this->setData('prev_question', $prev_question);
		$this->setData('next_question', $next_question);
		$this->includeJS('js/cart.js');
	}
