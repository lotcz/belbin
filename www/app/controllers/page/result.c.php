<?php

	$this->setPageTitle('Test results');

	$test_id = $this->getPath(-1);

	$results = zModel::Select(
	/* db */		$this->db,
	/* table */		'viewBelbinTestResultsSummary',
	/* where */		'belbin_test_id = ?',
	/* bindings */	[$test_id],
	/* types */		'i',
	/* paging */	null,
	/* orderby */	'score DESC'
	);

	$this->setData('results', $results);
	$this->setData('total_score', zModel::sum($results, 'score'));
