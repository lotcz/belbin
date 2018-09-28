<?php

	require_once __DIR__ . '/../../models/question.m.php';
	require_once __DIR__ . '/../../models/answer.m.php';
	require_once __DIR__ . '/../../models/result.m.php';
	require_once __DIR__ . '/../../models/test.m.php';

	$this->setMainTemplate('test');

	if (!$this->z->auth->isAuth()) {
		$this->z->auth->createAnonymousSession();
	}
	$user_id = $this->z->auth->user->ival('user_id');

	$test_id = z::getInt('test_id', $this->getPath(-2));
	$test = null;

	//load test in progress
	if (z::parseInt($test_id) > 0) {
		$test = new TestModel($this->z->db, $test_id);
	}

	//start new test
	if ($test === null || !$test->is_loaded) {
		$test = new TestModel($this->z->db);
		$test->set('belbin_test_user_id', $user_id);
		$test->set('belbin_test_start_date', z::mysqlDatetime(time()));
		$test->save();
	}

	if ($test->val('belbin_test_end_date') === null) {
		if ($this->z->auth->user->ival('user_id') == $test->ival('belbin_test_user_id')) {
			$question_id = z::getInt('question_id', $this->getPath(-1));
			$question = null;
			$prev_question = null;
			$next_question = null;

			if (z::parseInt($question_id) > 0) {
				$question = new QuestionModel($this->z->db, $question_id);
			} else {
				$question = QuestionModel::loadFirstQuestion($this->z->db);
			}

			if ($question->is_loaded) {
				$original_question = $question;

				$answers = AnswerModel::loadAllForQuestion($this->z->db, $question->ival('belbin_question_id'));

				if (z::isPost()) {

					if ($this->z->forms->verifyXSRFTokenHash('belbin_test_form', z::get('form_token'))) {

						$answered_score = 0;
						$results = [];

						foreach ($answers as $answer) {
							$question_score = z::getInt('answer_' . $answer->val('belbin_answer_id'), 0);
							if ($question_score > 0) {
								$answered_score += $question_score;
								$result = new ResultModel($this->z->db);
								$result->set('belbin_result_test_id', $test->ival('belbin_test_id'));
								$result->set('belbin_result_question_id', $question->ival('belbin_question_id'));
								$result->set('belbin_result_answer_id', $answer->ival('belbin_answer_id'));
								$result->set('belbin_result_score', $question_score);
								$results[] = $result;
							}
						}

						//z::debug($answered_score);

						if ($answered_score == TestModel::$score_per_question) {
							ResultModel::deleteAllQuestionResults($this->z->db, $question->ival('belbin_question_id'), $test->ival('belbin_test_id'));
							foreach ($results as $result) {
								$result->save();
							}
							$question = QuestionModel::loadNextQuestion($this->z->db, $question->ival('belbin_question_index'));

							if (isset($question) && $question->is_loaded) {
								$answers = AnswerModel::loadAllForQuestion($this->z->db, $question->ival('belbin_question_id'));
							} else {
								if ($test->validateTestResults()) {
									//test is ok - finish the test and redirect to demografic info form
									$test->set('belbin_test_end_date', z::mysqlDatetime(time()));
									$test->save();
									$this->redirect(sprintf('default/udaje/udaje/%d', $test->ival('belbin_test_id')));
								} else {
									//test is not valid - redirect to last question and ask user to answer all questions
									$question = $original_question;
									$this->message('Není přidělen dostatečný počet bodů a test nelze uzavřít! Projděte si prosím všechny otázky znovu a ujistěte se, že jste u každé rozdělili požadovaný počet bodů.', 'error');
								}
							}
						} else {
							$this->z->messages->add($this->t('Distribute exactly %d points!', TestModel::$score_per_question), 'error');
						}
					} else {
						$this->z->messages->add('Byl detekován pokus o opakované odeslání formuláře! Data nelze uložit.', 'error');
					}
				}

				$this->insertJS(['score_per_question' => TestModel::$score_per_question]);
				$this->includeJS('test.js');

				// set answer score if this question was already answered
				$existing_results = ResultModel::loadAllForTestQuestion($this->z->db, $test->ival('belbin_test_id'), $question->ival('belbin_question_id'));
				foreach ($answers as $answer) {
					$existing = zModel::find($existing_results, 'belbin_result_answer_id', $answer->ival('belbin_answer_id'));
					$existing_score = 0;
					if (isset($existing)) {
						$existing_score = $existing->ival('belbin_result_score');
					} else {
						$existing_score = z::getInt('answer_' . $answer->val('belbin_answer_id'), 0);
					}
					$answer->set('existing_score', $existing_score);

					// this will update UI with javascript
					if ($existing_score > 0) {
						$this->insertJS(sprintf('updateItemBadge(%d, %d);', $answer->val('belbin_answer_id'), $existing_score), 'bottom');
					}

				}

				$prev_question = QuestionModel::loadPreviousQuestion($this->z->db, $question->ival('belbin_question_index'));
				$this->setPageTitle(sprintf('Otázka č. %d', $question->ival('belbin_question_index')));
				$this->setData('test', $test);
				$this->setData('questions_count', $this->z->db->getRecordCount('belbin_question'));
				$this->setData('question', $question);
				$this->setData('answers', $answers);
				$this->setData('form_token', $this->z->forms->createXSRFTokenHash('belbin_test_form'));
				$this->setData('prev_question', $prev_question);

			} else {
				throw new Exception(sprintf('Cannot load question! Requested question ID: %d', $question_id));
			}
		} else {
			$this->showErrorView('Tento test patří jinému uživateli.');
		}
	} else {
		$this->showErrorView('Test je již dokončen. Nelze upravovat výsledky.');
	}
