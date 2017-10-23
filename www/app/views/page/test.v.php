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

	<table class="test">
		<?php

			foreach ($answers as $answer) {
				?>
					<tr class="item">
						<td>
							<div class="item-count">
								<a onclick="javascript:minusItem(<?=$answer->val('belbin_answer_id') ?>);return false;" href="#" class="minus-item"><span class="glyphicon glyphicon-minus"></span></a><input id="answer_<?=$answer->val('belbin_answer_id') ?>" name="answer_<?=$answer->val('belbin_answer_id') ?>" type="text" maxlength="2" class="form-control answer-score-input" value="0"><a onclick="javascript:plusItem(<?=$answer->val('belbin_answer_id') ?>);return false;" href="#" class="plus-item"><span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</td>
						<td>
							<label for="answer_<?=$answer->val('belbin_answer_id') ?>">
								<?=$answer->val('belbin_answer_text') ?>
							</label>
						</td>
					</tr>
				<?php
			}

			if (isset($prev_question)) {
				$this->renderLink(sprintf('default/default/test/%d/%d', $test->val('belbin_test_id'), $prev_question->val('belbin_question_id')), 'Previous');
			}

		?>
	</table>

	<p>
		Total score: <strong id="total_score">0</strong>
	</p>

	<p>
		<button type="submit">Submit</button>
	</P>
</form>
