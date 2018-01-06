<h2>Otázka:</h2>

<?php
	$this->z->forms->renderForm($this->getData('form'));
?>

<h2>Odpovědi:</h2>

<?php
	$this->z->tables->renderTable($this->getData('table'));
?>

<?php
	$question_id = $this->getData('question_id');
	if (isset($question_id) && $question_id > 0) {
		?>
			<form action="<?=$this->url('admin/default/default/belbin_answer') ?>" method="GET">
				<div class="form-buttons">	
					<input name="question_id" value="<?=$question_id ?>" type="hidden">
					<input name="r" value="<?=$this->raw_path ?>" type="hidden">
					<input class="btn btn-success form-button" value="Přidat odpověď" type="submit">
				</div>
			</form>
		<?php
	}
?>