<?php

if ($_SESSION["acceso"]["radicados"] < "7") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Editar Perfil
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Editar Perfil</li>
    </ol>

  </section>

  <section class="content">

    <div class="box box-primary">

      <form role="form" method="post" class="formularioPerfilador" id="formularioPerfilador">

      <!--=====================================
      PERFIL A EDITAR
      ======================================-->

      <?php

        $item = "id";
        $valor = $_GET["idPerfil"];

        $editarPerfil = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);

      ?>

      <div class="box-header">
        <!--=====================================
        NOMBRE PERFIL
        ======================================-->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <?php
              echo '<input type="text" class="form-control" name="editarPerfil" value="'.$editarPerfil["perfil"].'">';
              echo '<input type="hidden" name="idPerfil" value="'.$valor.'">';
            ?>

          </div>
        </div>
      </div>

      <div class="box-body">

        <!--=====================================
        PERMISOS
        ======================================-->

       <table class="table table-bordered table-striped dt-responsive" width="100%">

        <thead>
         <tr>
           <th>Modulo</th>
           <th>Leer</th>
           <th>Crear</th>
           <th>Borrar</th>
         </tr>
        </thead>

        <tbody>

          <?php

            $perfiles = ControladorPerfiles::ctrMostrarColumnas();

            for ($i=2; $i < count($perfiles); $i++) {

              echo '<tr>
                  <td>'.$perfiles[$i]["Field"].'</td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="editar'.$perfiles[$i]["Field"].'leer" type="checkbox" class="minimal" value="4"';

              if ($editarPerfil[$perfiles[$i]["Field"]] >= 4) {
                echo ' checked>';
              } else {
                echo '>';
              }

              echo '  </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="editar'.$perfiles[$i]["Field"].'crear" type="checkbox" class="minimal" value="2"';

              if ($editarPerfil[$perfiles[$i]["Field"]] >= 6) {
                echo ' checked>';
              } else {
                echo '>';
              }

              echo '  </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="editar'.$perfiles[$i]["Field"].'borrar" type="checkbox" class="minimal" value="1"';

              if ($editarPerfil[$perfiles[$i]["Field"]] >= 7) {
                echo ' checked>';
              } else {
                echo '>';
              }
              echo '  </label>
                    </div>
                  </td>
                </tr>';

            }

          ?>


        </tbody>

       </table>

      </div>

      <div class="box-footer">
        <button  type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>
      </div>

      </form>

      <?php

      $editarPerfil = new ControladorPerfiles();
      $editarPerfil -> ctrEditarPerfil();

      ?>

    </div>

  </section>

</div>
