var totals_options = {
	responsive: true,

	animation : {
		animateRotate: false
	},

	legend : {
		display: false
	},

	tooltips: {
		callbacks: {
			label: function(item, data) {return ' ' + data.labels[item.index] + ': ' + data.datasets[0].data[item.index] + '%'}
		}
	}

}

var totalsChart = new Chart(
	'totals_chart',
	{
		type: 'pie',
		data: totals_chart_data,
		options: totals_options
	}
);

var totalsMaleChart = new Chart(
	'male_totals_chart',
	{
		type: 'pie',
		data: totals_male_chart_data,
		options: totals_options
	}
);

var totalsFemaleChart = new Chart(
	'female_totals_chart',
	{
		type: 'pie',
		data: totals_female_chart_data,
		options: totals_options
	}
);

var age_totals_options = {
	responsive: true,

	animation : {
		animateRotate: false
	},

	scales: {

		xAxes: [{
			type: 'linear',
			display: true,
			scaleLabel: {
				display: true,
				labelString: 'Věk'
			},
			ticks: {
      	stepSize: 5
      }
		}],

		yAxes: [{
			display: true,
			scaleLabel: {
				display: true,
				labelString: 'Dominance role'
			},
			ticks: {
				min:0,
				max:100,
				stepSize: 10
			},
			stacked: true
		}]
	},

	legend : {
		display: true
	},

	hover: {
		mode: 'nearest',
		intersect: true
	},

	tooltips: {
		mode: 'index',
		intersect: false,
		callbacks: {
			title: function(items, data) {
				var item = items[0];
				return ' Věk: ' + item.xLabel;
			},
			label: function(item, data) {return ' ' + data.datasets[item.datasetIndex].label + ': ' + item.yLabel + '%'}
		}
	}

}

var totalsAgeChart = new Chart(
	'age_totals_chart',
	{
		type: 'line',
		data: totals_age_chart_data,
		options: age_totals_options
	}
);
