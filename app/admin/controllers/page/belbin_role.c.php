<?php
	require_once __DIR__ . '/../../../models/role.m.php';

	$this->renderAdminForm(
		'belbin_role',
		'BelbinRoleModel',
		[		
			[
				'name' => 'belbin_role_name',
				'label' => 'Name',
				'type' => 'text',
				'required' => true,
				'validations' => [['type' => 'length', 'param' => 1]]
			],
			[
				'name' => 'belbin_role_color',
				'label' => 'Color',
				'type' => 'text',
				'required' => true,
				'validations' => [['type' => 'length', 'param' => 1]]		
			],		
			[
				'name' => 'belbin_role_description',
				'label' => 'Description',
				'type' => 'textarea'				
			]	
		]
	);