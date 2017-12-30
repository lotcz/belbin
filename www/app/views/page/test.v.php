<?php
	$test = $this->getData('test');
	$question = $this->getData('question');
	$answers = $this->getData('answers');
	$prev_question = $this->getData('prev_question');
?>

<p>
	Vyberte ta tvrzení, která Vás nejlépe vystihují a rozdělte mezi ně <strong><?=TestModel::$score_per_question ?></strong> bodů. Čím více je tvrzení výstižnější, tím více bodů přidělte.
</p>

<h2><?=$question->val('belbin_question_text') ?></h2>

<form method="POST">
	<input type="hidden" name="test_id" value="<?=$test->val('belbin_test_id') ?>" />
	<input type="hidden" name="question_id" value="<?=$question->val('belbin_question_id') ?>" />

	<div class="test">
		<?php

			foreach ($answers as $answer) {
				?>
					<div class="row item">
						
						<div class="col-sm-4 col-md-3 col-lg-3 col-xl-2 item-count">
							<div class="item-badge-wrapper"><div id="item_badge_<?=$answer->val('belbin_answer_id') ?>" class="item-badge" ></div></div><a onclick="javascript:minusItem(<?=$answer->val('belbin_answer_id') ?>);return false;" href="#" class="minus-item btn btn-danger"><span>-</span></a><input id="answer_<?=$answer->val('belbin_answer_id') ?>" name="answer_<?=$answer->val('belbin_answer_id') ?>" type="text" oninput="javascript:updateItem(<?=$answer->val('belbin_answer_id') ?>);return false;" maxlength="2" class="form-control answer-score-input" value="0"><a onclick="javascript:plusItem(<?=$answer->val('belbin_answer_id') ?>);return false;" href="#" class="plus-item btn btn-success"><span>+</span></a>
						</div>
						
						<div class="col-sm-8 col-md-9 col-lg-9 col-xl-10 item-label">
							<label for="answer_<?=$answer->val('belbin_answer_id') ?>">
								<?=$answer->val('belbin_answer_text') ?>
							</label>
						</div>
					</div>
				<?php
			}			

		?>
	</div>

	<p>
		Zbývá rozdělit <strong id="remaining_points"><?=TestModel::$score_per_question ?></strong> z <strong><?=TestModel::$score_per_question ?></strong>-ti bodů.
		<div class="progress">
			<div id="question_progress" class="progress-bar bg-success" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</p>

	<div class="row item">						
		<div class="col-md-6">
			<?php
				if (isset($prev_question)) {
					$this->renderLink(sprintf('default/default/test/%d/%d', $test->val('belbin_test_id'), $prev_question->val('belbin_question_id')), '&laquo; Zpět', 'btn btn-primary btn-lg');
				}
			?>
		</div>
		
		<div class="col-md-6 text-right">
			<input id="next_question_button" type="submit" disabled="true" class="btn btn-primary btn-lg" value="Další &raquo;" />
		</div>
	</div>
	
</form>
