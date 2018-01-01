<?php
	$results = $this->getData('results');
	$total_score = $this->getData('total_score');
?>

<div class="row">
	<div class="col-md-6">
		<table class="test-results">
			<tr>
				<th></th>
				<th>Název role</th>
				<th>Přidělené body</th>
				<th></th>
			</tr>

			<?php

				foreach ($results as $result) {
					?>
						<tr>
							<td><div class="role-badge" style="background-color:<?=$result->val('belbin_role_color') ?>"></div></td>
							<td><?=$result->val('belbin_role_name') ?></td>
							<td><?=$result->val('score') ?></td>
							<td><?=$this->formatDecimal(($result->ival('score') / $total_score)*100, 2) ?> %</td>
						</tr>
					<?php
				}

			?>
			
		</table>
	</div>

	<div class="col-md-6">
		<canvas id="test_chart"></canvas>
		<script>					
			$(function () {					
				var options = Chart.defaults.pie;				
				options.tooltips.enabled = false;
				options.legend.display = false;
				options.events = null;
		
				var myPieChart = new Chart(
					'test_chart',
					{
						type: 'pie',
						data: chart_data,
						options: options
					}
				);
			});
		</script>		
	</div>
</div>

<div class="p-2">
	<p class="text-center">
		<?php
			$this->renderLink('test', 'Otestovat se znovu &raquo;', 'btn btn-success');
		?>
	</p>
</div>