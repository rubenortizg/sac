
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

        include "inicio/cajas-superiores.php";

      ?>

    </div>

    <div class="row">

      <div class="col-lg-12">

        <?php

          include "reportes/grafico-radicados.php"

        ?>

      </div>

      <div class="col-lg-6">

        <?php

          include "reportes/categorias-mas-radicadas.php"

        ?>

      </div>

      <div class="col-lg-6">

        <?php

          include "inicio/radicados-recientes.php"

        ?>

      </div>



    </div>

  </section>

</div>
