<?php
	require_once __DIR__ . '/../../../models/test.m.php';

	$this->renderAdminForm(
		'belbin_test',
		'TestModel',
		[
			[
				'name' => 'belbin_test_customer_id',
				'label' => 'Uživatel',
				'type' => 'foreign_key_link',
				'link_table' => 'customers',
				'link_template' => 'admin/default/default/customer/edit/%d',
				'link_id_field' => 'customer_id',
				'link_label_field' => 'customer_name'
			],
			[
				'name' => 'belbin_test_start_date',
				'label' => 'Start date',
				'type' => 'date',
				'validations' => [['type' => 'date']]
			],
			[
				'name' => 'belbin_test_end_date',
				'label' => 'End date',
				'type' => 'date',
				'validations' => [['type' => 'date', 'param' => 1]]
			]
		]
	);