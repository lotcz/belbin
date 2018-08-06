<?php

	if ($argc < 2) {
		die("Please provide mySQL server root user name and password as parameters. Example: init.php root rootpass");
	}
	
	$root_user = $argv[1];
	$root_password = $argv[2];
	
	$dbconfig = include __DIR__ . '/app/config/mysql.php';

	$hostname = $dbconfig['db_host'];
	$dbname = $dbconfig['db_name'];
	
	$command = "mysql --default-character-set=utf8 -h $hostname -D $dbname --user=$root_user --password='$root_password' < ";

	$sql_path = __DIR__ . '/../zEngine/sql/zEngine.sql';
	$output = shell_exec($command . $sql_path);
	echo $output;

	$sql_path = __DIR__ . '/sql/belbin.sql';
	$output = shell_exec($command . $sql_path);
	echo $output;
	
	require_once __DIR__ . '/../zEngine/src/zengine.php';	
	$z = new zEngine(__DIR__ . '/app/');	
	$z->enableModule('mysql');
	echo "Database initialized.";