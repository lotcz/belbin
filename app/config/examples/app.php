<?php

	return [

		// this is application version
		// should be identical with GIT branch name
		'version' => 3.0,

    // required zEngine major version (integer value)
		'require_z_version' => 3,

		// this is minimum required zEngine version
		'minimum_z_version' => 3.0,

		// list of modules that will be automatically loaded
		'modules' => ['resources', 'db', 'auth', 'admin', 'menu', 'forms'],

		'includes' => [
			['https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', true, 'link_js', 'bottom']
		]

	];