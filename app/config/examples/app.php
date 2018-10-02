<?php

	return [

		// this is application version
		// integer part should be identical with GIT branch name
		'version' => 3.2,

    // required zEngine major version (integer value)
		'require_z_version' => 3,

		// this is minimum required zEngine version
		'minimum_z_version' => 3.2,

		// list of modules that will be automatically loaded
		'modules' => ['resources', 'db', 'jobs', 'i18n', 'auth', 'admin', 'menu', 'forms'],

		'includes' => [
			['style.css', false, 'link_css', 'head'],
			['print-style.css', false, 'print_css', 'head'],
			['favicon.ico', false, 'favicon', 'head'],
			['chart.min.js', false, 'link_js', 'bottom']
			//['https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js', true, 'link_js', 'bottom']
		]

	];
