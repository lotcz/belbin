<?php
	$test = $this->getData('test');
	$question = $this->getData('question');
	$answers = $this->getData('answers');
	$prev_question = $this->getData('prev_question');
?>

<h2><?=$question->val('belbin_question_text') ?></h2>

<?php
	$this->renderLink('test', 'Restart test');
?>

<p>
Test started: <?=$test->val('belbin_test_start_date'); ?>
</p>

<form method="POST">
	<input type="hidden" name="test_id" value="<?=$test->val('belbin_test_id') ?>" />
	<input type="hidden" name="question_id" value="<?=$question->val('belbin_question_id') ?>" />

	<?php

		foreach ($answers as $answer) {
			?>
				<p>
					<input type="checkbox" id="answer_<?=$answer->val('belbin_answer_id') ?>" name="answer_<?=$answer->val('belbin_answer_id') ?>" value="1" />

					<label for="answer_<?=$answer->val('belbin_answer_id') ?>">
						<?=$answer->val('belbin_answer_text') ?>
					</label>
				</p>
			<?php
		}

		if (isset($prev_question)) {
			$this->renderLink(sprintf('default/default/test/%d/%d', $test->val('belbin_test_id'), $prev_question->val('belbin_question_id')), 'Previous');
		}

	?>

	<button type="submit">Submit</button>
</form>
