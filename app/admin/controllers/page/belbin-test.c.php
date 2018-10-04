<?php
	require_once __DIR__ . '/../../../models/test.m.php';

	$this->renderAdminForm(
		'TestModel',
		[
			[
				'name' => 'belbin_test_user_id',
				'label' => 'Uživatel',
				'type' => 'foreign_key_link',
				'link_table' => 'user',
				'link_template' => 'admin/default/default/user/edit/%d',
				'link_id_field' => 'user_id',
				'link_label_field' => 'user_name'
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
				'validations' => [['type' => 'date', 'param' => true]]
			]
		]
	);
