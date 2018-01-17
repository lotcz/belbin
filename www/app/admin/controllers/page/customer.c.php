<?php
	$this->requireModule('custauth');
	
	$this->renderAdminForm(
		'customer',
		'CustomerModel',
		[	
			[
				'name' => 'customer_created',
				'label' => 'Date of first visit',
				'type' => 'static'
			],
			[
				'name' => 'customer_last_access',
				'label' => 'Date of last visit',
				'type' => 'static'
			],
			[
				'name' => 'customer_deleted',
				'label' => 'Customer deactivated',
				'type' => 'bool'
			],
			[
				'name' => 'customer_anonymous',
				'label' => 'Anonymous',
				'type' => 'bool'
			],
			[
				'name' => 'customer_email',
				'label' => 'E-mail',
				'type' => 'text',
				'validations' => [['type' => 'email']]
			],				
			[
				'name' => 'customer_name',
				'label' => 'Full name',
				'type' => 'text',
				'validations' => [['type' => 'maxlen', 'param' => 50]]
			]			
		]
	);
	
	