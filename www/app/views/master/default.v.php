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

		<?php
			$this->renderIncludes('head');			
		?>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		
		<nav class="navbar navbar-expand-md navbar-dark fixed-top">
			<?php
				$this->renderLink('', 'Belbinův test online', 'navbar-brand');
			?>
		  
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
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
							if ($this->isCustAuth()) {
								?>
									<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?=($this->z->custauth->isAnonymous()) ? 'Anonym' : $this->z->custauth->customer->val('customer_email') ?>
									</a>
						
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">										
										<?php
											if ($this->z->custauth->isAnonymous()) {
												$this->renderLink('login', 'Přihlásit', 'dropdown-item');
												$this->renderLink('register', 'Registrovat se', 'dropdown-item');
											} else {
												$this->renderLink('profil', 'Můj profil', 'dropdown-item');
												$this->renderLink('logout', 'Odhlásit', 'dropdown-item');
											}
										?>										
									</div>
								<?php
							} else {
								?>
									<li class="nav-item <?=($this->raw_path == 'login') ? 'active' : ''; ?>">
										<?php
											$this->renderLink('login', 'Přihlásit', 'nav-link');
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

		<footer class="container">
			<hr>
			<p>&copy; Karel Zavadil 2018. Z-engine v. <strong><?=$this->z->version ?></strong>. Application version <strong><?=$this->z->app->version ?></strong>.</p>
		</footer>
	
		<?php
			$this->renderIncludes('default');
			$this->renderIncludes('bottom');
		?>
	</body>
</html>
