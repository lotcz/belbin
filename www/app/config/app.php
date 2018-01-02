<?php

	return [

		// application version
		// should be identical with GIT branch name
		'version' => 0.1,

		// minimum required zEngine version
		// should be identical with GIT branch name
		'require_z_version' => 1.1,

		// list of modules that will be automatically loaded
		'modules' => ['mysql', 'admin', 'menu', 'forms', 'custauth'],
		
		'includes' => [			
			['https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', true, 'link_js', 'bottom']			
		]

	];