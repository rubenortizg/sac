<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar Facturas de Clientes
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Facturas de  Clientes</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">


        <?php

        if ($_SESSION["acceso"]["opciones"] >= "6") {
          echo '<div class="box-header with-border">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClienteFactura">
                    Agregar Factura de Cliente
                  </button>
                </div>';
        }

        ?>



      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Tipo</th>
           <th>Operador</th>
           <th>Cuenta Contrato</th>
           <th>Empresa</th>
           <th>Establecimiento</th>
           <th>Estado</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>
        <?php

        $item = null;
        $valor = null;

        $clienteFacturas = ControladorClienteFacturas::ctrMostrarClienteFacturas($item, $valor);

        foreach ($clienteFacturas as $key => $value){

          $itemEmpresa = "id";
          $valorEmpresa = $value["idempresa"];

          $empresa = ControladorEmpresas::ctrMostrarEmpresas($itemEmpresa, $valorEmpresa);

          $itemEstablecimiento = "id";
          $valorEstablecimiento = $value["idestablecimiento"];

          $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

          $itemOperador = "id";
          $valorOperador = $value["idoperador"];

          $operador = ControladorOperadores::ctrMostrarOperadores($itemOperador, $valorOperador);

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$operador["tipo"].'</td>
                  <td>'.$operador["nombre"].'</td>
                  <td>'.$value["ctacontrato"].'</td>
                  <td>'.$empresa["empresa"].'</td>
                  <td>'.$establecimiento["identificador"].'</td>';



                  if ($_SESSION["acceso"]["opciones"] >= "6") {
                    if($value["estado"] != 0){

                      echo '<td><button class="btn btn-success btn-xs btnActivarClienteFactura" idClienteFactura="'.$value["id"].'" estadoClienteFactura="0">Activado</button></td>';

                    }else{

                      echo '<td><button class="btn btn-danger btn-xs btnActivarClienteFactura" idClienteFactura="'.$value["id"].'" estadoClienteFactura="1">Desactivado</button></td>';

                    }
                  } else {
                    echo '<td></td>';
                  }

                  echo '<td>
                        <div class="btn-group">';

                  if ($_SESSION["acceso"]["opciones"] >= "6") {
                    echo '<button class="btn btn-warning btn-sm btnEditarClienteFactura" idClienteFactura="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarClienteFactura"><i class="fa fa-pencil"></i></button>';
                  }

                  if ($_SESSION["acceso"]["opciones"] >= "7") {
                    echo '<button class="btn btn-danger btn-sm btnEliminarClienteFactura" idClienteFactura="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                  }
                  echo '</div>
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
MODAL AGREGAR CLIENTE - FACTURA
======================================-->

<div id="modalAgregarClienteFactura" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Factura de Cliente</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR OPERADOR -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-inbox"></i></span>

                <select class="form-control input-lg" name="nuevoOperador" required>

                  <option value="">Seleccionar el Operador</option>

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

            <!-- ENTRADA PARA CUENTA CONTRATO -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaCtaContrato"  id="nuevaCtaContrato" placeholder="Ingresar la cuenta contrato" required>
              </div>
            </div>

            <!-- ENTRADA PARA EMPRESA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="nuevaEmpresa" required>

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

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" name="nuevoEstablecimiento" required>

                  <option value="">Seleccionar el Establecimiento</option>

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



          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Crear Factura de Cliente</button>
        </div>

        <?php

          $crearClienteFactura = new ControladorClienteFacturas();
          $crearClienteFactura -> ctrCrearClienteFactura();

        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR CLIENTE - FACTURA
======================================-->

<div id="modalEditarClienteFactura" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Factura de Cliente</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR EL OPERADOR -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-inbox"></i></span>

                <select class="form-control input-lg" name="editarOperador" required>

                  <option value="" id="editarOperador"></option>
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

            <!-- ENTRADA PARA CUENTA CONTRATO -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                <input type="text" class="form-control input-lg" id="editarCtaContrato" name="editarCtaContrato" value="" required>
                <input type="hidden" name="idClienteFactura" id="idClienteFactura">
                <input type="hidden" name="clienteFacturaActual" id="clienteFacturaActual">
              </div>
            </div>

            <!-- ENTRADA PARA EMPRESA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="editarEmpresa" required>

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

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" name="editarEstablecimiento" required>

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

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Factura de Cliente</button>
        </div>

        <?php
          $editarClienteFactura = new ControladorClienteFacturas();
          $editarClienteFactura -> ctrEditarClienteFactura();
        ?>

      </form>
    </div>
  </div>
</div>

<?php
     $borrarClienteFactura = new ControladorClienteFacturas();
     $borrarClienteFactura -> ctrBorrarClienteFactura();
?>
