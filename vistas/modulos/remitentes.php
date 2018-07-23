<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Remitentes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Remitentes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRemitente">

          Agregar remitente

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Remitente</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

          <?php

            $item = null;
            $valor = null;

            $remitentes = ControladorRemitentes::ctrMostrarRemitentes($item, $valor);

            foreach ($remitentes as $key => $value) {

              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td class="text-uppercase">'.$value["remitente"].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btn-sm btnEditarRemitente" idRemitente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarRemitente"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btn-sm btnEliminarRemitente" idRemitente="'.$value["id"].'"><i class="fa fa-times"></i></button>
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
          $crearRemitente -> ctrCrearRemitente();
         ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR REMITENTE
======================================-->

<div id="modalEditarRemitente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar remitente</h4>

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

                <input type="text" class="form-control input-lg" name="editarRemitente" id="editarRemitente" required>
                <input type="hidden" name="idRemitente" id="idRemitente" required>
                <input type="hidden" name="remitenteActual" id="remitenteActual">

              </div>

            </div>

          </div>

        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar remitente</button>

        </div>

        <?php

          $editarRemitente = new ControladorRemitentes();
          $editarRemitente -> ctrEditarRemitente();
         ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarRemitente = new ControladorRemitentes();
  $borrarRemitente -> ctrBorrarRemitente();

 ?>
