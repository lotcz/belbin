<?php
	require_once __DIR__ . '/../../models/test.m.php';
	require_once __DIR__ . '/../../models/role.m.php';

	$this->setPageTitle('Statistiky');

	$stats = zModel::select($this->z->db, 'viewFinishedTestsStats');
	$this->setData('total_tests_finished', $stats[0]->ival('total_tests_finished'));
	$this->setData('average_duration', $stats[0]->ival('average_duration'));

	$totals = zModel::select(
		$this->z->db, 											/* db */
		'viewBelbinTestResultsStatistics', 	/* table */
		null, 															/* where */
	 	'score DESC', 											/* orderby */
	 	null, 															/* limit */
		null, 															/* bindings */
		null 																/* types */
	);
	TestModel::addPercentageToTestResults($totals);
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
		],
		'bottom'
	);

	/* STATS BY GENDER */

	$total_tests_finished_male = 0;
	$average_test_duration_male = 0;
	$totals_male = null;

	$total_tests_finished_female = 0;
	$average_test_duration_female = 0;
	$totals_female = null;

	$stats_by_gender = zModel::select($this->z->db, 'viewFinishedTestsStatsByGender');
	foreach ($stats_by_gender as $gender_stats) {
		if ($gender_stats->ival('belbin_test_sex') == TestModel::$male_sex_id) {
			$total_tests_finished_male = $gender_stats->ival('total_tests_finished');
			$average_test_duration_male = $gender_stats->ival('average_duration');
			$totals_male = zModel::select(
				$this->z->db, 															/* db */
				'viewBelbinTestResultsStatisticsByGender', 	/* table */
				'belbin_test_sex = ?',											/* where */
				'score DESC', 															/* orderby */
				null, 																			/* limit */
				[TestModel::$male_sex_id],									/* bindings */
				[PDO::PARAM_INT]														/* types */
			);
			TestModel::addPercentageToTestResults($totals_male);
			$this->insertJS(
				[
					'totals_male_chart_data' => [
						'datasets' => [[
							'data' => zModel::columnAsArray($totals_male, 'percentage', 'f'),
							'backgroundColor' => zModel::columnAsArray($totals_male, 'belbin_role_color'),
							'borderWidth' => 0
						]],
						'labels' => zModel::columnAsArray($totals_male, 'belbin_role_name')
					]
				],
				'bottom'
			);
		} else {
			$total_tests_finished_female = $gender_stats->ival('total_tests_finished');
			$average_test_duration_female = $gender_stats->ival('average_duration');
			$totals_female = zModel::select(
				$this->z->db, 															/* db */
				'viewBelbinTestResultsStatisticsByGender', 	/* table */
				'belbin_test_sex = ?',											/* where */
				'score DESC', 															/* orderby */
				null, 																			/* limit */
				[TestModel::$female_sex_id],								/* bindings */
				[PDO::PARAM_INT]														/* types */
			);
			TestModel::addPercentageToTestResults($totals_female);
			$this->insertJS(
				[
					'totals_female_chart_data' => [
						'datasets' => [[
							'data' => zModel::columnAsArray($totals_female, 'percentage', 'f'),
							'backgroundColor' => zModel::columnAsArray($totals_female, 'belbin_role_color'),
							'borderWidth' => 0
						]],
						'labels' => zModel::columnAsArray($totals_female, 'belbin_role_name')
					]
				],
				'bottom'
			);
		}
	}

	$this->setData('total_tests_finished_male', $total_tests_finished_male);
	$this->setData('average_test_duration_male', $average_test_duration_male);
	$this->setData('totals_male', $totals_male);
	$this->setData('total_tests_finished_female', $total_tests_finished_female);
	$this->setData('average_test_duration_female', $average_test_duration_female);
	$this->setData('totals_female', $totals_female);

	/* STATS BY AGE */

	$stats_by_age = zModel::select($this->z->db, 'viewFinishedTestsStatsByAge');
	$this->setData('total_tests_finished_age', $stats_by_age[0]->ival('total_tests_finished'));
	$this->setData('average_age', $stats_by_age[0]->ival('average_age'));
	$this->setData('min_age', $stats_by_age[0]->ival('min_age'));
	$this->setData('max_age', $stats_by_age[0]->ival('max_age'));

	$all_roles = BelbinRoleModel::all($this->z->db);

	$totals_by_age = zModel::select(
		$this->z->db, 															/* db */
		'viewBelbinTestResultsStatisticsByAge', 		/* table */
		null,																				/* where */
		'belbin_role_id, belbin_test_age',					/* orderby */
		null, 																			/* limit */
		null,																				/* bindings */
		null																				/* types */
	);

	/* calculate total score for each age group */
	$total_score_by_age = [];
	foreach ($totals_by_age as $total) {
		if (!isset($total_score_by_age[$total->ival('belbin_test_age')])) {
			$total_score_by_age[$total->ival('belbin_test_age')] = 0;
		}
		$total_score_by_age[$total->ival('belbin_test_age')] += $total->ival('score');
	}

	/* create chart data */

	$age_statistic_datasets = [];
	$current_role = null;
	$current_role_dataset = null;
	$current_role_data = null;

	foreach ($totals_by_age as $total) {
		if ($current_role == null || $current_role->ival('belbin_role_id') != $total->ival('belbin_role_id')) {
			$current_role = zModel::find($all_roles, 'belbin_role_id', $total->ival('belbin_role_id'));
			$current_role_dataset = [
				'data' => [],
				'label' => $current_role->val('belbin_role_name'),
				'backgroundColor' => $current_role->val('belbin_role_color'),
				'fill' => true,
				'borderColor' => $current_role->val('belbin_role_color'),
				'pointRadius' => 0,
				//'pointBackgroundColor' => 'transparent'
			];
			$current_role_data = &$current_role_dataset['data'];
			$age_statistic_datasets[] = $current_role_dataset;
		}
		$current_role_data[] = [
			'x' => $total->ival('belbin_test_age'),
			'y' => round(z::safeDivide($total->ival('score'),$total_score_by_age[$total->ival('belbin_test_age')]) * 100, 2)
		];
	}

	$this->insertJS(
		[
			'totals_age_chart_data' => [
				'datasets' => $age_statistic_datasets
			]
		],
		'bottom'
	);

	$this->includeJS('resources/statistiky.js', false, 'bottom');
