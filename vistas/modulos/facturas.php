<?php

if ($_SESSION["acceso"]["radicados"] < "6") {
  echo '<script>
    window.location = "radicados";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Radicar Facturas
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Radicar Facturas</li>
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <!--=====================================
      FORMULARIO RADICACION
      ======================================-->

      <div class="col-lg-12 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border">
            <h4>Radicado</h4>
          </div>

          <form role="form" method="post" class="formularioFacturas" id="formularioFacturas">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                NUMERO DE RADICADO
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                    <?php

                      $item = null;
                      $valor = null;

                      $radicados = ControladorRadicados::ctrMostrarRadicados($item, $valor);

                      if (!$radicados) {

                        $radicado = 1;
                        $radicado = str_pad($radicado, 7, "0", STR_PAD_LEFT);

                        echo '<input type="text" class="form-control" id="nuevoRadicado" name="nuevoRadicado" value="R'.$radicado.'" readonly>';
                        echo '<input type="hidden" id="radicadoReal" name="radicadoReal" value="'.$radicado.'" readonly>';

                      } else {

                        foreach ($radicados as $key => $value) {
                          // llegar al ultimo radicado
                        }

                        $radicado = $value["radicado"] + 1;
                        $radicado = str_pad($radicado, 7, "0", STR_PAD_LEFT);

                        echo '<input type="text" class="form-control" id="nuevoRadicado" name="nuevoRadicado" value="R'.$radicado.'" readonly>';
                        echo '<input type="hidden" id="radicadoReal" name="radicadoReal" value="'.$radicado.'" readonly>';

                      }

                    ?>

                  </div>
                </div>

                <!--=====================================
                FECHA RADICADO
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" id="nuevaFecha" name="nuevaFecha" value="<?php date_default_timezone_set('America/Bogota'); echo date("Y-m-d H:i:s"); ?>" readonly>
                  </div>
                </div>

                <!--=====================================
                CAPTURA FACTURA
                ======================================-->
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                  <input type="text" class="form-control" id="nuevaFactura" name="nuevaFactura" placeholder="Codido de Barras Factura" autofocus>
                  </div>
                </div>

              </div>

            </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Radicar Factura</button>

          </div>

          </form>

          <?php

          $radicarFactura = new ControladorFacturas();
          $radicarFactura -> ctrRadicarFactura();


          ?>

        </div>

      </div>


    </div>

  </section>

</div>
