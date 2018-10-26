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

  $fecha = substr($value["fecha"],0,7);

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

<div class="box box-solid bg-light-blue-gradient">

  <div class="box-header">

    <i class="fa fa-th">
      <h3 class="box-title">Grafico de Radicados</h3>
    </i>

  </div>

  <div class="box-body border-radius-none nuevoGraficoRadicados">

    <div class="chart" id="line-chart-radicados" style="height:250px">


    </div>

  </div>


</div>

<script type="text/javascript">

var line = new Morris.Line({
  element          : 'line-chart-radicados',
  resize           : true,
  data             : [

    <?php

      if ($consolidadoFechas != null) {

        foreach ($consolidadoFechas as $key) {

          echo "{ y: '".$key."', radicados: ".$sumaRadicadosMes[$key]." },";

        }

        echo "{ y: '".$key."', radicados: ".$sumaRadicadosMes[$key]." }";

     } else {

       echo "{ y: '0', radicados: '0' }";

     }

    ?>

  ],
  xkey             : 'y',
  xlabels          : 'month',
  ykeys            : ['radicados'],
  labels           : ['radicados'],
  lineColors       : ['#efefef'],
  lineWidth        : 3,
  hideHover        : 'auto',
  gridTextColor    : '#fff',
  gridStrokeWidth  : 0.4,
  pointSize        : 5,
  pointStrokeColors: ['#efefef'],
  gridLineColor    : '#efefef',
  gridTextFamily   : 'Open Sans',
  gridTextSize     : 14
});

</script>
