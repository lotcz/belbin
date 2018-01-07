<p>
	Na této stránce si můžete prohlédnout nejrůznější statistiky o úspěšně dokončených testech.
	K dnešnímu dni byl test vyplněn celkem <strong><?=$this->getData('total_tests_finished') ?></strong>-krát.
	Pokud jste tak ještě neučinili, můžete test vyplnit <a href="<?=$this->url('test') ?>" role="button">zde</a>.
</p>

<?php
	$totals = $this->getData('totals');
	$total_score = $this->getData('total_score');
	$average_duration = $this->getData('average_duration');
?>

<div class="row">
	<div class="col-md-6">
		Trvání: <?=$this->formatDuration($average_duration) ?>
	</div>

	<div class="col-md-6">
		
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<table class="test-results">
			<tr>
				<th></th>
				<th>Název role</th>
				<th>Dominance</th>
			</tr>

			<?php

				foreach ($totals as $result) {
					?>
						<tr>
							<td><div class="role-badge" style="background-color:<?=$result->val('belbin_role_color') ?>"></div></td>
							<td><?=$result->val('belbin_role_name') ?></td>
							<td><?=$this->formatDecimal(($result->ival('score') / $total_score)*100, 2) ?> %</td>
						</tr>
					<?php
				}

			?>
			
		</table>
	</div>

	<div class="col-md-8">
		<canvas id="totals_chart"></canvas>
		<script>
						
			function initTotalsChart() {					
				var options = Chart.defaults.pie;
				options.animation.animateRotate = false;
				options.legend.display = false;
				
				var totalsChart = new Chart(
					'totals_chart',
					{
						type: 'pie',
						data: totals_chart_data,
						options: options
					}
				);
			}
			
			function initCharts() {
				initTotalsChart();
			}
			
			document.body.addEventListener('load', initCharts, true);
			
		</script>
	</div>
</div>