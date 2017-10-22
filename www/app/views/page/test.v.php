<?php
	$question_text = $this->getData('question_text');
	$answers = $this->getData('answers');
	$prev_question = $this->getData('prev_question');
	$next_question = $this->getData('next_question');
?>

<h2><?=$question_text ?></h2>

<?php

	foreach ($answers as $answer) {
		?>
			<label for="answer_<?=$answer->val('belbin_answer_id') ?>">
				<?=$answer->val('belbin_answer_id') ?>
			</label>
			<input type="checkbox" id="answer_<?=$answer->val('belbin_answer_id') ?>" name="answer_<?=$answer->val('belbin_answer_id') ?>" />
		<?php
	}
