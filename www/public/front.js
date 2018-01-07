var options = {
	legend : {
		display: false
	},
	
	tooltips: {
		callbacks: {
			label: function(item, data) {return ' ' + data.labels[item.index] + ': ' + data.datasets[0].data[item.index] + '%'}
		}
	}
}
								
var myPieChart = new Chart(
	'statistics_chart',
	{
		type: 'pie',
		data: chart_data,
		options: options
	}
);