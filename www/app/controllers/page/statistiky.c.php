<?php
	$this->setPageTitle('Statistiky');
	
	$total_tests_finished = zSqlQuery::getRecordCount($this->db, 'belbin_tests', $whereSQL = 'where belbin_test_end_date is not null');	
	$this->setData('total_tests_finished', $total_tests_finished);
	
	$duration = zModel::Select($this->db, 'viewAverageTestDuration');
	$this->setData('average_duration', $duration[0]->val('average_duration'));
	
	$totals = zModel::Select(
	/* db */		$this->db,
	/* table */		'viewBelbinResultsStatistics',
	/* where */		null,
	/* bindings */	null,
	/* types */		null,
	/* paging */	null,
	/* orderby */	'score DESC'
	);
	
	$this->setData('totals', $totals);
	$this->setData('total_score', zModel::sum($totals, 'score'));
	
	
	$this->insertJS(
		[
			'totals_chart_data' => [
				'datasets' => [[
					'data' => zModel::columnAsArray($totals, 'score', 'i'),
					'backgroundColor' => zModel::columnAsArray($totals, 'belbin_role_color'),
					'borderWidth' => 0
				]],				
				'labels' => zModel::columnAsArray($totals, 'belbin_role_name')
			]
		]
	);