<?php
	$this->requireModule('auth');

	// delete unfinished tests older than 24 hours
	$deadline = time()-(60*60*24);
	$this->z->db->executeDeleteQuery(
		'belbin_test',
		'belbin_test_start_date <= ? and belbin_test_end_date is null',
		[z::mysqlTimestamp($deadline)],
		[PDO::PARAM_INT]
	);

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

		// delete session
		$session->delete();

		// delete user, if anonymous and doesn't have any tests
		if ($user->isAnonymous()) {
			$tests_count = $this->z->db->getRecordCount(
				'belbin_test',
				'belbin_test_user_id = ?',
				[$user->ival('user_id')],
			 	[PDO::PARAM_INT]
			);
			if ($tests_count == 0) {
				$user->delete();
			}
		}
	}

	echo 'Expired sessions and unfinished tests cleared.';
