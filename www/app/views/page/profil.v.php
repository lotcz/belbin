<a class="btn btn-primary" href="<?=$this->url('zmena-hesla'); ?>" ><?=$this->t('Change password'); ?></a>

<hr/>

<?php
	$tests = $this->getData('tests');
		
	foreach ($tests as $test) {
		?>
			<div class="row">
				<div class="col-md-6">
					Začátek testu: <strong><?=$this->formatDateTime($test->dtval('belbin_test_start_date'))?></strong>
					<br/>
					Doba vypracování: <strong><?=TestModel::formatDuration($this, $test->dtval('belbin_test_end_date')-$test->dtval('belbin_test_start_date'))?></strong>
					<br/>
					Dominantní role: <strong><?=$test->results[0]->val('belbin_role_name')?>, <?=$test->results[1]->val('belbin_role_name')?></strong>
					<br/><br/>
					<a href="<?=$this->url('default/default/result/' . $test->val('belbin_test_id')) ?>" class="btn btn-primary">Celý výsledek &raquo;</a>
				</div>
				
				<div class="col-md-6">
					<canvas id="chart_test_<?=$test->val('belbin_test_id') ?>"></canvas>					
				</div>
			</div>
		<?php
	}
?>