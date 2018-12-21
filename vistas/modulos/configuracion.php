
<?php

if ($_SESSION["acceso"]["usuarios"] != "7") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Configuración
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Configuración</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <form role="form" method="post" enctype="multipart/form-data">

      <div class="box-body">

          <div class="col-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">FONDO</a></li>
                <li><a href="#tab_2" data-toggle="tab">LOGOS DE TICKETS E INFORMES</a></li>
                <li><a href="#tab_3" data-toggle="tab">LEYENDA INFORMES</a></li>
              </ul>
              <div class="tab-content">



                <div class="tab-pane active" id="tab_1">

                  <div class="box-body">

                    <!-- ENTRADA PARA SUBIR FOTO IMAGEN INICIO -->

                     <div class="form-group">
                      <div class="panel">SUBIR IMAGEN INICIO</div>
                      <input type="file" class="nuevaImagenInicio" name="nuevaImagenInicio">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <div class="col-xs-5 thumbnail">
                          <img src="vistas/img/plantilla/back.png" alt="fondo" class="previsualizar">
                      </div>
                    </div>
                  </div>

                </div>

                <div class="tab-pane" id="tab_2">

                  <div class="box-body">

                    <!-- ENTRADA PARA SUBIR FOTO IMAGEN INICIO -->

                     <div class="form-group">
                      <div class="panel">SUBIR LOGO TICKET</div>
                      <input type="file" class="nuevaImagenSticker" name="nuevaImagenSticker">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <p class="help-block">Se recomienda imagenes a blanco y negro para una mejor visualización en impresora de tickets</p>
                      <div class="col-xs-3 thumbnail">
                          <img src="extensiones/tcpdf/pdf/images/logo.png" alt="fondo" class="previsualizarSticker">
                      </div>
                    </div>
                  </div>

                  <div class="box-body">

                    <!-- ENTRADA PARA SUBIR FOTO IMAGEN INICIO -->

                     <div class="form-group">
                      <div class="panel">SUBIR LOGO INFORMES</div>
                      <input type="file" class="nuevoLogoInforme" name="nuevoLogoInforme">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <div class="col-xs-3 thumbnail">
                          <img src="extensiones/tcpdf/pdf/images/logo.png" alt="fondo" class="previsualizarLogo">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="tab_3">
                      <div class="box-header">
                        <h3 class="box-title">Encabezado Informes</h3>
                        <br>
                        <small>Información que aparecera en el encabezado de los informes generados por el sistema</small>
                      </div>
                      <div class="box-body pad">
                        <form>
                              <textarea id="editor1" name="editor1" rows="10" cols="80">
                                Encabezado Informes
                              </textarea>
                        </form>
                      </div>

                </div>
              </div>
            </div>
          </div>

      </div>

      <div class="box-footer">

        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i>  Guardar</button>

      </div>

      </form>
    </div>

  </section>
</div>
