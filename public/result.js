var chart_options = {
	legend: {
		display: false
	}
}

var myPieChart = new Chart(
	'test_chart',
	{
		type: 'pie',
		data: chart_data,
		options: chart_options
	}
);
