<?php
	$this->setPageTitle('Přihlášení');
	
	if (z::isPost()) {
		if ($this->z->custauth->login(z::get('email'), z::get('password'))) {
			$this->redirectBack('profil');
		} else {
			$this->z->messages->error($this->t('Chybný email nebo heslo!'));
		}
	}
