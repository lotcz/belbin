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