<?php

  echo '<aside class="main-sidebar">
          <section class="sidebar">
            <ul class="sidebar-menu">';

        if ($_SESSION["acceso"]["inicio"] >= "0") {
          echo '<li class="active">
                  <a href="inicio">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                  </a>
                </li>';
        }

        if ($_SESSION["acceso"]["usuarios"] == "7") {
          echo '<li>
                  <a href="usuarios">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                  </a>
                </li>';
        }

        if ($_SESSION["acceso"]["transportadoras"] >= "4") {
          echo '<li>
                  <a href="transportadoras">
                    <i class="fa fa-truck"></i>
                    <span>Transportadoras</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["empresas"] >= "4") {
          echo '<li>
                  <a href="empresas">
                    <i class="fa fa-building"></i>
                    <span>Empresas</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["clientes"] >= "4") {
          echo '<li>
                  <a href="clientes">
                    <i class="fa fa-users"></i>
                    <span>Clientes</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["establecimientos"] >= "4") {
          echo '<li>
                  <a href="establecimientos">
                    <i class="fa fa-briefcase"></i>
                    <span>Establecimientos</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["remitentes"] >= "4") {
          echo '<li>
                  <a href="remitentes">
                    <i class="fa fa-send"></i>
                    <span>Remitentes</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["categorias"] >= "4") {
          echo '<li>
                  <a href="categorias">
                    <i class="fa fa-tags"></i>
                    <span>Categorias</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["radicados"] >= "4") {
          echo '<li class="treeview">
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
                    </li>';
          if ($_SESSION["acceso"]["radicados"] >= "6") {
          echo '    <li>
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
                    </li>';
          }

          echo '   </ul>
                </li>';
        }


        if ($_SESSION["acceso"]["reportes"] >= "4") {
          echo '<li>
                  <a href="reportes">
                    <i class="fa fa-line-chart"></i>
                    <span>Reportes</span>
                  </a>
                </li>';
        }


        if ($_SESSION["acceso"]["opciones"] >= "6") {
          echo '<li class="treeview">
                  <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Opciones</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                  <ul class="treeview-menu">';
        }

        if ($_SESSION["acceso"]["opciones"] >= "6") {
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

        if ($_SESSION["acceso"]["opciones"] >= "7") {
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

        if ($_SESSION["acceso"]["opciones"] >= "6") {
            echo '</ul>
                </li>';
        }

  echo '</ul>
      </section>
    </aside>';


?>
