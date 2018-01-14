<?php
	$this->setPageTitle('Přihlášení');
	
	if (z::isPost()) {
		$email = $this->xssafe(z::get('email'));
		$password = z::get('password');
		
		if (!zForm::validate_email($email)) {
			$this->z->messages->error($this->t('Emailová adresa není ve správném formátu!'));
		} elseif (!zForm::validate_length($password, 1)) {
			$this->z->messages->error($this->t('Prosím vložte Vaše heslo.'));
		} else {
			if ($this->z->custauth->login($email, $password)) {
				$this->redirectBack('profil');
			} else {
				$this->z->messages->error($this->t('Chybný email nebo heslo!'));
			}
		}
	}