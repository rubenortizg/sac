<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Tablero
      <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Tablero</li>
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <?php

        if ($_SESSION["acceso"]["opciones"] >= "4") {
          include "inicio/cajas-superiores.php";
        } else {

          echo '<div class="box box-primary">
                  <div class="box-header">
                    <h2>Bienvenid@ '.$_SESSION["nombre"].'</h2>
                    <h4>Sistema de Administración de Correspondencia</h4>
                    <br>
                    <p>Ultimo login: '.	$_SESSION["login"].'</p>
                  </div>
                </div>';
        }

      ?>

    </div>

    <div class="row">

      <div class="col-lg-12">

        <?php

        if ($_SESSION["acceso"]["opciones"] >= "4") {
          include "reportes/grafico-radicados.php";
        }

        ?>

      </div>

      <div class="col-lg-6">

        <?php

          if ($_SESSION["acceso"]["opciones"] >= "4") {
            include "reportes/categorias-mas-radicadas.php";
          }

        ?>

      </div>

      <div class="col-lg-6">

        <?php

          if ($_SESSION["acceso"]["opciones"] >= "4") {
            include "inicio/radicados-recientes.php";
          }

        ?>

      </div>



    </div>

  </section>

</div>
