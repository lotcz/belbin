<?php
	$this->requireModule('auth');

	// load expired sessions
	$sessions = UserSessionModel::select(
		$this->z->db, 								/* db */
		'user_session', 							/* table */
		'user_session_expires <= ?', 	/* where */
		null, 												/* orderby */
		null, 												/* limit */
		[z::mysqlTimestamp(time())], 	/* bindings */
		[PDO::PARAM_INT] 							/* types */
	);

	foreach ($sessions as $session) {
		$user = new UserModel($this->z->db, $session->ival('user_session_user_id'));

		// delete unfinished tests
		$this->z->db->executeDeleteQuery(
			'belbin_test',
			'belbin_test_user_id = ? and belbin_test_end_date is null',
			$user->ival('user_id'),
			[PDO::PARAM_INT]
		);

		// delete session
		$session->delete();

		// delete user, if anonymous and doesn't have any (finished) tests
		if ($user->isAnonymous()) {
			$finished_tests_count = $this->z->db->getRecordCount(
				'belbin_test',
				'belbin_test_user_id = ?',
				$user->ival('user_id'),
			 	[PDO::PARAM_INT]
			);
			if ($finished_tests_count == 0) {
				$user->delete();
			}
		}
	}

	echo 'Expired sessions and unfinished tests cleared.';
