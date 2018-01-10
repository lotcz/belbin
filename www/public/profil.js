var charts = [];
var chart_options = {
	tooltips: {
		enabled = false
	},
	legend: {
		display = false
	},
	events: null
}

for (var i = 0, max = chart_data.length; i < max; i++) {			
	charts.push(new Chart(
		'chart_test_' + chart_data[i].test_id,
		{
			type: 'pie',
			data: chart_data[i].data,
			options: chart_options
		}
	));
}