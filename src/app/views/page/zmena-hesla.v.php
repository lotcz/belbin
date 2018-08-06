<form method="post" id="changepass_form" action="<?=$this->url('zmena-hesla', $this->return_path)?>" class="form-horizontal" >	
	<div class="form-group row">
		<label for="password" class="col-sm-2 control-label"><?=$this->t('Heslo') ?>:</label>
		<div class="col-sm-4">
			<input type="password" id="password" name="password" class="form-control" required />
		</div>
		<div class="col-sm-6 form-validation" id="password_validation_password"><?= $this->t('Vložte prosím Vaše heslo.') ?></div>
	</div>
	<div class="form-group row">
		<label for="password_confirm" class="col-sm-2 control-label"><?=$this->t('Potvrzení hesla') ?>:</label>
		<div class="col-sm-4">
			<input type="password" id="password_confirm" name="password_confirm" class="form-control" required />
		</div>
		<div class="col-sm-6 form-validation" id="password_confirm_validation_confirm"><?=$this->t('Hesla se neshodují.') ?></div>
	</div>
	<div class="row justify-content-end">
		<div class="form-buttons col-sm-10">
			<input type="submit" onclick="javascript:changepass_validate(event);" class="btn btn-success form-button" value="<?=$this->t('Change password') ?>" />
			<a class="form-button" href="<?=$this->url('profil', $this->return_path)?>"><?=$this->t('Zpět na profil') ?></a>
		</div>
	</div>
</form>

<script>
	function changepass_validate(e) {
		e.preventDefault();
		var frm = new formValidation('changepass_form');
		frm.add('password', 'password');
		frm.add('password_confirm', 'confirm', 'password');
		frm.submit();
	}
</script>