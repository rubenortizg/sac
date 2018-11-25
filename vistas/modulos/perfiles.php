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

      Perfiles de Usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Perfiles de Usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

    <?php

    echo '<div class="box-header with-border">';

    if ($_SESSION["acceso"]["opciones"] >= "7") {

      echo '<a href="perfilador">
              <button class="btn btn-primary">
                Crear Perfil de Usuario
              </button>
            </a>';

    }

    ?>

  </div>


      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Perfil</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>

          <?php

            $item = null;
            $valor = null;

            $perfiles = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);

            foreach ($perfiles as $key => $value) {

              echo '<tr>
                      <td>'.($key+1).'</td>';

              echo '  <td>'.$value["perfil"].'</td>';

              echo'   <td>

                        <div class="btn-group">';

              if ($_SESSION["acceso"]["opciones"] >= "7") {
                echo '<button class="btn btn-warning btn-sm btnEditarPerfil" idPerfil="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
              }

              if ($_SESSION["acceso"]["opciones"] >= "7") {
                echo '<button class="btn btn-danger btn-sm btnEliminarPerfil" idPerfil="'.$value["id"].'"><i class="fa fa-times"></i></button>';
              }

              echo ' </div>
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

<?php

  $eliminarPerfil = new ControladorPerfiles();
  $eliminarPerfil -> ctrEliminarPerfil();

?>
