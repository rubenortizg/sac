<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar transportadoras
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar transportadoras</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <?php

      if ($_SESSION["acceso"]["transportadoras"] == "6" || $_SESSION["acceso"]["transportadoras"] == "5"  ) {
        echo '<div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTransportadora">
                  Agregar transportadora
                </button>
              </div>';
      }

      ?>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Transportadora</th>
           <th>Logo</th>
           <th>Estado</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>
        <?php

        $item = null;
        $valor = null;

        $transportadoras = ControladorTransportadoras::ctrMostrarTransportadoras($item, $valor);

       foreach ($transportadoras as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["transportadora"].'</td>';

                  if($value["logo"] != ""){
                    echo '<td><img src="'.$value["logo"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="vistas/img/transportadoras/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }

                  if ($_SESSION["acceso"]["transportadoras"] == "6" || $_SESSION["acceso"]["transportadoras"] == "5" ) {
                    if($value["estado"] != 0){

                      echo '<td><button class="btn btn-success btn-xs btnActivarTransportadora" idTransportadora="'.$value["id"].'" estadoTransportadora="0">Activado</button></td>';

                    }else{

                      echo '<td><button class="btn btn-danger btn-xs btnActivarTransportadora" idTransportadora="'.$value["id"].'" estadoTransportadora="1">Desactivado</button></td>';

                    }
                  }else {
                    echo '<td></td>';
                  }

                  echo '<td>
                    <div class="btn-group">';

                  if ($_SESSION["acceso"]["transportadoras"] == "6" || $_SESSION["acceso"]["transportadoras"] == "5" ) {
                    echo '<button class="btn btn-warning btn-sm btnEditarTransportadora" idTransportadora="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarTransportadora"><i class="fa fa-pencil"></i></button>';
                  }

                  if ($_SESSION["acceso"]["transportadoras"] == "6") {
                    echo '<button class="btn btn-danger btn-sm btnEliminarTransportadora" idTransportadora="'.$value["id"].'" logoTransportadora="'.$value["logo"].'" transportadora="'.$value["transportadora"].'"><i class="fa fa-times"></i></button>';
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
          $crearTransportadora -> ctrCrearTransportadora();

        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarTransportadora" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar transportadora</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                <input type="text" class="form-control input-lg" id="editarTransportadora" name="editarTransportadora" value="" required>
                <input type="hidden" name="idTransportadora" id="idTransportadora">
                <input type="hidden" name="transportadoraActual" id="transportadoraActual">
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

             <div class="form-group">
              <div class="panel">SUBIR LOGO</div>
              <input type="file" class="nuevoLogo" name="editarLogo">
              <p class="help-block">Peso máximo del logo 2MB</p>
              <img src="vistas/img/transportadoras/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="logoActual" id="logoActual">
            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar transportadora</button>
        </div>

        <?php

          $editarTransportadora = new ControladorTransportadoras();
          $editarTransportadora -> ctrEditarTransportadora();

        ?>

      </form>
    </div>
  </div>
</div>

<?php

     $borrarTransportadora = new ControladorTransportadoras();
     $borrarTransportadora -> ctrBorrarTransportadora();

?>
