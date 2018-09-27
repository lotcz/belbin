<?php

class TestModel extends zModel {

	public $table_name = 'belbin_test';

	static $score_per_question = 10;

	private $results;

	public function testResults() {
		if (!isset($this->results)) {
			$this->results = $this->loadResults();
		}
		return $this->results;
	}

	private $total_score;

	public function totalScore() {
		if (!isset($this->total_score)) {
			$this->total_score = zModel::sum($this->testResults(), 'score');
		}
		return $this->total_score;
	}

	public function loadResults() {
		return TestModel::loadTestResults($this->db, $this->ival('belbin_test_id'));
	}

	static function loadTestResults($db, $test_id) {
		return zModel::Select(
		/* db */		$db,
		/* table */		'viewBelbinTestResults',
		/* where */		'belbin_test_id = ?',
		/* orderby */	'score DESC',
		/* limit */	null,
		/* bindings */	[$test_id],
		/* types */		[PDO::PARAM_INT]
		);
	}

	public function validateTestResults() {
		$question_count = $this->db->getRecordCount('belbin_question');
		//we cannot use loadResults method, because that returns results for finished tests only
		$results = zModel::select(
		/* db */		$this->db,
		/* table */		'belbin_result',
		/* where */		'belbin_result_test_id = ?',
		/* orderby */	null,
		/* limit */		null,
		/* bindings */	[$this->ival('belbin_test_id')],
		/* types */		[PDO::PARAM_INT]
		);
		$total_score = zModel::sum($results, 'belbin_result_score');
		return ($total_score == ($question_count * Self::$score_per_question));
	}

	static function formatDuration($core_module, $duration_in_seconds) {
		$result = [];
		$days = 0;
		$hours = 0;
		$minutes = 0;
		$seconds = 0;
		$remainder = $duration_in_seconds;

		$days = floor($remainder / (60*60*24));
		if ($days > 0) {
			if ($days == 1) {
				$result[] = $core_module->t('1 day');
			} elseif ($days < 5) {
				$result[] = $core_module->t('%d days_234', $days);
			} else {
				$result[] = $core_module->t('%d days', $days);
			}
			$remainder = $remainder - ($days*60*60*24);
		}

		$hours = floor($remainder / (60*60));
		if ($hours > 0) {
			if ($hours == 1) {
				$result[] = $core_module->t('1 hour');
			} elseif ($hours < 5) {
				$result[] = $core_module->t('%d hours_234', $hours);
			} else {
				$result[] = $core_module->t('%d hours', $hours);
			}
			$remainder = $remainder - ($hours*60*60);
		}

		$minutes = floor($remainder / 60);
		if ($minutes > 0) {
			if ($minutes == 1) {
				$result[] = $core_module->t('1 minute');
			} elseif ($minutes < 5) {
				$result[] = $core_module->t('%d minutes_234', $minutes);
			} else {
				$result[] = $core_module->t('%d minutes', $minutes);
			}
			$remainder = $remainder - ($minutes*60);
		}

		$seconds = floor($remainder);
		if ($seconds == 0 && count($result) == 0) {
			$result[] = $core_module->t('%d seconds', 0);
		} elseif ($seconds == 1) {
			$result[] = $core_module->t('1 second');
		} elseif ($seconds < 5) {
			$result[] = $core_module->t('%d seconds_234', $seconds);
		} else {
			$result[] = $core_module->t('%d seconds', $seconds);
		}

		$last_item = array_pop($result);
		if (count($result) > 0) {
			return implode(', ', $result) . ' ' . $core_module->t('and') . ' ' . $last_item;
		} else {
			return $last_item;
		}

	}

}
