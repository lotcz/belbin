<?php

	$this->setPageTitle('Týmové role');

	$roles = zModel::Select(
	/* db */		$this->z->db,
	/* table */		'belbin_role',
	/* where */		null,
	/* bindings */	null,
	/* types */		null,
	/* paging */	null,
	/* orderby */	'belbin_role_id'
	);

	$this->setData('roles', $roles);
