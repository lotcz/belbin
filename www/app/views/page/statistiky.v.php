<p>
	Na této stránce si můžete prohlédnout nejrůznější statistiky o úspěšně dokončených testech.
	Pokud jste si ještě test nevyplnili, můžete tak učinit <a href="<?=$this->url('test') ?>" role="button">zde</a>.
</p>

<div class="stats-large">
	<div class="stat-value text-large border border-success rounded"><?=$this->getData('total_tests_finished') ?></div>
	<p>Celkový počet dokončených testů.</p>
</div>

<hr/>

<div class="stats-large">
	<div class="stat-value text-large border border-primary rounded"><?=TestModel::formatDuration($this, $this->getData('average_duration')) ?></div>
	<p>Čas, který v průměru naši návštěvníci potřebovali k dokončení testu.</p>
</div>

<hr/>

<div class="stats-large">
	<div class="stat-value text-large border border-danger rounded"><?=TestModel::formatDuration($this, $this->getData('total_duration')) ?></div>
	<p>Čas, který dohromady naši návštěvníci strávili vyplňováním testu.</p>
</div>

<hr/>

<h2>Dominance rolí</h2>

<p>Toto je průměrná dominance jednotlivých rolí tak, jak vyšla v souhrnu všem testovaným na této stránce.</p>

<div class="row">
	<div class="col-md-4">
		<table class="test-results">
			<tr>
				<th></th>
				<th>Název role</th>
				<th>Dominance</th>
			</tr>

			<?php

				$totals = $this->getData('totals');

				foreach ($totals as $result) {
					?>
						<tr>
							<td><div class="role-badge" style="background-color:<?=$result->val('belbin_role_color') ?>"></div></td>
							<td><?=$result->val('belbin_role_name') ?></td>
							<td><?=$this->formatDecimal($result->fval('percentage'), 2) ?> %</td>
						</tr>
					<?php
				}

			?>
			
		</table>
	</div>

	<div class="col-md-8">
		<canvas id="totals_chart"></canvas>		
	</div>
</div>