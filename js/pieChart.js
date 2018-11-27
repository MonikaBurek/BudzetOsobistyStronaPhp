
function createPieChart () 
{
	var chart = new CanvasJS.Chart("chartContainer", {
				exportEnabled: true,
				animationEnabled: true,
				title:{
					text: "Zestawienie wydatków w okresie ..."
				},
				legend:{
					cursor: "pointer",
					itemclick: explodePie
				},
				data: [{
					type: "pie",
					showInLegend: true,
					toolTipContent: "{name}: <strong>{y}%</strong>",
					//indexLabel: "{name} - {y}%",
					dataPoints: [
						{ y: 65, name: "Mieszkanie", exploded: true },
						{ y: 15, name: "Transport" },
						{ y: 10, name: "Telekomunikacja" },
						{ y: 7, name: "Opieka zdrowotna" },
						{ y: 3, name: "Oszczędności" },
					]
				}]
			});
			
	chart.render();
	chart.title.set("fontSize", 24);
	chart.title.set("fontColor", "#092834", false);
	chart.legend.set("fontSize", 16);
}

function explodePie (e) 
{
			if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
				e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
			} else {
				e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
			}
			e.chart.render();

}
	