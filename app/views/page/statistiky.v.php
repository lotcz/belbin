<p>
	Na této stránce si můžete prohlédnout nejrůznější statistiky o úspěšně dokončených testech.
	Pokud jste si ještě test nevyplnili, můžete tak učinit <a href="<?=$this->url('test') ?>" role="button">zde</a>.
</p>

<br />

<h2>Celkové výsledky</h2>

<div class="row mb-2">
	<div class="col-md-4">
		Celkový počet dokončených testů:
	</div>
	<div class="col-md-2">
		<strong><?=$this->getData('total_tests_finished') ?></strong>
	</div>
</div>

<div class="row mb-2">
	<div class="col-md-4">
		Průměrný čas potřebný k dokončení testu:
	</div>
	<div class="col-md-2">
		<strong><?=TestModel::formatDuration($this, $this->getData('average_duration')) ?></strong>
	</div>
</div>

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
							<td><?=$this->formatDecimal($result->fval('percentage'), 2) ?> %</td>
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
		Průměrný čas potřebný k dokončení testu:<br/>
		<strong><?=TestModel::formatDuration($this, $this->getData('average_test_duration_male')) ?></strong><br/>
		<hr/>
		<strong>Dominance rolí:</strong><br/>
		<table class="test-results">
			<?php
				$male_totals = $this->getData('totals_male');
				foreach ($male_totals as $result) {
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
		<canvas id="male_totals_chart"></canvas>
	</div>
	<div class="col-md-6 text-center">
		<h3>Ženy</h3>
		Celkový počet dokončených testů:<br/>
		<strong><?=$this->getData('total_tests_finished_female') ?></strong><br/>
		Průměrný čas potřebný k dokončení testu:<br/>
		<strong><?=TestModel::formatDuration($this, $this->getData('average_test_duration_female')) ?></strong><br/>
		<hr/>
		<strong>Dominance rolí:</strong><br/>
		<table class="test-results">
			<?php
				$female_totals = $this->getData('totals_female');
				foreach ($female_totals as $result) {
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
		<canvas id="female_totals_chart"></canvas>
	</div>
</div>

<br />
<hr/>
<br />

<h2>Výsledky podle věku</h2>

<p>
	Statistiky rozdělené podle věku testovaných osob.
	Osoby jsou rozdělené do skupin podle věku, kde každá skupina zahrnuje 5 let.
	Zahrnuty jsou pouze ty testy, kde testovaná osoba uvedla svůj věk.
</p>

<div class="row mb-2">
	<div class="col-md-4">
		Celkem nám sdělilo svůj věk:
	</div>
	<div class="col-md-2">
		<strong><?=$this->getData('total_tests_finished_age') ?></strong> osob
	</div>
	<div class="col-md-4">
		Nejmladší testovaná osoba:
	</div>
	<div class="col-md-2">
		<strong><?=$this->getData('min_age') ?></strong> let
	</div>
</div>

<div class="row mb-2">
	<div class="col-md-4">
		Průměrný věk:
	</div>
	<div class="col-md-2">
		<strong><?=$this->getData('average_age') ?></strong> let
	</div>
	<div class="col-md-4">
		Nestarší testovaná osoba:
	</div>
	<div class="col-md-2">
			<strong><?=$this->getData('max_age') ?></strong> let
	</div>
</div>

<br/>

<p class="font-italic text-center">
	TIP: Kliknutím na název role můžete roli v grafu skrýt.
</p>
<canvas id="age_totals_chart"></canvas>
