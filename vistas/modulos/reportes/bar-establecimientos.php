<?php

  $itemRadicado = null;
  $valorRadicado = null;

  $radicados = ControladorRadicados::ctrMostrarRadicados($itemRadicado, $valorRadicado);

  $arrayTansportadoras = array();
  $arrayCantidadesTr = array();

  foreach ($radicados as $key => $value) {

    $item = "id";
    $valor = $value["idtransportadora"];

    $transportadora = ControladorTransportadoras::ctrMostrarTransportadoras($item, $valor);

    array_push($arrayTansportadoras, $transportadora["transportadora"]);

    $arrayCantidadesTr = array($transportadora["transportadora"] => 1);

    foreach ($arrayCantidadesTr as $key => $value) {

      $sumaTransportadoras[$key] += $value;
      $totalTransportadoras += $value;

    }

  }

  $consolidadoTransportadoras = array_unique($arrayTansportadoras);

  $colores = array("red","green","yellow","aqua","blue");
  $coloresClaros = array("#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc");

?>

<!-- =============================================
BARRAS TRANSPORTADORAS
===============================================-->

<div class="box box-info">

  <div class="box-header with-border">

   <h3 class="box-title">Radicados x Operador Logistico</h3>

  </div>

  <div class="box-body">

    <div class="chart-responsive">

      <canvas id="barChart" style="height: 325px; width: 787px;" width="787" height="230"></canvas>

      </div>

  </div>

  <div class="box-footer no-padding">

  </div>


</div>



</div>


<script type="text/javascript">

var data = {
  labels  : [
    <?php

      foreach ($consolidadoTransportadoras as $key => $value) {

        echo "'".$consolidadoTransportadoras["$key"]."',";
      }

    ?>
    ],
  datasets: [
    {
      label               : 'Radicados',
      fillColor           : 'rgba(210, 214, 222, 1)',
      strokeColor         : 'rgba(210, 214, 222, 1)',
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [
        <?php

          foreach ($consolidadoTransportadoras as $key => $value) {

            echo $sumaTransportadoras[$value].",";
          }

        ?>
      ]
    }
  ]
}

  //-------------
   //- BAR CHART -
   //-------------
   var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
   var barChart                         = new Chart(barChartCanvas)
   var barChartData                     = data
   barChartData.datasets[0].fillColor   = '#0af'
   barChartData.datasets[0].strokeColor = '#0af'
   barChartData.datasets[0].pointColor  = '#0af'
   var barChartOptions                  = {
     //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
     scaleBeginAtZero        : true,
     //Boolean - Whether grid lines are shown across the chart
     scaleShowGridLines      : true,
     //String - Colour of the grid lines
     scaleGridLineColor      : 'rgba(0,0,0,.05)',
     //Number - Width of the grid lines
     scaleGridLineWidth      : 1,
     //Boolean - Whether to show horizontal lines (except X axis)
     scaleShowHorizontalLines: true,
     //Boolean - Whether to show vertical lines (except Y axis)
     scaleShowVerticalLines  : true,
     //Boolean - If there is a stroke on each bar
     barShowStroke           : true,
     //Number - Pixel width of the bar stroke
     barStrokeWidth          : 2,
     //Number - Spacing between each of the X value sets
     barValueSpacing         : 5,
     //Number - Spacing between data sets within X values
     barDatasetSpacing       : 1,
     //String - A legend template
     legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
     //Boolean - whether to make the chart responsive
     responsive              : true,
     maintainAspectRatio     : false
   }

   barChartOptions.datasetFill = false
   barChart.Bar(barChartData, barChartOptions)

</script>
