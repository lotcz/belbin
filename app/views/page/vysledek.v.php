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

	<div class="col-md-6 mt-4">
		<canvas id="test_chart"></canvas>
	</div>
</div>

<div class="stats-large">
	<div class="stat-value text-large border border-primary rounded"><?=TestModel::formatDuration($this, $this->getData('test_duration')) ?></div>
	<p>Tolik času vám zabralo vyplnění testu.</p>
</div>

<p class="no-print">
	<button class="btn btn-lg btn-primary" onclick="javascript:window.print();">Vytisknout výsledek</button><br/>
	<span class="font-italic">TIP: Pokud si chcete výsledek testu uchovat ve formátu PDF, zvolte v menu tisku jako výstupní zařízení export do PDF.</span>
</p>
