<form method="post" id="register_form" action="<?=$this->url('register', $this->return_path)?>" class="form-horizontal" >
	<div class="form-group row">
		<label for="email" class="col-sm-2 control-label"><?=$this->t('E-mail') ?>:</label>
		<div class="col-sm-4">
			<input type="text" id="email" name="email" class="form-control" value="<?=z::get('email') ?>" required />
		</div>
		<div class="col-sm-6 form-validation" id="email_validation_email"><?=$this->t('Vložte prosím platnou emailovou adresu.') ?></div>
		<div class="col-sm-6 form-validation" id="email_validation_exists"><?=$this->t('Uživatel s touto emailovou adresou je již u nás registrován!') ?></div>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-2 control-label"><?=$this->t('Heslo') ?>:</label>
		<div class="col-sm-4">
			<input type="password" id="password" name="password" class="form-control" required />
		</div>
		<div class="col-sm-6 form-validation" id="password_validation_password"><?=$this->t('Vložte prosím heslo dlouhé alespoň 5 znaků.') ?></div>
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
			<input type="submit" onclick="javascript:register_validate(event);return false;" class="btn btn-success form-button" value="<?=$this->t('Register') ?>" />
			<a class="form-button" href="<?=$this->url('forgotten-password', $this->return_path)?><?=(isset($_POST['email']) && strlen($_POST['email']) > 0) ? '&email=' . $_POST['email'] : '' ?>"><?=$this->t('Zapomenuté heslo') ?></a>
			<a class="form-button" href="<?=$this->url('login')?>"><?=$this->t('Přihlásit se') ?></a>
		</div>
	</div>
</form>