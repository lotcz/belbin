<p>
	Na této stránce si můžete prohlédnout statistiky o dokončených testech.
	Pokud jste si ještě test nevyplnili, můžete tak učinit <a href="<?=$this->url('test') ?>" role="button">zde</a>.
</p>

<br />

<h2>Celkové výsledky</h2>

<div class="row mb-2">
	<div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
		Celkový počet dokončených testů:
	</div>
	<div class="col-sm-4 col-md-6">
		<strong><?=$this->getData('total_tests_finished') ?></strong>
	</div>

	<div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
		Medián trvání testu:
	</div>
	<div class="col-sm-4 col-md-6">
		<strong><?=TestModel::formatDuration($this, $this->getData('median_duration')) ?></strong>
	</div>
</div>

<?php

	if ($this->getData('total_tests_finished') > 0) {
		?>
			<br />

			<p>Průměrná dominance jednotlivých rolí tak, jak vyšla v souhrnu všem testovaným na této stránce:</p>

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
										<td><?=$this->formatDecimal($result->fval('percentage'), 2) ?>&nbsp;%</td>
									</tr>
								<?php
							}

						?>

					</table>
				</div>

				<div class="col-md-8 mt-4">
					<canvas id="totals_chart"></canvas>
				</div>
			</div>
		<?php
	}
?>

<br />
<hr />
<br />

<h2>Výsledky podle pohlaví</h2>

<p>Statistiky rozdělené podle pohlaví testovaných osob. Zahrnuty jsou pouze ty testy, kde testovaná osoba uvedla své pohlaví.</p>

<div class="row py-2">
	<div class="col-md-6 text-center">
		<h3>Muži</h3>
		Celkový počet dokončených testů:<br/>
		<strong><?=$this->getData('total_tests_finished_male') ?></strong><br/>
		Medián trvání testu:<br/>
		<strong><?=TestModel::formatDuration($this, $this->getData('median_test_duration_male')) ?></strong><br/>
		<hr/>
		<?php
			if ($this->getData('total_tests_finished_male') > 0) {
				?>
					<strong>Dominance rolí:</strong><br/>
					<table class="test-results text-left">
						<?php
							$male_totals = $this->getData('totals_male');
							foreach ($male_totals as $result) {
								?>
									<tr>
										<td><div class="role-badge" style="background-color:<?=$result->val('belbin_role_color') ?>"></div></td>
										<td><?=$result->val('belbin_role_name') ?></td>
										<td><?=$this->formatDecimal($result->fval('percentage'), 2) ?>&nbsp;%</td>
									</tr>
								<?php
							}
						?>
					</table>
					<canvas class="mt-4" id="male_totals_chart"></canvas>
				<?php
			}
		?>
		<hr class="d-block d-md-none"/>
	</div>
	<div class="col-md-6 text-center">
		<h3>Ženy</h3>
		Celkový počet dokončených testů:<br/>
		<strong><?=$this->getData('total_tests_finished_female') ?></strong><br/>
		Medián trvání testu:<br/>
		<strong><?=TestModel::formatDuration($this, $this->getData('median_test_duration_female')) ?></strong><br/>
		<hr/>
		<?php
			if ($this->getData('total_tests_finished_female') > 0) {
				?>
					<strong>Dominance rolí:</strong><br/>
					<table class="test-results text-left">
						<?php
							$female_totals = $this->getData('totals_female');
							foreach ($female_totals as $result) {
								?>
									<tr>
										<td><div class="role-badge" style="background-color:<?=$result->val('belbin_role_color') ?>"></div></td>
										<td><?=$result->val('belbin_role_name') ?></td>
										<td><?=$this->formatDecimal($result->fval('percentage'), 2) ?>&nbsp;%</td>
									</tr>
								<?php
							}
						?>
					</table>
					<canvas class="mt-4" id="female_totals_chart"></canvas>
				<?php
			}
		?>
		<hr class="d-block d-md-none"/>
	</div>
</div>

<div class="d-none d-md-block">
	<br />
	<hr/>
	<br />
</div>

<h2>Výsledky podle věku</h2>

<p>
	Statistiky rozdělené podle věku testovaných osob.
	Osoby jsou rozdělené do skupin podle věku, kde každá skupina zahrnuje 5 let.
	Zahrnuty jsou pouze ty testy, kde testovaná osoba uvedla svůj věk.
</p>

<div class="row mb-2">
	<div class="col-8 col-md-4">
		Celkem nám sdělilo svůj věk:
	</div>

	<div class="col-4 col-md-2">
		<strong><?=$this->getData('total_tests_finished_age') ?></strong> osob
	</div>

	<div class="col-8 col-md-4">
		Nejmladší testovaná osoba:
	</div>

	<div class="col-4 col-md-2">
		<strong><?=$this->getData('min_age', 0) ?></strong> let
	</div>

	<div class="col-8 col-md-4">
		Průměrný věk:
	</div>

	<div class="col-4 col-md-2">
		<strong><?=$this->getData('average_age', 0) ?></strong> let
	</div>

	<div class="col-8 col-md-4">
		Nejstarší testovaná osoba:
	</div>

	<div class="col-4 col-md-2">
			<strong><?=$this->getData('max_age', 0) ?></strong> let
	</div>

	<div class="col-8 col-md-4">
		Medián věku:
	</div>

	<div class="col-4 col-md-2">
		<strong><?=$this->getData('median_age', 0) ?></strong> let
	</div>
</div>

<?php
	if ($this->getData('total_tests_finished_age') > 0) {
		?>
			<br/>

			<p class="font-italic text-center">
				TIP: Kliknutím na název role můžete roli v grafu skrýt.
			</p>
			<canvas id="age_totals_chart"></canvas>
		<?php
	}
?>
