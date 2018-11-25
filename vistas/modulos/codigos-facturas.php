<?php

if ($_SESSION["acceso"]["radicados"] < "6") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Generar Codigos Facturas
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Generar Codigos Facturas</li>
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <!--=====================================
      FORMULARIO RADICACION
      ======================================-->

      <div class="col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border">
            <h4>Operador</h4>
          </div>

          <form role="form" method="post" class="formularioRadicador" id="formularioRadicador">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                SELECCIONAR OPERADOR
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-inbox"></i></span>

                    <select class="form-control" id="seleccionarOperador" name="seleccionarOperador" required>
                      <option value="">Selecciona operador</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $operadores = ControladorOperadores::ctrMostrarOperadores($item, $valor);

                      foreach ($operadores as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }

                      ?>

                    </select>

                  </div>

                </div>

              </div>

            </div>

          <div class="box-footer">

            <button class="btn btn-success btnPdfCodigos pull-right"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar Codigos Facturas</button>

          </div>

          </form>


        </div>

      </div>

    </div>

  </section>

</div>
