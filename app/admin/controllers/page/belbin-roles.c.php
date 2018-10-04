<?php

	$this->setPageTitle('Týmové role');
	$this->renderAdminTable(
		'belbin_role',
		'belbin_role',
		[
			[
				'name' => 'belbin_role_name',
				'label' => 'Name'
			],
			[
				'name' => 'belbin_role_description',
				'label' => 'Description'
			]
		],
		[
			[
				'name' => 'search_text',
				'label' => 'Search',
				'type' => 'text',
				'filter_fields' => ['belbin_role_name', 'belbin_role_description']
			]
		]
	);
