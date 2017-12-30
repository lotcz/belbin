<?php

	$this->setPageTitle('Týmové role');
	
	$roles = zModel::Select(
	/* db */		$this->db,
	/* table */		'belbin_roles',
	/* where */		null,
	/* bindings */	null,
	/* types */		null,
	/* paging */	null,
	/* orderby */	'belbin_role_id'
	);

	$this->setData('roles', $roles);