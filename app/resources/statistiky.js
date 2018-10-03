function chartCanvasExists(chart_id) {
	return ($("#" + chart_id).length);
}

function createChart(chart_id, chart_type, chart_data, chart_options) {
 if (chartCanvasExists(chart_id) && (chart_data !== null)) {
	 return new Chart(
	 	chart_id,
	 	{
	 		type: chart_type,
	 		data: chart_data,
	 		options: chart_options
	 	}
	 );
 }
}

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
			label: function(item, data) {return ' ' + data.labels[item.index] + ': ' + data.datasets[0].data[item.index] + ' %'}
		}
	}

}

var totalsChart = createChart('totals_chart', 'pie', totals_chart_data, totals_options);

if (chartCanvasExists('male_totals_chart')) {
	var totalsMaleChart = createChart('male_totals_chart', 'pie', totals_male_chart_data, totals_options);
}

if (chartCanvasExists('female_totals_chart')) {
	var totalsFemaleChart = createChart('female_totals_chart', 'pie', totals_female_chart_data, totals_options);
}

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
			label: function(item, data) {return ' ' + data.datasets[item.datasetIndex].label + ': ' + item.yLabel + ' %'}
		}
	}

}

var totalsAgeChart = createChart('age_totals_chart', 'line', totals_age_chart_data, age_totals_options);
