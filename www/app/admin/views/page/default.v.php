<?php

	$admin_data = $this->getData('admin_data');
	
?>
<h1><?=$this->getData('page_title')?></h1>

<p>Vítejte v administraci aplikace <strong>Belbinův test týmových rolí</strong>.</p>

<p>Tato část stránek je určena pro správce. Zde můžete upravovat vlastnosti testu - <a href="<?=$this->url('admin/belbin_roles') ?>">týmové role</a> a
<a href="<?=$this->url('admin/belbin_questions') ?>">otázky a odpovědi</a>. Můžete také mazat nebo upravovat <a href="<?=$this->url('admin/belbin_tests') ?>">výsledky</a>.
</p>

<p>K dnešnímu dni byl test vyplňen celkem <strong><?=$admin_data['total_tests_finished'] ?></strong>-krát 
a registrovalo se <strong><?=$admin_data['total_registered_customers'] ?></strong> <a href="<?=$this->url('admin/customers') ?>">uživatelů</a>.
</p>

<p>
	<a class="btn btn-primary" href="<?=$this->url('') ?>">Přejít do veřejné části stránek &raquo;</a>		
</p>