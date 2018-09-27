<!DOCTYPE html>
<html lang="<?=$this->z->i18n->selected_language->val('language_code') ?>">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<meta name="description" content="Belbinův test online.">
		<meta name="author" content="Karel Zavadil">
		<link rel="icon" href="/favicon.ico">

		<title><?=$this->getFullPageTitle() ?></title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="<?=$this->url('style.css') ?>">
		<link rel="stylesheet" href="<?=$this->url('print-style.css') ?>" type="text/css" media="print" />

		<?php
			$this->renderIncludes('head');
		?>

	</head>

	<body>

		<nav class="navbar navbar-expand-md navbar-dark fixed-top">
			<?php
				$this->renderLink('', 'Belbinův test online', 'navbar-brand');
			?>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">&nbsp;</span>
			</button>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item <?=($this->raw_path == 'o-testu') ? 'active' : ''; ?>">
						<?php
							$this->renderLink('o-testu', 'O testu', 'nav-link');
						?>
					</li>

					<li class="nav-item <?=($this->raw_path == 'tymove-role') ? 'active' : ''; ?>">
						<?php
							$this->renderLink('tymove-role', 'Týmové role', 'nav-link');
						?>
					</li>

					<li class="nav-item <?=($this->raw_path == 'statistiky') ? 'active' : ''; ?>">
						<?php
							$this->renderLink('statistiky', 'Statistiky', 'nav-link');
						?>
					</li>
				</ul>

				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<?php
							if ($this->z->auth->isAuth()) {
								?>
									<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?=($this->z->auth->isAnonymous()) ? 'Anonym' : $this->z->auth->user->val('user_email') ?>
									</a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
										<?php
											if ($this->z->auth->isAnonymous()) {
												$this->renderLink('prihlaseni', 'Sign In', 'dropdown-item');
												$this->renderLink('registrace', 'Register', 'dropdown-item');
											} else {
												$this->renderLink('profil', 'Můj profil', 'dropdown-item');
												$this->renderLink('odhlaseni', 'Odhlásit', 'dropdown-item');
											}
										?>
									</div>
								<?php
							} else {
								?>
									<li class="nav-item <?=($this->raw_path == 'login') ? 'active' : ''; ?>">
										<?php
											$this->renderLink('prihlaseni', 'Sign In', 'nav-link');
										?>
									</li>
								<?php
							}
						?>

					</li>
				</ul>
			</div>
		</nav>

		<main role="main">
			<?php
				$this->renderMainView();
			?>
		</main>

		<footer class="container text-right">
			<hr>
			<p>&copy; Karel Zavadil 2018.</p>
		</footer>

		<?php
			$this->renderIncludes('default');
		?>

		<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
		<script
				src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
				integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
				crossorigin="anonymous"></script>
		<script
				src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
				integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
				crossorigin="anonymous"></script>

		<?php
			$this->renderIncludes('bottom');
		?>
	</body>
</html>
