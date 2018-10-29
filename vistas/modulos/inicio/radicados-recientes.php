<?php

$item = null;
$valor = null;

$radicados = ControladorRadicados::ctrMostrarRadicados($item, $valor);


?>


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Radicados Recientes</h3>
  </div>

  <div class="box-body">
    <ul class="products-list product-list-in-box">


      <?php

      for ($i=0; $i < 6; $i++) {

        $radicado = str_pad($radicados[$i]["radicado"], 7, "0", STR_PAD_LEFT);

        $listaDestinatario = json_decode($radicados[$i]["destinatario"], true);

        $itemEstablecimiento = "id";
        $valorEstablecimiento = $listaDestinatario[0]["idEstablecimiento"];

        $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

        $itemEmpresa = "id";
        $valorEmpresa = $listaDestinatario[0]["idEmpresa"];

        $empresa = ControladorEmpresas::ctrMostrarEmpresas($itemEmpresa, $valorEmpresa);

        echo '<li class="item">

        <div class="product-info">

        <a href="http://localhost/sac/extensiones/tcpdf/pdf/radicadoPDF.php?radicado='.$radicados[$i]["radicado"].'" target="_blank" class="product-title">R'.$radicado.'
        <span class="label label-warning pull-right">Ver Reporte</span>
        </a>

        <span class="product-description">
        '.$establecimiento["tipo"].' / '.$establecimiento["identificador"].' / '.$empresa["empresa"].'
        </span>

        </div>

        </li>';

      }


      ?>

    </ul>
  </div>

  <div class="box-footer text-center">
    <a href="radicados" class="uppercase">Ver todos los radicados</a>
  </div>

</div>
