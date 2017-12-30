<?php

	require_once __DIR__ . '/../../models/question.m.php';
	require_once __DIR__ . '/../../models/answer.m.php';
	require_once __DIR__ . '/../../models/result.m.php';
	require_once __DIR__ . '/../../models/test.m.php';

	if (!$this->isCustAuth()) {
		$this->z->custauth->createAnonymousSession();
	}
	$customer_id = $this->z->custauth->customer->ival('customer_id');

	$test_id = z::getInt('test_id', $this->getPath(-2));
	$test = null;

	if (z::parseInt($test_id) > 0) {
		$test = new TestModel($this->db, $test_id);
	} else {
		$test = new TestModel($this->db);
		$test->set('belbin_test_customer_id', $customer_id);
		$test->set('belbin_test_start_date', zSqlQuery::mysqlDatetime());
		$test->save();
	}

	$question_id = z::getInt('question_id', $this->getPath(-1));
	$question = null;
	$prev_question = null;
	$next_question = null;

	if (z::parseInt($question_id) > 0) {
		$question = new QuestionModel($this->db, $question_id);
	} else {
		$question = QuestionModel::loadFirstQuestion($this->db);
	}

if ($question->is_loaded) {
	
	$answers = AnswerModel::loadAllForQuestion($this->db, $question->ival('belbin_question_id'));
	
	if (z::isPost()) {		
	
		$answered_score = 0;
		$results = [];
				
		foreach ($answers as $answer) {
			$question_score = z::getInt('answer_' . $answer->val('belbin_answer_id'), 0);
			if ($question_score > 0) {
				$answered_score += $question_score;
				$result = new ResultModel($this->db);
				$result->set('belbin_result_test_id', $test->ival('belbin_test_id'));
				$result->set('belbin_result_question_id', $question->ival('belbin_question_id'));
				$result->set('belbin_result_answer_id', $answer->ival('belbin_answer_id'));
				$result->set('belbin_result_score', $question_score);
				$results[] = $result;
			}
		}		

		//z::debug($answered_score);		
		
		if ($answered_score == TestModel::$score_per_question) {
			ResultModel::deleteAllQuestionResults($this->db, $question->ival('belbin_question_id'), $test->ival('belbin_test_id'));
			foreach ($results as $result) {				
				$result->save();
			}
			$question = QuestionModel::loadNextQuestion($this->db, $question->ival('belbin_question_index'));			
	
			if (!$question->is_loaded) {
				$test->set('belbin_test_end_date', zSqlQuery::mysqlDatetime());
				$test->save();
				$this->redirect(sprintf('default/default/result/%d', $test->ival('belbin_test_id')));
			} else {
				$answers = AnswerModel::loadAllForQuestion($this->db, $question->ival('belbin_question_id'));
			}
		} else {
			$this->z->messages->add($this->t('Distribute exactly %d points!', TestModel::$score_per_question), 'error');
		}
	}

	$prev_question = QuestionModel::loadPreviousQuestion($this->db, $question->ival('belbin_question_index'));
	$this->setPageTitle(sprintf('Otázka č. %d', $question->ival('belbin_question_index')));
	$this->setData('test', $test);
	$this->setData('question', $question);
	$this->setData('answers', $answers);
	$this->setData('prev_question', $prev_question);
	$this->insertJS(['score_per_question' => TestModel::$score_per_question]);
	$this->includeJS('belbin.js', false);
	
} else {
	throw new Exception(sprintf('Cannot load question! Requested question ID: %d', $question_id));
}