<?php

	require_once __DIR__ . '/../../models/test.m.php';

	$this->setMainTemplate('udaje');

	if (!$this->z->auth->isAuth()) {
		$this->z->auth->createAnonymousSession();
	}
	$user_id = $this->z->auth->user->ival('user_id');

	$test_id = z::parseInt($this->getPath(-1));	
	$test = null;

	// load test
	if ($test_id > 0) {
		$test = new TestModel($this->z->db, $test_id);
	}

	if (isset($test) && $test->is_loaded) {
		if ($this->z->auth->user->ival('user_id') == $test->ival('belbin_test_user_id')) {
				if (z::isPost()) {
					if ($this->z->forms->verifyXSRFTokenHash('belbin_demographic_form', z::get('form_token'))) {

						//TO DO - save demografické

						$this->redirect(sprintf('vysledek/%d', $test_id));
					} else {
						$this->z->messages->add('Byl detekován pokus o opakované odeslání formuláře! Data nelze uložit.', 'error');
					}
				}

				$this->setPageTitle('Demografické údaje');
				$this->setData('test_id', $test_id);
				$this->setData('form_token', $this->z->forms->createXSRFTokenHash('belbin_demographic_form'));
				$this->includeJS('udaje.js');

		} else {
			$this->showErrorView('Tento test patří jinému uživateli.');
		}
	} else {
		$this->showErrorView('Test neexistuje.');
	}
