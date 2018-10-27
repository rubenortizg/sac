<?php

error_reporting(0);

if (isset($_GET["fechaInicial"])) {

  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];

}else {

  $fechaInicial = null;
  $fechaFinal = null;
}

$radicados = ControladorRadicados::ctrRangoFechasRadicados($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayRadicados = array();

foreach ($radicados as $key => $value) {

  $fecha = substr($value["fecha"],0,10);

  array_push($arrayFechas, $fecha);

  $arrayRadicados = array($fecha => '1');

  foreach ($arrayRadicados as $key => $value) {

    $sumaRadicadosMes[$key] += $value;

  }

}

$consolidadoFechas = array_unique($arrayFechas);

?>

<!-- =============================================
GRAFICO DE RADICADOS
===============================================-->

<!-- LINE CHART -->
<div class="box box-solid bg-light-blue-gradient">
  <div class="box-header">
    <i class="fa fa-th">
      <h3 class="box-title">Grafico de Radicados</h3>
    </i>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="lineChart" style="height:250px"></canvas>
    </div>
  </div>
</div>

<script type="text/javascript">

var areaChartCanvas = $('#lineChart').get(0).getContext('2d')

var areaChart       = new Chart(areaChartCanvas)

var areaChartData = {
  labels  : [
            <?php

              if ($consolidadoFechas != null) {

                foreach ($consolidadoFechas as $value) {

                  echo "'".$value."',";
                }

               } else {

                 echo "0";

               }

            ?>
            ],
  datasets: [
    {
      label               : 'Radicados',
      fillColor           : 'rgba(255,255,255,0.9)',
      strokeColor         : 'rgba(255,255,255,0.8)',
      pointColor          : '#fff',
      pointStrokeColor    : 'rgba(255,255,255,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(255,255,255,1)',
      data                : [
                              <?php

                                if ($consolidadoFechas != null) {

                                  foreach ($consolidadoFechas as $key) {

                                    echo "'".$sumaRadicadosMes[$key]."',";
                                  }

                                 } else {

                                   echo "0";

                                 }

                              ?>
                            ]
    }
  ]
}

var areaChartOptions = {
  //Boolean - If we should show the scale at all
  showScale               : true,
  //Boolean - Whether grid lines are shown across the chart
  scaleShowGridLines      : false,
  //String - Colour of the grid lines
  scaleGridLineColor      : 'rgba(255,255,255,.05)',
  // String - Colour of the scale line
  scaleLineColor          : "rgba(255,255,255,1)",
  // String - Scale label font colour
  scaleFontColor          : "#FFF",
  //Number - Width of the grid lines
  scaleGridLineWidth      : 1,
  //Boolean - Whether to show horizontal lines (except X axis)
  scaleShowHorizontalLines: true,
  //Boolean - Whether to show vertical lines (except Y axis)
  scaleShowVerticalLines  : true,
  //Boolean - Whether the line is curved between points
  bezierCurve             : true,
  //Number - Tension of the bezier curve between points
  bezierCurveTension      : 0.3,
  //Boolean - Whether to show a dot for each point
  pointDot                : true,
  //Number - Radius of each point dot in pixels
  pointDotRadius          : 6,
  //Number - Pixel width of point dot stroke
  pointDotStrokeWidth     : 1,
  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
  pointHitDetectionRadius : 20,
  //Boolean - Whether to show a stroke for datasets
  datasetStroke           : true,
  //Number - Pixel width of dataset stroke
  datasetStrokeWidth      : 2,
  //Boolean - Whether to fill the dataset with a color
  datasetFill             : true,
  //String - A legend template
  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  maintainAspectRatio     : true,
  //Boolean - whether to make the chart responsive to window resizing
  responsive              : true,
}

areaChart.Line(areaChartData, areaChartOptions)

//-------------
//- LINE CHART -
//--------------
var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
var lineChart                = new Chart(lineChartCanvas)
var lineChartOptions         = areaChartOptions
lineChartOptions.datasetFill = false
lineChart.Line(areaChartData, lineChartOptions)

</script>
