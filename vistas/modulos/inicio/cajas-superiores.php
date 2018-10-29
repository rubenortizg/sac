<?php

$item = null;
$valor = null;

$radicados = ControladorRadicados::ctrMostrarRadicados($item, $valor);
$totalRadicados = count($radicados);

$establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);
$totalEstablecimientos = count($establecimientos);

$transportadoras = ControladorTransportadoras::ctrMostrarTransportadoras($item, $valor);
$totalTransportadoras = count($transportadoras);

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

?>

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><?php echo $totalRadicados; ?></h3>

      <p>Radicados</p>
    </div>
    <div class="icon">
      <i class="fa fa-envelope"></i>
    </div>
    <a href="radicados" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>


<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-green">
    <div class="inner">
      <h3><?php echo $totalEstablecimientos; ?></h3>

      <p>Establecimientos</p>
    </div>
    <div class="icon">
      <i class="fa fa-briefcase"></i>
    </div>
    <a href="establecimientos" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>


<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><?php echo $totalTransportadoras; ?></h3>

      <p>Transportadoras</p>
    </div>
    <div class="icon">
      <i class="fa fa-truck"></i>
    </div>
    <a href="transportadoras" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>


<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-red">
    <div class="inner">
      <h3><?php echo $totalCategorias; ?></h3>

      <p>Categorias</p>
    </div>
    <div class="icon">
      <i class="fa fa-tags"></i>
    </div>
    <a href="categorias" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
