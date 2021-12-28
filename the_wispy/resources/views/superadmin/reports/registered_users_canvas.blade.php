<?php
 


	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Average Amount Spent on Real and Artificial X-Mas Trees in U.S."
	},
	axisY:{
		includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Real Trees",
		indexLabel: "{y}",
		yValueFormatString: "$#0.##",
		dataPoints:  [
			{ y: 21, label: "Video%", indexLabel: "21" },
			{ y: 25, label: "Dining%", indexLabel: "25" },
			{ y: 33, label: "Entertainment%", indexLabel: "33" },
			{ y: 36, label: "News%", indexLabel: "36" },
			{ y: 42, label: "Music%", indexLabel: "42" },
			{ y: 49, label: "Social%", indexLabel: "49" },
			{ y: 50, label: "Maps%", indexLabel: "50" },
			{ y: 55, label: "Weather%", indexLabel: "55" },
			{ y: 61, label: "Games%", indexLabel: "61s" }
		]
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>          