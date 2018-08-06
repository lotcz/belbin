<?php

	return [

		// application version
		'version' => 1,

		// minimum required zEngine version
		'require_z_version' => 2.0,

		// this is minimum required zEngine version
		'minimum_z_version' => 2.0,

		// list of modules that will be automatically loaded
		'modules' => ['resources', 'mysql', 'admin', 'menu', 'forms', 'custauth'],

		'includes' => [
			['https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', true, 'link_js', 'bottom']
		]

	];
