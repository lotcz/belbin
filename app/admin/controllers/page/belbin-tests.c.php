<?php
	require_once __DIR__ . '/../../../models/test.m.php';

	$this->setPageTitle('Výsledky');
	$fields = [
		[
			'name' => 'belbin_test_id',
			'label' => 'ID'
		],
		[
			'name' => 'belbin_test_start_date',
			'label' => 'Start date',
			'type' => 'datetime'
		],
		[
			'name' => 'belbin_test_end_date',
			'label' => 'End date',
			'type' => 'datetime'
		],
		[
			'name' => 'belbin_test_duration',
			'label' => 'Duration',
			'type' => 'custom',
			'custom_function' => 'TestModel::formatDurationSimple'
		],
		[
			'name' => 'belbin_test_age',
			'label' => 'Age'
		],
		[
			'name' => 'belbin_test_sex',
			'label' => 'Sex',
			'type' => 'custom',
			'custom_function' => 'TestModel::formatSexSimple'
		]
	];

	$form = new zForm('belbin_test', '', 'POST', 'form-inline');
	$form->type = 'inline';
	$form->render_wrapper = true;

	$filter_fields = [
		[
			'name' => 'search_text',
			'label' => 'Search',
			'type' => 'text',
			'filter_fields' => ['customer_name', 'customer_email', 'belbin_test_start_date']
		]
	];

	$form->add($filter_fields);
	$form->addField([
		'name' => 'form_filter_button',
		'type' => 'buttons',
		'buttons' => [
			['type' => 'submit', 'label' => 'Search', 'css' => 'btn btn-success'],
			['type' => 'link', 'label' => 'Reset', 'css' => 'btn btn-default', 'link_url' => $this->z->core->raw_path]
		]
	]);

	if (z::isPost()) {
		$form->processInput($_POST);
	}
	$this->z->core->setData('form', $form);

	$table = new zAdminTable('belbin_test', 'belbin_test');
	$table->add($fields);
	if (isset($filter_fields)) {
		$table->filter_form = $form;
	}

	$default_paging = $this->z->tables->createPaging();
	$default_paging->sorting_items = [
		'default' => 'belbin_test_start_date DESC'
	];
	$default_paging->active_sorting = 'default';

	$table->prepare($this->z->db, $default_paging);

	$this->z->core->setData('table', $table);
	$this->z->core->setPageTemplate('admin');
