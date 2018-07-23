<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Radicacion de Correspondencia

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Radicacion Correspondencia</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="radicador">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalRadicar">
            Radicar Correspondencia
          </button>
        </a>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>No. Radicado</th>
           <th>Transportadora</th>
           <th>Remitente</th>
           <th>Destinatario</th>
           <th>Establecimiento</th>
           <th>Tipo de Correspondencia</th>
           <th>Fecha Radicado</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>

          <?php

            $item = null;
            $valor = null;

            $radicados = ControladorRadicados::ctrMostrarRadicados($item, $valor);

            foreach ($radicados as $key => $value) {

              $item1 = "id";
              $valor1 = $value["idtransportadora"];

              $transportadora = ControladorTransportadoras::ctrMostrarTransportadoras($item1, $valor1);

              $item2 = "id";
              $valor2 = $value["iddestinatario"];

              $destinatario = ControladorEmpresas::ctrMostrarEmpresas($item2, $valor2);

              $item3 = "id";
              $valor3 = $value["idestablecimiento"];

              $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item3, $valor3);

              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["radicado"].'</td>
                      <td>'.$transportadora["transportadora"].'</td>
                      <td>'.$value["remitente"].'</td>
                      <td>'.$destinatario["empresa"].'</td>
                      <td>'.$establecimiento["identificador"].'</td>
                      <td>'.$value["tipocorrespondencia"].'</td>
                      <td>'.$value["fecha"].'</td>
                      <td>

                        <div class="btn-group">

                          <button class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i></button>
                          <button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button>

                          <button class="btn btn-warning btn-sm btnEditarRadicado" data-toggle="modal" data-target="#modalEditarRadicado" idRadicado="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btn-sm btnEliminarRadicado" idRadicado="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        </div>

                      </td>

                    </tr>';

            }
          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>



<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

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

                <select class="form-control input-lg" name="editarTipoDocumento" required>

                  <option value="" id="editarTipoDocumento"></option>
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

                <input type="number" min="0" class="form-control input-lg" name="editarDocumento" id="editarDocumento" required>
                <input type="hidden" name="idCliente" id="idCliente">

              </div>

            </div>

            <!-- ENTRADA PARA NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>

              </div>

            </div>

            <!-- ENTRADA PARA EMPRESA U OFICINA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="editarEmpresa">

                  <option value="" id="editarEmpresa"></option>

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
                <select class="form-control input-lg" name="editarEstablecimiento">

                  <option value="" id="editarEstablecimiento"></option>

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

                <input type="text" class="form-control input-lg" name="editarCiudad" id="editarCiudad" required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO FIJO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(9) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO CELULAR -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

                <input type="text" class="form-control input-lg" name="editarCelular" id="editarCelular" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>

              </div>

            </div>

          </div>

        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar cliente</button>

        </div>

      </form>

      <?php

        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();

      ?>

    </div>

  </div>

</div>

<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>
