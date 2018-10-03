var demographic_form = null;
var age_integer = null;
var age_min = null;
var age_max = null;

function updateDemographicForm() {
	if (demographic_form == null) {
		demographic_form = new formValidation('demographic_form');
		age_integer = demographic_form.add('rok', 'integer', false);
		var d = new Date();
		var n = d.getFullYear();
		age_min = demographic_form.add('rok', 'min', n-100);
		age_max = demographic_form.add('rok', 'max', n-10);
	}

	var age_valid = false;
	var age_skipped = $('#neuvadet_rok').is(':checked');

	$('#rok').prop('disabled', age_skipped);
	if (age_skipped) {
		$('#rok').val('');
		// hide validation messages
		demographic_form.showFieldValidation('rok','min', true);
		demographic_form.showFieldValidation('rok','max', true);
	} else {
		age_valid = demographic_form.isFieldValid(age_integer);
		if (age_valid) {
			age_valid = demographic_form.isFieldValid(age_min) && demographic_form.isFieldValid(age_max);
		}
	}

	var sex_valid = $('#pohlavi0').is(':checked') || $('#pohlavi1').is(':checked');
	var sex_skipped = $('#neuvadet_pohlavi').is(':checked');

	var is_ok = ((age_valid || age_skipped) && (sex_valid || sex_skipped));

	$('#confirm_button').prop('disabled', (!is_ok));
}

$(function() {
	$('#rok').change(updateDemographicForm);
	$('#rok').keyup(updateDemographicForm);
	$('#neuvadet_rok').change(updateDemographicForm);
	$('#pohlavi0').change(updateDemographicForm);
	$('#pohlavi1').change(updateDemographicForm);
	$('#neuvadet_pohlavi').change(updateDemographicForm);
	updateDemographicForm();
});
