<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">

      <li class="active">
        <a href="inicio">
          <i class="fa fa-home"></i>
          <span>Inicio</span>
        </a>
      </li>

      <?php

        if ($_SESSION["acceso"]["usuarios"] == "6") {
          echo '<li>
                  <a href="usuarios">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                  </a>
                </li>';
        }

      ?>


      <li>
        <a href="transportadoras">
          <i class="fa fa-truck"></i>
          <span>Transportadoras</span>
        </a>
      </li>

      <li>
        <a href="empresas">
          <i class="fa fa-building"></i>
          <span>Empresas</span>
        </a>
      </li>

      <li>
        <a href="clientes">
          <i class="fa fa-users"></i>
          <span>Clientes</span>
        </a>
      </li>

      <li>
        <a href="establecimientos">
          <i class="fa fa-briefcase"></i>
          <span>Establecimientos</span>
        </a>
      </li>
      
      <li>
        <a href="remitentes">
          <i class="fa fa-send"></i>
          <span>Remitentes</span>
        </a>
      </li>

      <li>
        <a href="categorias">
          <i class="fa fa-tags"></i>
          <span>Categorias</span>
        </a>
      </li>

      <li class="treeview menu-open">
        <a href="#">
          <i class="fa fa-envelope"></i>
          <span>Radicacion</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          <li>
            <a href="radicados">
              <i class="fa fa-envelope"></i>
              <span>Radicados</span>
            </a>
          </li>
          <li>
            <a href="radicador">
              <i class="fa fa-sign-in"></i>
              <span>Radicar &nbsp<i class="fa fa-envelope"></i></span>
            </a>
          </li>
          <li>
            <a href="facturas">
              <i class="fa fa-inbox"></i>
              <span>Radicar Facturas</span>
            </a>
          </li>
          <li>
            <a href="salidas">
              <i class="fa fa-sign-out"></i>
              <span>Registrar Salidas</span>
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="reportes">
          <i class="fa fa-line-chart"></i>
          <span>Reportes</span>
        </a>
      </li>

      <?php

        if ($_SESSION["acceso"]["opciones"] == "6"  || $_SESSION["acceso"]["opciones"] == "5") {
          echo '<li class="treeview menu-open">
                  <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Opciones</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                  <ul class="treeview-menu">';
        }

        if ($_SESSION["acceso"]["opciones"] == "6"  || $_SESSION["acceso"]["opciones"] == "5") {
            echo '  <li>
                      <a href="clientes-facturas">
                        <i class="fa fa-inbox"></i>
                        <span>Facturas de Clientes</span>
                      </a>
                    </li>

                    <li>
                      <a href="codigos-facturas">
                        <i class="fa fa-barcode"></i>
                        <span>Codigos de Facturas</span>
                      </a>
                    </li>';
        }

        if ($_SESSION["acceso"]["opciones"] == "6") {
            echo '  <li>
                      <a href="tipos">
                        <i class="fa fa-briefcase"></i>
                        <span>Tipos Establecimiento</span>
                      </a>
                    </li>

                    <li>
                      <a href="perfiles">
                        <i class="fa fa-users"></i>
                        <span>Perfiles de Usuario</span>
                      </a>
                    </li>

                    <li>
                      <a href="configuracion">
                        <i class="fa fa-cogs"></i>
                        <span>Configuración App</span>
                      </a>
                    </li>';
        }

        if ($_SESSION["acceso"]["opciones"] == "6"  || $_SESSION["acceso"]["opciones"] == "5") {
            echo '</ul>
                </li>';
        }

      ?>



    </ul>
  </section>
</aside>
