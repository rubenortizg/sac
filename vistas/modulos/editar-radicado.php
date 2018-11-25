<?php

if ($_SESSION["acceso"]["radicados"] < "6" && $_SESSION["acceso"]["opciones"] < "6" ) {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Editar Radicado
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Editar Radicado</li>
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <!--=====================================
      FORMULARIO RADICACION
      ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border">
            <h4>Radicado</h4>
          </div>

          <form role="form" method="post" class="formularioRadicador formularioEdicion" id="formularioRadicador">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                RADICADO A EDITAR
                ======================================-->

                <?php

                  $item = "id";
                  $valor = $_GET["idRadicado"];

                  $editarRadicado = ControladorRadicados::ctrMostrarRadicados($item, $valor);

                  $itemTransportadora ="id";
                  $valorTransportadora =$editarRadicado["idtransportadora"];

                  $transportadora = ControladorTransportadoras::ctrMostrarTransportadoras($itemTransportadora, $valorTransportadora);


                  $itemRemitente ="id";
                  $valorRemitente =$editarRadicado["idremitente"];

                  $remitente = ControladorRemitentes::ctrMostrarRemitentes($itemRemitente, $valorRemitente);

                ?>

                <!--=====================================
                NUMERO DE RADICADO
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                    <?php

                        $radicado = $editarRadicado["radicado"];
                        $radicadoReal = $editarRadicado["radicado"];
                        $radicado = str_pad($radicado, 7, "0", STR_PAD_LEFT);

                        echo '<input type="text" class="form-control" id="nuevoRadicado" name="editarRadicado" value="R'.$radicado.'" readonly>';
                        echo '<input type="hidden" id="radicadoReal" name="radicadoReal" value="'.$radicadoReal.'" readonly>';

                    ?>

                  </div>
                </div>

                <!--=====================================
                FECHA RADICADO
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" id="nuevaFecha" name="nuevaFecha" value="<?php echo $editarRadicado["fecha"]; ?>" readonly>
                  </div>
                </div>

                <!--=====================================
                TRANSPORTADORA SELECCIONAR / AGREGAR
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                    <select class="form-control" id="seleccionarTransportadora" name="seleccionarTransportadora" required>
                      <option value="<?php echo $transportadora["id"]; ?>"><?php echo $transportadora["transportadora"]; ?></option>

                      <?php

                      $item = null;
                      $valor = null;

                      $transportadoras = ControladorTransportadoras::ctrMostrarTransportadoras($item, $valor);

                      foreach ($transportadoras as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["transportadora"].'</option>';
                      }

                      ?>

                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarTransportadora" data-dismiss="modal">Agregar Transportadora</button></span>
                  </div>
                </div>

                <!--=====================================
                REMITENTE SELECCIONAR / AGREGAR
                ======================================-->

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-send"></i></span>

                    <select class="form-control" id="seleccionarRemitente" name="seleccionarRemitente" required>
                      <option value="<?php echo $remitente["id"]; ?>"><?php echo $remitente["remitente"]; ?></option>

                      <?php

                      $item = null;
                      $valor = null;

                      $remitentes = ControladorRemitentes::ctrMostrarRemitentes($item, $valor);

                      foreach ($remitentes as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["remitente"].'</option>';
                      }

                      ?>

                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarRemitente" data-dismiss="modal">Agregar Remitente</button></span>
                  </div>
                </div>

                <hr>

                <!--=====================================
                DESTINATARIO SELECCIONAR / AGREGAR
                ======================================-->

                <label>Destinatario:</label>


                <div class="nuevoDestinatario">

                <?php

                  $listaDestinatario = json_decode($editarRadicado["destinatario"], true);

                  foreach ($listaDestinatario as $key => $value) {

                    $itemEstablecimiento = "id";
                    $valorEstablecimiento = $value["idEstablecimiento"];

                    $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

                    $itemEmpresa = "id";
                    $valorEmpresa = $value["idEmpresa"];

                    $empresa = ControladorEmpresas::ctrMostrarEmpresas($itemEmpresa, $valorEmpresa);

                    $itemCliente = "id";
                    $valorCliente = $value["idCliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $itemClientes = "idestablecimiento";
                    $valorClientes = $value["idEstablecimiento"];

                    $clientes = ControladorClientes::ctrMostrarClientes($itemClientes, $valorClientes);

                    echo '<div class="row" style="padding:5px 15px">

                            <div class="form group">

                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                <input type="text" class="form-control nuevoEstablecimiento" id="nuevoEstablecimiento" name="nuevoEstablecimiento" idEstablecimiento="'.$establecimiento["id"].'" value="'.$establecimiento["identificador"].'" readonly>
                                <span class="input-group-addon"><button class="btn btn-danger btn-xs quitarEstablecimiento" idEstablecimiento="'.$establecimiento["id"].'"><i class="fa fa-times"></i></button></span>
                              </div>

                              <div class="row" style="padding:5px 0px">

                                <div class="form group">

                                  <div class="col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                      <input type="text" class="form-control nuevaEmpresa" id="nuevaEmpresa" name="nuevaEmpresa" idEmpresa="'.$empresa["id"].'" value="'.$empresa["empresa"].'" readonly>
                                    </div>
                                  </div>

                                  <div class="col-xs-12" style="padding:5px 15px">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                      <select class="form-control seleccionarCliente" id="seleccionarCliente" name="seleccionarCliente">';

                    if ($value["idCliente"] != "") {
                      echo '<option value="'.$cliente["id"].'">'.$cliente["nombre"].'</option>';
                    } else {
                      echo '<option value="">Seleccionar Cliente</option>';
                    }


                      foreach ($clientes as $key => $value) {

                        echo '<option idCliente="'.$value["id"].'"  value="'.$value["id"].'">'.$value["nombre"].'</option>';

                      }


                    echo'              </select>

                                      <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>
                                    </div>
                                  </div>

                                </div>

                              </div>

                            </div>

                          </div>';
                  }

                ?>

                </div>

                <input type="hidden" name="listaDestinatario" id="listaDestinatario">

                <!--=====================================
                BOTON PARA AGREGAR ESTABLECIMIENTO EN MOVILES
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarEstablecimiento">Agregar Establecimiento</button>

                <hr>

                <!--=====================================
                TIPO CORRESPONDENCIA SELECCIONAR / AGREGAR
                ======================================-->

                <?php

                  $tipo =$editarRadicado["tipo"];

                  echo '<label>Tipo de Correspondencia:</label>
                        <label class="radio-inline nuevoTipoCorrespondencia"><input class="minimal" type="radio" name="nuevoTipoCorrespondencia" id="nuevoTipoCorrespondencia" value="Individual" ';

                  if ($tipo =="Individual") {
                    echo 'checked > Individual</label>';
                  } else {
                    echo '> Individual</label>';
                  }

                  echo '<label class="radio-inline nuevoTipoCorrespondencia"><input class="minimal" type="radio" name="nuevoTipoCorrespondencia" id="nuevoTipoCorrespondencia" value="Masiva" ';

                  if ($tipo =="Masiva") {
                    echo 'checked > Masiva</label>';
                  } else {
                    echo '> Masiva </label>';
                  }

                ?>

                <div class="nuevaCategoria">

                <?php

                $listaCorrespondencia = json_decode($editarRadicado["correspondencia"], true);

                foreach ($listaCorrespondencia as $key => $value) {

                  $itemCategoria = "id";
                  $valorCategoria = $value["id"];

                  $categoria = ControladorCategorias::ctrMostrarCategorias($itemCategoria, $valorCategoria);

                  echo '<div class="row" style="padding:5px 0px">

                          <div class="form group">

                            <div class="col-xs-6" style="padding-right:0px">

                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control nuevaCategoriaCorrespondencia" id="nuevaCategoria" name="nuevaCategoria" idCategoria="'.$categoria["id"].'" value="'.$categoria["categoria"].'" readonly>
                              </div>

                            </div>

                            <div class="col-xs-6">

                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-grid"></i></span>
                                <input min="1" class="form-control nuevaCantidadCorrespondencia" name="nuevaCantidadCorrespondencia" value="'.$value["cantidad"].'" required="" type="number">
                                <span class="input-group-addon"><button class="btn btn-danger btn-xs quitarCategoria" idCategoria="'.$categoria["id"].'"><i class="fa fa-times"></i></button></span>
                              </div>

                            </div>

                            <div class="col-xs-12" style="padding:5px 15px">

                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" class="form-control nuevaObservacion" id="nuevaObservacion" name="nuevaObservacion" value="'.$value["observacion"].'"  >
                              </div>

                            </div>

                          </div>

                        </div>';


                }


                ?>


                </div>


                <input type="hidden" name="listaCorrespondencia" id="listaCorrespondencia">

                <!--=====================================
                BOTON PARA AGREGAR TIPO DE CORRESPONDENCIA
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg">Agregar Tipo Correspondencia</button>

              </div>

            </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>

          </div>

          </form>

          <?php

          $editarCorrespondencia = new ControladorRadicados();
          $editarCorrespondencia -> ctrEditarRadicado();


          ?>

        </div>

      </div>

      <!--=====================================
      TABLA DE ESTABLECIMIENTOS
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

        <div class="box box-primary">

          <div class="box-header with-border">

            <h4>Establecimientos</h4>
          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaRadicados tablas" width="100%">

              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th>Tipo</th>
                  <th>Identificador</th>
                  <th>Empresa</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody>

                <?php

                  $item = null;
                  $valor = null;

                  $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                  foreach ($establecimientos as $key => $value) {

                    $item1 = "id";
                    $valor1 = $value["idempresa"];

                    $empresas = ControladorEmpresas::ctrMostrarEmpresas($item1, $valor1);

                    if ($value["estado"] == 1) {

                      echo '<tr>
                              <td>'.($key+1).'</td>
                              <td>'.$value["tipo"].'</td>
                              <td>'.$value["identificador"].'</td>
                              <td>'.$empresas["empresa"].'</td>
                              <td>
                                <div class="btn-group">
                                  <button class="btn btn-primary btn-sm agregarEstablecimiento recuperarEstablecimiento" idEstablecimiento="'.$value["id"].'">Agregar</button>
                                </div>
                              </td>
                            </tr>';

                    }

                  }

                ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

      <!--=====================================
      TABLA DE CATEGORIAS
      ======================================-->

      <div class="col-lg-2 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border">

            <h4>Categorias</h4>
          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">

              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody>

                <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {

                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td class="text-uppercase">'.$value["categoria"].'</td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-primary btn-sm agregarCategoria recuperarCategoria" idCategoria="'.$value["id"].'">Agregar</button>
                              </div>
                            </td>
                          </tr>';

                  }

                ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>



    </div>

  </section>

</div>


<!--=====================================
MODAL AGREGAR TRANSPORTADORA
======================================-->

<div id="modalAgregarTransportadora" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar transportadora</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA LA TRANSPORTADORA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaTransportadora"  id="nuevaTransportadora" placeholder="Ingresar transportadora" required>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

             <div class="form-group">
              <div class="panel">SUBIR LOGO</div>
              <input type="file" class="nuevoLogo" name="nuevoLogo">
              <p class="help-block">Peso máximo del logo 2MB</p>
              <img src="vistas/img/transportadoras/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Crear transportadora</button>
        </div>

        <?php

          $crearTransportadora = new ControladorTransportadoras();
          $crearTransportadora -> ctrCrearTransportadoraExterno();

        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR REMITENTE
======================================-->

<div id="modalAgregarRemitente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar remitente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL REMITENTE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoRemitente" placeholder="Ingresar remitente" id="nuevoRemitente" required>

              </div>

            </div>

          </div>

        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Crear remitente</button>

        </div>

        <?php

          $crearRemitente = new ControladorRemitentes();
          $crearRemitente -> ctrCrearRemitenteExterno();
         ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA TIPO DE DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>

                <select class="form-control input-lg" name="nuevoTipoDocumento" required>

                  <option value="">Tipo de documento</option>

                  <option value="Cedula de Ciudadania">Cedula de Ciudadania</option>

                  <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>

                  <option value="NIT">NIT</option>

                  <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>

                  <option value="Registro Civil">Registro Civil</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO DE IDENTIFICACIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumento" placeholder="Ingresar No. Documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA EMPRESA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="nuevaEmpresa">

                  <option value="">Seleccionar la Empresa</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

                  foreach ($empresas as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["empresa"].'</option>';
                  }

                  ?>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA ESTABLECIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-tag"></i></span>

                <select class="form-control input-lg" name="nuevoEstablecimiento">

                  <option value="">Seleccionar Establecimiento</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                  foreach ($establecimientos as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["identificador"].'</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA CIUDAD -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCiudad" placeholder="Ingresar ciudad" required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO FIJO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefono Fijo (Indicativo)" data-inputmask="'mask':'(9) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO CELULAR -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCelular" placeholder="Ingresar Celular" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Correo" required>

              </div>

            </div>

          </div>

        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Crear cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearClienteExterno();


      ?>

    </div>

  </div>

</div>
