<?php
	$results = $this->getData('results');
	$total_score = $this->getData('total_score');
?>

<div class="stats-large">
	<p>Vyplnění testu Vám zabralo:</p>
	<div class="stat-value text-large border border-primary rounded">
		<?=TestModel::formatDuration($this, $this->getData('test_duration')) ?>
	</div>
</div>

<h2 class="text-center">Dominance rolí:</h2>

<br />

<div class="row">
	<div class="col-md-6">
		<table class="test-results">
			<tr>
				<th></th>
				<th>Název role</th>
				<th><span class="d-none d-sm-block">Přidělené body</span><span class="d-block d-sm-none">Body</span></th>
				<th></th>
			</tr>

			<?php

				foreach ($results as $result) {
					?>
						<tr>
							<td class="py-1"><div class="role-badge role-badge-small" style="background-color:<?=$result->val('belbin_role_color') ?>"></div></td>
							<td class="py-1"><?=$result->val('belbin_role_name') ?></td>
							<td class="py-1 text-center"><?=$result->val('score') ?></td>
							<td class="py-1"><?=$this->formatDecimal(($result->ival('score') / $total_score)*100, 2) ?>&nbsp;%</td>
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

<div class="clearfix"></div>

<br />
<br />

<p class="text-center no-print">
	<button class="btn btn-lg btn-primary" onclick="javascript:window.print();">Vytisknout výsledek</button><br/>
	<span class="font-italic">TIP: Pokud si chcete výsledek testu uchovat ve formátu PDF, zvolte v menu tisku jako výstupní zařízení export do PDF.</span>
</p>
