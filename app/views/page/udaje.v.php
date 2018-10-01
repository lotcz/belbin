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

<form method="POST" class="p-2" id="demographic_form">
	<input type="hidden" name="test_id" value="<?=$test_id ?>" />
	<input type="hidden" name="form_token" value="<?=$this->getData('form_token') ?>" />

	<h2>Rok narození</h2>

	<div class="p-2">
		<div class="form-group row">
			<label class="col-sm-3 col-form-label" for="rok">Uveďte Váš rok narození:</label>
			<div class="col-sm-9">
				<input class="form-control" placeholder="Rok" style="width:2cm" name="rok" maxlength="4" id="rok" type="text" />
			</div>
		</div>
		<div class="form-group row">
			<div class="custom-control custom-checkbox offset-sm-3 col-sm-9">
		    <input type="checkbox" class="custom-control-input" name="neuvadet_rok" id="neuvadet_rok">
		    <label class="custom-control-label custom-checkbox-label" for="neuvadet_rok">Nepřeji si uvádět</label>
		  </div>
		</div>
	</div>

	<h2>Pohlaví</h2>

	<div class="p-2">
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Uveďte Vaše pohlaví:</label>
			<div class="col-sm-9">
				<div class="py-2 custom-control custom-radio">
					<input class="custom-control-input" type="radio" name="pohlavi" id="pohlavi1" value="1">
					<label class="custom-control-label" for="pohlavi1">Muž</label>
				</div>
				<div class="py-2 custom-control custom-radio">
					<input class="custom-control-input" type="radio" name="pohlavi" id="pohlavi0" value="0">
				 	<label class="custom-control-label" for="pohlavi0">Žena</label>
				</div>
				<div class="py-2 custom-control custom-radio">
					<input class="custom-control-input" type="radio" name="pohlavi" id="neuvadet_pohlavi" value="">
				 	<label class="custom-control-label" for="neuvadet_pohlavi">Nepřeji si uvádět</label>
				</div>
			</div>
		</div>
	</div>

	<input id="confirm_button" type="submit" class="btn btn-success btn-lg offset-sm-3" value="Zobrazit výsledek testu">

</form>
