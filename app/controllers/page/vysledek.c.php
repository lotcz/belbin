<?php
	require_once __DIR__ . '/../../models/test.m.php';

	$this->setPageTitle('Výsledky testu');

	$test_id = $this->getPath(-1);

	$test = new TestModel($this->z->db, $test_id);

	if ($test->is_loaded) {
		if ($test->val('belbin_test_end_date') !== null) {
			if ($this->z->auth->isAuth()) {
				if ($this->z->auth->user->ival('user_id') == $test->ival('belbin_test_user_id')) {
					$results = $test->testResults();
					$this->setData('results', $results);
					$this->setData('total_score', $test->totalScore());
					$this->setData('test_duration', $test->ival('belbin_test_duration'));
					$results_colors = zModel::columnAsArray($results, 'belbin_role_color');
					$this->insertJS(
						[
							'chart_data' => [
								'datasets' => [[
									'data' => zModel::columnAsArray($results, 'score', 'i'),
									'backgroundColor' => $results_colors,
									'borderColor' => $results_colors,
								]],
								'labels' => zModel::columnAsArray($results, 'belbin_role_name')
							]
						]
					);
					$this->includeJS('resources/result.js', false, 'bottom');
				} else {
					$this->showErrorView('Tento test patří jinému uživateli.');
				}
			} else {
				$this->showErrorView('Nejste přihlášen. Výsledky testů mohou prohlížet pouze přihlášení uživatelé.');
			}
		} else {
			$this->showErrorView('Test není dokončen. Nelze zobrazit výsledky.');
		}
	} else {
		$this->showErrorView('Test nebyl nalezen.');
	}
