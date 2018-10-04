<?php
	require_once __DIR__ . '/../../models/test.m.php';

	$this->setPageTitle('Belbinův test týmových rolí');

	$total_tests_finished = $this->z->db->getRecordCount('belbin_test', 'belbin_test_end_date is not null');
	$this->setData('total_tests_finished', $total_tests_finished);

	$statistics = zModel::select(
	/* db */		$this->z->db,
	/* table */		'viewBelbinTestResultsStatistics',
	/* where */		null,
	/* bindings */	null,
	/* types */		null,
	/* paging */	null,
	/* orderby */	'score DESC'
	);

	TestModel::addPercentageToTestResults($statistics);
	$statistics_colors = zModel::columnAsArray($statistics, 'belbin_role_color');
	$this->insertJS(
		[
			'chart_data' => [
				'datasets' => [[
					'data' => zModel::columnAsArray($statistics, 'percentage', 'f'),
					'backgroundColor' => $statistics_colors,
					'borderColor' => $statistics_colors
				]],
				'labels' => zModel::columnAsArray($statistics, 'belbin_role_name')
			]
		],
		'bottom'
	);

	$this->includeJS('resources/front.js', false, 'bottom');
