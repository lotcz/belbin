<?php

	$this->setPageTitle('Výsledky testů');

	$this->renderAdminTable(
		'belbin_test',
		[
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
			]
		],
		[
			[
				'name' => 'search_text',
				'label' => 'Search',
				'type' => 'text',
				'filter_fields' => ['customer_name', 'customer_email', 'belbin_test_start_date']
			]
		]
	);
