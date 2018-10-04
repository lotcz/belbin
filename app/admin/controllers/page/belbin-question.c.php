<?php
	require_once __DIR__ . '/../../../models/question.m.php';
	require_once __DIR__ . '/../../../models/answer.m.php';

	$form = new zForm('belbin_question');
	$form->render_wrapper = true;

	$form->add([
		[
			'name' => 'belbin_question_id',
			'type' => 'hidden'
		],
		[
			'name' => 'belbin_question_index',
			'label' => 'Index',
			'type' => 'text',
			'validations' => [
				['type' => 'integer', 'param' => 0]
			]
		],
		[
			'name' => 'belbin_question_text',
			'label' => 'Name',
			'type' => 'text',
			'validations' => [['type' => 'length', 'param' => 1]]
		]
	]);

	$this->z->forms->processForm($form, 'QuestionModel');

	$form->addField(
		[
			'name' => 'form_buttons',
			'type' => 'buttons',
			'buttons' => $this->z->admin->getAdminFormButtons($form)
		]
	);

	$question_id = z::parseInt($this->getPath(-1));

	$table = new zTable('answers_table', $id_field = 'belbin_answer_id', 'admin/default/default/belbin-answer/edit/%d');
	$table->add([
		[
			'name' => 'belbin_answer_index',
			'label' => 'Index'
		],
		[
			'name' => 'belbin_answer_text',
			'label' => 'Text'
		]
	]);
	$table->data = AnswerModel::loadAllForQuestion($this->z->db, $question_id);

	$this->setData('table', $table);
	$this->setData('form', $form);
	$this->setData('question_id', $question_id);
