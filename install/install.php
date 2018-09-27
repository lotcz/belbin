<?php

	/**
	* Install all modules and application. Installation means running all sql scripts to create tables etc.
	* Run from command line: php install.php
	* db user must have permission to create tables.
	*/

	require_once __DIR__ . '/../../zEngine/src/zengine.php';
	$z = new zEngine(__DIR__ . '/../app/', ['app']);

	$options = getopt('l:p:n:', ['db_login::', 'db_password::', 'db_name::']);

	$db_login = $options['db_login'] ?? null;
	$db_password = $options['db_password'] ?? null;
	$db_name = $options['db_name'] ?? null;

	$z->app->installAllModules($db_login, $db_password, $db_name);
	$z->db->executeFile(__DIR__ . '/belbin.sql', $db_login, $db_password, $db_name);
	$z->db->executeFile(__DIR__ . '/data.sql', $db_login, $db_password, $db_name);
