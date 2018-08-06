<?php
	$this->setPageTitle('Administrace');
	
	$this->setData(
		'admin_data',
		[
			'total_tests_finished' => zSqlQuery::getRecordCount($this->db, 'belbin_tests', $whereSQL = 'where belbin_test_end_date is not null'),
			'total_registered_customers' => zSqlQuery::getRecordCount($this->db, 'customers', $whereSQL = 'where customer_anonymous = 0')
		]
	);