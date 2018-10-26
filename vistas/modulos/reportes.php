
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Reportes de Radicación
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Reportes</li>
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

        <button type="button" class="btn btn-default pull-leftt" id="daterange-btnReportes">

          <span>
            <i class="fa fa-calendar"></i> Rango de Fecha
          </span>
          <i class="fa fa-caret-down"></i>

        </button>

        <div class="box-tools pull-right">

        </div>
      </div>


      <div class="box-body">

        <div class="row">

          <div class="col-xs-12">

            <?php

            include "reportes/grafico-radicados.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/categorias-mas-radicadas.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/bar-establecimientos.php";

            ?>

          </div>
        </div>

      </div>

    </div>

  </section>

</div>
