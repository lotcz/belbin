<?php
	require_once __DIR__ . '/../../../models/answer.m.php';

	$this->setPageTitle('Odpověď: editace');
	$this->setPageTemplate('admin');
	
	$form = new zForm('belbin_answer');
	$form->entity_title = 'Odpověď';
	$form->render_wrapper = true;		
	$form->add([
		[
			'name' => 'belbin_answer_id',
			'type' => 'hidden'
		],
		[
			'name' => 'belbin_answer_question_id',
			'label' => 'Otázka',
			'type' => 'select',
			'select_table' => 'belbin_questions',
			'select_id_field' => 'belbin_question_id',
			'select_label_field' => 'belbin_question_text'			
		],
		[
			'name' => 'belbin_answer_index',
			'label' => 'Index',
			'type' => 'text',
			'validations' => [['type' => 'integer', 'param' => 0]]		
		],		
		[
			'name' => 'belbin_answer_text',
			'label' => 'Text',
			'type' => 'textarea',
			'validations' => [['type' => 'length', 'param' => 1]]
		],
		[
			'name' => 'belbin_answer_role_id',
			'label' => 'Týmová role',
			'type' => 'select',
			'select_table' => 'belbin_roles',
			'select_id_field' => 'belbin_role_id',
			'select_label_field' => 'belbin_role_name'
		],
	]);
	
	$answer = new AnswerModel($this->db);
	
	if (z::isPost()) {
		// UPDATE or INSERT
		if ($form->processInput($_POST)) {
			if (z::getInt('belbin_answer_id', 0) > 0) {
				$answer->loadById(z::getInt('belbin_answer_id'));
			}
			$answer->setData($form->processed_input);
			if ($answer->save()) {
				$this->redirectBack();
			}
		} else {
			$this->z->messages->error('Input does not validate.');
			$answer->setData($form->processed_input);
		}
	} elseif ($this->z->forms->pathAction() == 'edit') {
		// coming to edit
		$answer->loadById($this->z->forms->pathParam());
		
	} elseif ($this->z->forms->pathAction() == 'delete') {
		// DELETE
		if ($answer->deleteById(z::parseInt($this->z->forms->pathParam()))) {			
			$this->redirectBack();
		}
	} else {
		// coming to create new
		$answer->set('belbin_answer_question_id', z::get('question_id'));
	}
	
	$form->prepare($this->z->core->db, $answer);

	$form->addField(
		[
			'name' => 'form_buttons',
			'type' => 'buttons',
			'buttons' => $this->z->admin->getAdminFormButtons($form)
		]
	);

	$this->z->core->setData('form', $form);
	