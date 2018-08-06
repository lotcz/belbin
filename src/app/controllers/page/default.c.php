<?php
	$this->setPageTitle('Belbinův test týmových rolí');
	
	$total_tests_finished = zSqlQuery::getRecordCount($this->db, 'belbin_tests', $whereSQL = 'where belbin_test_end_date is not null');	
	$this->setData('total_tests_finished', $total_tests_finished);
	
	$statistics = zModel::Select(
	/* db */		$this->db,
	/* table */		'viewBelbinResultsStatistics',
	/* where */		null,
	/* bindings */	null,
	/* types */		null,
	/* paging */	null,
	/* orderby */	'score DESC'
	);
	
	$total_score = zModel::sum($statistics, 'score');
	
	foreach ($statistics as $total) {
		$total->set('percentage', round(z::safeDivide($total->ival('score'), $total_score) * 100, 2));
	}
	
	$this->insertJS(
		[
			'chart_data' => [
				'datasets' => [[
					'data' => zModel::columnAsArray($statistics, 'percentage', 'f'),
					'backgroundColor' => zModel::columnAsArray($statistics, 'belbin_role_color'),
					'borderWidth' => 0
				]],				
				'labels' => zModel::columnAsArray($statistics, 'belbin_role_name')
			]
		]
	);
	
	$this->includeJS('front.js', false, 'bottom');