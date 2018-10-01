<?php
	require_once __DIR__ . '/../../models/test.m.php';

	$this->setPageTitle('Statistiky');

	$stats = zModel::select($this->z->db, 'viewFinishedTestsStats');
	$this->setData('total_tests_finished', $stats[0]->val('total_tests_finished'));
	$this->setData('average_duration', $stats[0]->val('average_duration'));
	$this->setData('total_duration', $stats[0]->val('total_duration'));

	$totals = zModel::select(
	/* db */		$this->z->db,
	/* table */		'viewBelbinResultsStatistics',
	/* where */		null,
	/* orderby */	'score DESC',
	/* limit */	null,
	/* bindings */	null,
	/* types */		null
	);

	$total_score = zModel::sum($totals, 'score');

	foreach ($totals as $total) {
		$total->set('percentage', round(z::safeDivide($total->ival('score'), $total_score) * 100, 2));
	}

	$this->setData('totals', $totals);

	$this->insertJS(
		[
			'totals_chart_data' => [
				'datasets' => [[
					'data' => zModel::columnAsArray($totals, 'percentage', 'f'),
					'backgroundColor' => zModel::columnAsArray($totals, 'belbin_role_color'),
					'borderWidth' => 0
				]],
				'labels' => zModel::columnAsArray($totals, 'belbin_role_name')
			]
		]
	);

	$this->includeJS('statistiky.js', false, 'bottom');
