<?php

	return [

		// this is application version
		// integer part should be identical with GIT branch name
		'version' => 3.9,

    // required zEngine major version (integer value)
		'require_z_version' => 3,

		// this is minimum required zEngine version
		'minimum_z_version' => 3.7,

		// list of modules that will be automatically loaded
		'modules' => ['resources', 'db', 'auth', 'i18n', 'admin'],

		'includes' => [
			['resources/favicon.ico', false, 'favicon', 'head'],
			['resources/cover.css', false, 'link_css', 'head']
		]

	];
