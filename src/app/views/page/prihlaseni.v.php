<form method="post" id="login_form" action="<?=$this->url('prihlaseni', $this->return_path)?>" class="form-horizontal" >
	<div class="form-group row">
		<label for="email" class="col-sm-2 control-label"><?=$this->t('E-mail') ?>:</label>
		<div class="col-sm-4">
			<input type="text" id="email" name="email" class="form-control" value="<?=$this->xssafe(z::get('email')) ?>" required />
		</div>
		<div class="col-sm-6 form-validation" id="email_validation_email"><?=$this->t('Vložte prosím platnou emailovou adresu.') ?></div>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-2 control-label"><?=$this->t('Heslo') ?>:</label>
		<div class="col-sm-4">
			<input type="password" id="password" name="password" class="form-control" required />
		</div>
		<div class="col-sm-6 form-validation" id="password_validation_password"><?= $this->t('Vložte prosím Vaše heslo.') ?></div>
	</div>
	<div class="row justify-content-end">
		<div class="form-buttons col-sm-10">
			<input type="submit" onclick="javascript:login_validate(event);" class="btn btn-success form-button" value="<?=$this->t('Přihlásit') ?>" />
			<a class="form-button" href="<?=$this->url('zapomenute-heslo', $this->return_path)?><?=(isset($_POST['email']) && strlen($_POST['email']) > 0) ? '&email=' . $this->xssafe($_POST['email']) : '' ?>"><?=$this->t('Zapomenuté heslo') ?></a>
			<a class="form-button" href="<?=$this->url('registrace', $this->return_path)?><?=(isset($_POST['email']) && strlen($_POST['email']) > 0) ? '&email=' . $this->xssafe($_POST['email']) : '' ?>"><?=$this->t('Chci se registrovat') ?></a>
		</div>
	</div>
</form>

<script>
	function login_validate(e) {
		e.preventDefault();
		var frm = new formValidation('login_form');
		frm.add('email', 'email');
		frm.add('password', 'password');
		frm.submit();
	}
</script>
