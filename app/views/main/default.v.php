<?php
	$this->renderPartialView('nav');
?>

<div class="container">

	<h1 class="page-title display-4"><?=$this->data['page_title'] ?></h1>
	<hr>

	<?php
		$this->renderPartialView('messages');
		$this->renderPageView();
	?>

</div>

<footer class="container text-right">
	<hr>
	<p>&copy; Karel Zavadil 2018.</p>
</footer>