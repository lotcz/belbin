function getItemCount(id) {
	return parseInt($('#answer_'+id).val());
}

function setItemCount(id, cnt) {
	$('#answer_'+id).val(parseInt(cnt));
}

function getTotalScore() {
  var sum = 0;
  $('.answer-score-input').each(function( index ) {
    sum += parseInt($(this).val());
  });
  return sum;
}

function updateTotalScore(score) {  
	var score = getTotalScore();
	$('#total_score').html(score);
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
	updateTotalScore()
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
	updateTotalScore()
}