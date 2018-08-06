function getItemCount(id) {
	return parseInt($('#answer_'+id).val());
}

function setItemCount(id, cnt) {
	if (isNaN(cnt)) {
		cnt = 0;
	}
	$('#answer_'+id).val(parseInt(cnt));
	var percentage = 0;
	if (cnt > 0) {		
		percentage = 0.3 + 0.7 * (cnt / score_per_question);
	}
	percentage = (percentage * 100) + '%';
	$('#item_badge_'+id).css({width:percentage, height:percentage});
	updateTotalScore();
}

function updateItem(id) {
	var cnt = getItemCount(id);
	var score = getTotalScore();
	if (score > score_per_question) {
		cnt = cnt - (score - score_per_question);
	}
	setItemCount(id, cnt);
}

function getTotalScore() {
  var sum = 0;
  $('.answer-score-input').each(function( index ) {
    sum += parseInt($(this).val());
  });
  return sum;
}

function updateTotalScore() {  
	var score = getTotalScore();
	var remaining = score_per_question - score;
	$('#remaining_points').html(remaining);
	var percentage = (score / score_per_question) * 100;
	$('#question_progress').css({width:percentage+'%'});
	$('#question_progress').attr('aria-valuenow', percentage);
	if (remaining == 0) {
		$('#next_question_button').prop('disabled', false);
	} else {		
		$('#next_question_button').prop('disabled', true);
	}
}

function minusItem(id) {
	var score = getTotalScore();
	var c = getItemCount(id);
	if (c <= 0) {
		c = 0;
	} else {
		c -= 1;
	}
	setItemCount(id, c);	
}

function plusItem(id) {
	var score = getTotalScore();	
	var c = getItemCount(id);	
	var remains = score_per_question - score + c;
	if (c >= remains) {
		c = remains;
	} else {
		c += 1;
	}
	setItemCount(id, c);	
}

$(function() {
	updateTotalScore();
});