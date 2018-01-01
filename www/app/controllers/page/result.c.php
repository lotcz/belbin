<?php

	$this->setPageTitle('Výsledky testu');

	$test_id = $this->getPath(-1);

	$results = zModel::Select(
	/* db */		$this->db,
	/* table */		'viewBelbinTestResults',
	/* where */		'belbin_test_id = ?',
	/* bindings */	[$test_id],
	/* types */		'i',
	/* paging */	null,
	/* orderby */	'score DESC'
	);

	$this->setData('results', $results);
	$this->setData('total_score', zModel::sum($results, 'score'));
	
	$this->insertJS(
		[
			'chart_data' => [
				'datasets' => [[
					'data' => zModel::columnAsArray($results, 'score', 'i'),
					'backgroundColor' => zModel::columnAsArray($results, 'belbin_role_color'),
					'borderWidth' => 0,
				]],				
				'labels' => zModel::columnAsArray($results, 'belbin_role_name')
			]
		]
	);
