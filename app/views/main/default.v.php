<?php
	$this->renderPartialView('nav');
?>

<main class="container">

	<h1 class="page-title display-4"><?=$this->data['page_title'] ?></h1>
	<hr>

	<?php
		$this->renderPartialView('messages');
		$this->renderPageView();
	?>

</main>

<footer class="container text-right">
	<hr>
	<p>&copy; Karel Zavadil 2018.</p>
</footer>
