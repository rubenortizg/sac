<?php

if ($_SESSION["acceso"]["opciones"] < "7") {
  echo '<script>
    window.location = "inicio";
    </script>';
}

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Crear Perfil
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li><a href="perfiles"><i class="fa fa-users"></i>Perfiles de Usuarios</a></li>
      <li class="active">Crear Perfil</li>
    </ol>

  </section>

  <section class="content">

    <div class="box box-primary">

      <form role="form" method="post" class="formularioPerfilador" id="formularioPerfilador">

      <div class="box-header">
        <!--=====================================
        NOMBRE PERFIL
        ======================================-->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="nuevoPerfil" placeholder="Nombre del perfil" required>
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
                        <input name="'.$perfiles[$i]["Field"].'leer" type="checkbox" class="minimal" value="4">
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="'.$perfiles[$i]["Field"].'crear" type="checkbox" class="minimal" value="2">
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="'.$perfiles[$i]["Field"].'borrar" type="checkbox" class="minimal" value="1">
                      </label>
                    </div>
                  </td>
                </tr>';

            }

          ?>


        </tbody>

       </table>

      </div>

      <div class="box-footer">
        <button  type="submit" class="btn btn-primary pull-right">Crear perfil</button>
      </div>

      </form>

      <?php

      $crearPerfil = new ControladorPerfiles();
      $crearPerfil -> ctrCrearPerfil();

      ?>

    </div>

  </section>

</div>
