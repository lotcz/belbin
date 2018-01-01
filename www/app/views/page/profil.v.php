<?php
	$tests = $this->getData('tests');
		
	foreach ($tests as $test) {
		?>
			<div class="row">
				<div class="col-md-6">
					Začátek testu: <strong><?=$this->formatDateTime($test->dtval('belbin_test_start_date'))?></strong>
					<br/>
					Doba vypracování: <strong><?=$this->formatDuration($test->dtval('belbin_test_end_date')-$test->dtval('belbin_test_start_date'))?></strong>
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

<script>	
	
	$(function () {
		var charts = [];
		var chart_options = Chart.defaults.pie;
		chart_options.tooltips.enabled = false;
		chart_options.legend.display = false;
		chart_options.events = null;
		
		for (var i = 0, max = chart_data.length; i < max; i++) {			
			charts.push(new Chart(
				'chart_test_' + chart_data[i].test_id,
				{
					type: 'pie',
					data: chart_data[i].data,
					options: chart_options
				}
			));
		}	
		
	});
</script>