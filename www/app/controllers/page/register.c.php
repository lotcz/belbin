<?php
	$this->requireModule('forms');
	$this->setPageTitle('Registration');

	$form = new zForm('register_form');
	$form->add([
		[
			'name' => 'email',
			'label' => 'E-mail',
			'type' => 'text',
			'validations' => [['type' => 'email']]
		],
		[
			'name' => 'password',
			'label' => 'Password',
			'type' => 'password',
			'validations' => [['type' => 'password']]
		],
		[
			'name' => 'password_confirm',
			'label' => 'Confirm Password',
			'type' => 'password',
			'validations' => [['type' => 'confirm', 'param' => 'password']]
		]
	]);

	if ($this->isCustAuth() && !$this->z->custauth->isAnonymous()) {
		$this->redirect('profile');
	} elseif (z::isPost()) {

		$email = trim(strtolower(z::get('email')));
		$password = z::get('password');

		// validate email and password once again
		if ($this->z->custauth->isValidEmail($email) && $this->z->custauth->isValidPassword($password)) {

			// check if email exists
			$existing_customer = new CustomerModel($this->db);
			$existing_customer->loadByEmail($email);
			if ($existing_customer->is_loaded) {
				$this->z->messages->error($this->t('This email is already used!'));
			} else {
				$customer = $this->getCustomer();
				$customer->data['customer_name'] = $email;
				$customer->data['customer_email'] = $email;
				$customer->data['customer_anonymous'] = 0;
				$customer->data['customer_password_hash'] = $this->z->custauth->hashPassword($password);
				$customer->save();

				if ($this->z->custauth->login($email, $password)) {
					$this->z->custauth->sendRegistrationEmail();
					$this->redirect('welcome');
					$render_form = false;
				} else {
					$this->z->messages->error($this->t('Cannot log you in. Something went wrong during registration process.'));
				}
			}
		} else {
			$this->z->messages->error($this->t('Invalid password or email.'));
		}

	}
	
	$this->includeJS('register.js', false, 'bottom');
	$this->insertJS(
		[
			'email_check_ajax_url' => $this->url('json/default/emailexists')
		]
	);
	