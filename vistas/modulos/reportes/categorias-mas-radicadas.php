<?php

if (isset($_GET["fechaInicial"])) {

  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];

}else {

  $fechaInicial = null;
  $fechaFinal = null;
}

$radicados = ControladorRadicados::ctrRangoFechasRadicados($fechaInicial, $fechaFinal);

$arrayCategorias = array();
$arrayCantidades = array();

foreach ($radicados as $key => $value) {

  $listaCorrespondencia = json_decode($value["correspondencia"], true);

  foreach ($listaCorrespondencia as $key => $correspondencia) {

    $item = "id";
    $valor = $correspondencia["id"];

    $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

    array_push($arrayCategorias, $categoria["categoria"]);

    $arrayCantidades = array($categoria["categoria"] => $correspondencia["cantidad"]);

    foreach ($arrayCantidades as $key => $value) {

      $sumaCantidades[$key] += $value;
      $totalCategoriasRecientes += $value;

    }

  }

}

$consolidadoCategorias = array_unique($arrayCategorias);

$colores = array("red","green","yellow","aqua","blue","purple","green","red","aqua","blue");
$coloresClaros = array("#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc", "#9975B9","#00a65a","#f56954","#00c0ef","#3c8dbc");

?>

<!-- =============================================
PIE CATEGORIAS
===============================================-->


<div class="box box-success">

 <div class="box-header with-border">

   <h3 class="box-title">Elementos x Categoria</h3>

 </div>

 <div class="box-body">

   <div class="row">

     <div class="col-md-9">
       <div class="chart-responsive">
         <canvas id="pieChart" height="150"></canvas>
       </div>
     </div>

     <div class="col-md-3">
       <ul class="chart-legend clearfix">

          <?php

            $color = 0;

            foreach ($consolidadoCategorias as $key => $value) {

              echo '<li><i class="fa fa-circle-o text-'.$colores[$color].'"></i> '.$consolidadoCategorias[$key].'(S)</li>';

              $color += 1;

            }



          ?>

       </ul>
     </div>

   </div>

 </div>

 <div class="box-footer no-padding">

   <table class="table table-bordered table-striped table-condensed dt-responsive"  width="100%">
    <thead>
     <tr>
       <th>Categoria</th>
       <th style="text-align:right">Cantidad</th>
       <th style="text-align:right">Porcentaje</th>
     </tr>
    </thead>

    <tbody>

      <?php

        $color = 0;

        foreach ($consolidadoCategorias as $key => $value) {

         $porcentajeCantidades = round(($sumaCantidades[$value]/$totalCategoriasRecientes)*100,1);

         echo '<tr>
                 <td>'.$consolidadoCategorias[$key].'(S)</td>
                 <td>
                     <div class="pull-right">'.$sumaCantidades[$value].'</div>
                 </td>
                 <td>
                   <span class="pull-right badge bg-'.$colores[$color].'">
                   <i></i> '.$porcentajeCantidades.'%</span>
                 </td>
               </tr>';

         $color += 1;

       }

      ?>

    </tbody>

   </table>

 </div>

</div>


<script type="text/javascript">

var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
var pieChart       = new Chart(pieChartCanvas);
var PieData        = [

  <?php

  $color = 0;

  foreach ($consolidadoCategorias as $key => $value) {

    echo '{
            value    : '.$sumaCantidades[$value].',
            color    : "'.$coloresClaros[$color].'",
            highlight: "'.$coloresClaros[$color].'",
            label    : "'.$consolidadoCategorias[$key].'(S)"
          },';

    $color += 1;

  }

  ?>
];
var pieOptions     = {
  // Boolean - Whether we should show a stroke on each segment
  segmentShowStroke    : true,
  // String - The colour of each segment stroke
  segmentStrokeColor   : '#fff',
  // Number - The width of each segment stroke
  segmentStrokeWidth   : 1,
  // Number - The percentage of the chart that we cut out of the middle
  percentageInnerCutout: 50, // This is 0 for Pie charts
  // Number - Amount of animation steps
  animationSteps       : 100,
  // String - Animation easing effect
  animationEasing      : 'easeOutBounce',
  // Boolean - Whether we animate the rotation of the Doughnut
  animateRotate        : true,
  // Boolean - Whether we animate scaling the Doughnut from the centre
  animateScale         : false,
  // Boolean - whether to make the chart responsive to window resizing
  responsive           : true,
  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  maintainAspectRatio  : false,
  // String - A legend template
  legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
  // String - A tooltip template
  tooltipTemplate      : '<%=label%> : <%=value %>'
};
// Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Doughnut(PieData, pieOptions);
// -----------------
// - END PIE CHART -
// -----------------

</script>
