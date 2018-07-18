<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar Establecimientos
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Establecimientos</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEstablecimiento">
          Agregar Establecimiento
        </button>
      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Tipo</th>
           <th>Identificador</th>
           <th>Empresa</th>
           <th>Estado</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>
        <?php

        $item = null;
        $valor = null;

        $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

        foreach ($establecimientos as $key => $value){

          $item1 = "id";
          $valor1 = $value["idempresa"];

          $empresas = ControladorEmpresas::ctrMostrarEmpresas($item1, $valor1);

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["tipo"].'</td>
                  <td>'.$value["identificador"].'</td>
                  <td>'.$empresas["empresa"].'</td>';


                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivarEstablecimiento" idEstablecimiento="'.$value["id"].'" estadoEstablecimiento="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivarEstablecimiento" idEstablecimiento="'.$value["id"].'" estadoEstablecimiento="1">Desactivado</button></td>';

                  }

                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btn-sm btnEditarEstablecimiento" idEstablecimiento="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEstablecimiento"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-sm btnEliminarEstablecimiento" idEstablecimiento="'.$value["id"].'"><i class="fa fa-times"></i></button>
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
MODAL AGREGAR ESTABLECIMIENTO
======================================-->

<div id="modalAgregarEstablecimiento" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Oficina o Local</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL TIPO DE ESTABLECIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" name="nuevoTipo" required>

                  <option value="">Seleccione tipo</option>
                  <option value="Oficina">Oficina</option>
                  <option value="Local">Local</option>
                  <option value="Bodega">Bodega</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA IDENTIFICADOR -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoIdentificador"  id="nuevoIdentificador" placeholder="Ingresar el identificador" required>
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



          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Crear</button>
        </div>

        <?php

          $crearEstablecimiento = new ControladorEstablecimientos();
          $crearEstablecimiento -> ctrCrearEstablecimiento();

        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR ESTABLECIMIENTO
======================================-->

<div id="modalEditarEstablecimiento" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Oficina o Local</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL TIPO DE ESTABLECIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" name="editarTipo" required>

                  <option value="" id="editarTipo"></option>
                  <option value="Oficina">Oficina</option>
                  <option value="Local">Local</option>
                  <option value="Bodega">Bodega</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA IDENTIFICADOR -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                <input type="text" class="form-control input-lg" id="editarIdentificador" name="editarIdentificador" value="" required>
                <input type="hidden" name="idEstablecimiento" id="idEstablecimiento">
                <input type="hidden" name="establecimientoActual" id="establecimientoActual">
              </div>
            </div>

            <!-- ENTRADA PARA EMPRESA -->

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

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Establecimiento</button>
        </div>

        <?php
          $editarEstablecimiento = new ControladorEstablecimientos();
          $editarEstablecimiento -> ctrEditarEstablecimiento();
        ?>

      </form>
    </div>
  </div>
</div>

<?php
     $borrarEstablecimiento = new ControladorEstablecimientos();
     $borrarEstablecimiento -> ctrBorrarEstablecimiento();
?>
