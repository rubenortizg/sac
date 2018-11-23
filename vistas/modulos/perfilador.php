<?php

if ($_SESSION["acceso"]["radicados"] != "6") {
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
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Crear Perfil</li>
    </ol>

  </section>

  <section class="content">

    <div class="box box-primary">

      <form role="form" method="post" class="formularioRadicador" id="formularioRadicador">

      <div class="box-header">
        <!--=====================================
        NOMBRE PERFIL
        ======================================-->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" id="nuevoRadicado" name="nuevoRadicado" placeholder="Nombre del perfil">
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
                        <input name="'.$perfiles[$i]["Field"].'leer" type="checkbox" class="minimal">
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="'.$perfiles[$i]["Field"].'crear" type="checkbox" class="minimal"  >
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label>
                        <input name="'.$perfiles[$i]["Field"].'borrar" type="checkbox" class="minimal"  >
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

      $crearPerfi = new ControladorPerfiles();
      $crearPerfi -> ctrCrearPerfil();

      ?>

    </div>

  </section>

</div>
