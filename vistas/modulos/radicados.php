<?php

if ($_SESSION["acceso"]["radicados"] < "4") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Radicados

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Radicados</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

    <?php

    echo '<div class="box-header with-border">';

    if ($_SESSION["acceso"]["radicados"] >= "6") {

      echo '<a href="radicador">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalRadicar">
                Radicar Correspondencia
              </button>
            </a>';

    }

    echo ' <button type="button" class="btn btn-default pull-right" id="daterange-btnRadicado">

            <span>
            <i class="fa fa-calendar"></i> Rango de Fecha
          </span>
          <i class="fa fa-caret-down"></i>

        </button>

      </div>';

    ?>


      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablasRadicados"  width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>No. Radicado</th>
           <th>Transportadora</th>
           <th>Remitente</th>
           <th>Destinatario</th>
           <th>Establecimiento</th>
           <th>Estado</th>
           <th>Tipo de Correspondencia</th>
           <th>Fecha Radicado</th>
           <th style="width:120px">Acciones</th>
         </tr>
        </thead>

        <tbody>

        <!-- Cargue dataTables -->

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php

  $eliminarRadicado = new ControladorRadicados();
  $eliminarRadicado -> ctrEliminarRadicado();

?>
