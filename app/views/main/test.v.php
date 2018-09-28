<?php
	$this->renderPartialView('test-nav');
?>

<div class="container">

	<h1 class="page-title display-4"><?=$this->data['page_title'] ?></h1>
	<hr>

	<?php
		$this->renderPartialView('messages');
		$this->renderPageView();
	?>

</div>

<br>
<br>
