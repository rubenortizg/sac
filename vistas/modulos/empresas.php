<?php

if ($_SESSION["acceso"]["empresas"] < "4") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar Empresas
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Empresas</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

    <?php

    if ($_SESSION["acceso"]["empresas"] >= "6") {

      echo '
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpresa">
          Agregar empresa
        </button>
      </div>';

    }

    ?>


      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Empresa</th>
           <th>Logo</th>
           <th>Estado</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>
        <?php

        $item = null;
        $valor = null;

        $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

       foreach ($empresas as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["empresa"].'</td>';

                  if($value["logo"] != ""){
                    echo '<td><img src="'.$value["logo"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }


                  if ($_SESSION["acceso"]["empresas"] >= "6") {

                    if($value["estado"] != 0){

                      echo '<td><button class="btn btn-success btn-xs btnActivarEmpresa" idEmpresa="'.$value["id"].'" estadoEmpresa="0">Activado</button></td>';

                    }else{

                      echo '<td><button class="btn btn-danger btn-xs btnActivarEmpresa" idEmpresa="'.$value["id"].'" estadoEmpresa="1">Desactivado</button></td>';

                    }

                  } else {
                    echo '<td></td>';
                  }

                  echo '<td>

                    <div class="btn-group">';

                  if ($_SESSION["acceso"]["empresas"] >= "6") {
                    echo '<button class="btn btn-warning btn-sm btnEditarEmpresa" idEmpresa="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEmpresa"><i class="fa fa-pencil"></i></button>';
                  }

                  if ($_SESSION["acceso"]["empresas"] >= "7") {
                    echo '<button class="btn btn-danger btn-sm btnEliminarEmpresa" idEmpresa="'.$value["id"].'" logoEmpresa="'.$value["logo"].'" empresa="'.$value["empresa"].'"><i class="fa fa-times"></i></button>';
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
MODAL AGREGAR EMPRESA
======================================-->

<div id="modalAgregarEmpresa" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar empresa</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA LA EMPRESA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaEmpresa" id="nuevaEmpresa" placeholder="Ingresar empresa" required>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

             <div class="form-group">
              <div class="panel">SUBIR LOGO</div>
              <input type="file" class="nuevoLogoEmpresa" name="nuevoLogoEmpresa">
              <p class="help-block">Peso máximo del logo 2MB</p>
              <img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Crear empresa</button>
        </div>

        <?php

          $crearEmpresa = new ControladorEmpresas();
          $crearEmpresa -> ctrCrearEmpresa();

        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR EMPRESA
======================================-->

<div id="modalEditarEmpresa" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar empresa</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EMPRESA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-lg" id="editarEmpresa" name="editarEmpresa" value="" required>
                <input type="hidden" name="idEmpresa" id="idEmpresa">
                <input type="hidden" name="empresaActual" id="empresaActual">
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

             <div class="form-group">
              <div class="panel">SUBIR LOGO</div>
              <input type="file" class="nuevoLogoEmpresa" name="editarLogoEmpresa">
              <p class="help-block">Peso máximo del logo 2MB</p>
              <img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="logoActualEmpresa" id="logoActualEmpresa">
            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar empresa</button>
        </div>

        <?php

          $editarEmpresa = new ControladorEmpresas();
          $editarEmpresa -> ctrEditarEmpresa();

        ?>

      </form>
    </div>
  </div>
</div>

<?php

     $borrarEmpresa = new ControladorEmpresas();
     $borrarEmpresa -> ctrBorrarEmpresa();

?>
