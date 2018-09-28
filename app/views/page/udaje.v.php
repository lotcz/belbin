<?php
	$test_id = $this->getData('test_id');
?>

<p>
		Abychom mohli výsledky testů statisticky vyhodnotit a zjistit něco zajímavého, potřebujeme od Vás vyplnit základní demografické údaje.
</p>

<p>
		Tyto údaje jsou naprosto anonymní, nelze je nijak spojit s Vaší osobou a uchováváme je důkladně zabezpečené.
		Přesto nám je sdělovat nemusíte, pokud nechcete.
</p>

<form method="POST" class="p-2">
	<input type="hidden" name="test_id" value="<?=$test_id ?>" />
	<input type="hidden" name="form_token" value="<?=$this->getData('form_token') ?>" />

	<h2>Rok narození</h2>

	<div class="p-2">
		<div class="form-group row">
			<label class="col-sm-3 col-form-label" for="rok">Uveďte Váš rok narození:</label>
			<div class="col-sm-9">
				<input class="form-control" placeholder="Rok" style="width:2cm" name="rok" id="rok" type="text" />
			</div>
		</div>

		<div class="form-group row">
			<div class="custom-control custom-checkbox offset-sm-3 col-sm-9">
		    <input type="checkbox" class="custom-control-input" id="customControlInline">
		    <label class="custom-control-label" for="customControlInline">Remember my preference</label>
		  </div>
		</div>

	</div>

	<h2>Pohlaví</h2>

	<label for="pohlavi">Uveďte Vaše pohlaví:</label>
	<input name="pohlavi" id="pohlavi" type="number" />

	<input id="confirm_button" type="submit" class="btn btn-success btn-lg" value="Zobrazit výsledek testu">

</form>
