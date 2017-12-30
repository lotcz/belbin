<?php

	return [

		// application version
		// should be identical with GIT branch name
		'version' => 0.1,

		// minimum required zEngine version
		// should be identical with GIT branch name
		'require_z_version' => 1.1,

		// list of modules that will be automatically loaded
		'modules' => ['mysql', 'i18n', 'forms', 'custauth'],
		
		'includes' => [
			['https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css', true, 'link_css', 'head'],
			['style.css', false, 'link_css', 'head'],
			['https://code.jquery.com/jquery-3.2.1.slim.min.js', true, 'link_js', 'head'],
			['https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', true, 'link_js', 'bottom'],
			['https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js', true, 'link_js', 'bottom'],
			['https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', true, 'link_js', 'bottom']			
		]

	];
