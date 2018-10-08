<?php

	$this->setPageTitle('Otázky');
	$this->renderAdminTable(
		'belbin_question',
		[
			[
				'name' => 'belbin_question_index',
				'label' => 'Index'
			],
			[
				'name' => 'belbin_question_text',
				'label' => 'Text'
			]
		],
		[
			[
				'name' => 'search_text',
				'label' => 'Search',
				'type' => 'text',
				'filter_fields' => ['belbin_question_text']
			]
		]
	);
