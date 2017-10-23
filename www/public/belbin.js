function getItemCount(id) {
	return parseInt($('#answer_'+id).val());
}

function setItemCount(id, cnt) {
	$('#answer_'+id).val(parseInt(cnt));
}

function calculateTotalScore() {
  var sum = 0;
  $('.answer-score-input').each(function( index ) {
    sum += parseInt($(this).val());
  });
  $('#total_score').html(sum);
}

function minusItem(id) {
	var c = getItemCount(id)-1;
	setItemCount(id, c);
  calculateTotalScore();
}

function plusItem(id) {
	var c = getItemCount(id)+1;
	setItemCount(id, c);
  calculateTotalScore();
}
