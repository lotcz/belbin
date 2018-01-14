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
	</div>
</div>

<div class="stats-large">
	<div class="stat-value text-large border border-primary rounded"><?=TestModel::formatDuration($this, $this->getData('test_duration')) ?></div>
	<p>Tolik času vám zabralo vyplnění testu.</p>
</div>

<div class="p-2">
	<p class="text-center">
		<?php
			$this->renderLink('test', 'Otestovat se znovu &raquo;', 'btn btn-lg btn-success no-print');
		?>
	</p>
</div>