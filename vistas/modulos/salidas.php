<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Salidas de Correspondencia

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Salidas Correspondencia</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

    <?php

    if (isset($_GET["fechaInicial"])) {

      $fechaInicial = $_GET["fechaInicial"];
      $fechaFinal = $_GET["fechaFinal"];

    }else {

      $fechaInicial = null;
      $fechaFinal = null;
    }


    echo '<div class="box-header with-border">';

    echo '<button class="btn btn-primary btnPdfSalidas" fechaInicial='.$fechaInicial.' fechaFinal='.$fechaFinal.'><i class="fa fa-file-pdf-o"></i>
            &nbsp;Generar Reporte
          </button>';

    echo '<button type="button" class="btn btn-default pull-right" id="daterange-btnSalidas">
            <span>
              <i class="fa fa-calendar"></i> Rango de Fecha
            </span>
              <i class="fa fa-caret-down"></i>
          </button>

      </div>';

    ?>

    </div>

    <!-- <div class="row">
      <div class="col-md-12">

        <div class="box box-success ">
          <form method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Selecciona un estado para la Correspondencia</h3>
            </div>

            <div class="box-body">
              <div class="input-group">
                <select class="form-control" name="nuevoEstado">
                  <option value="1">Radicado</option>
                  <option value="2">En reparto</option>
                  <option value="3">Entregado</option>
                  <option value="4">Devuelto</option>
                </select>
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" name="cancel" class="btn btn-default">
                <i class="fa fa-times"></i>
                Cancelar
              </button>
              <button type="submit" class="btn btn-default" name="actualizarEstado">
                <i class="fa fa-check"></i>
                Actualizar estado
              </button>
            </div>
          </form>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-md-12">

      <div class="box">

      <div class="box-header">
        <div class="col-xs-12">
           <div class="btn-group bulk-actions dropdown salidas">
             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
               Acciones Agrupadas <span class="caret"></span>
             </button>
             <ul class="dropdown-menu">

              <li>
               <a href="#" class="seleccionarTodos">
                 <i class="fa fa-check-square"></i>&nbsp;Seleccionar todos
               </a>
              </li>

              <li>
                <a href="#" class="deseleccionarTodos">
                 <i class="fa fa-square-o"></i>&nbsp;Deseleccionar todos
                </a>
              </li>

              <li class="divider"></li>

							<li>
								<a href="#" class="cambiarEstado">
							    <i class="fa fa-refresh"></i>&nbsp;Cambiar estado Correspondencia
						    </a>
							</li>

             </ul>
           </div>
         </div>

      </div>


      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas salidas" width="100%">

        <thead>

         <tr>
           <th style="width:10px">-</th>
           <th style="width:10px">#</th>
           <th>No. Radicado</th>
           <th>Transportadora</th>
           <th>Remitente</th>
           <th>Destinatario</th>
           <th>Establecimiento</th>
           <th>Tipo de Correspondencia</th>
           <th>Fecha Radicado</th>
         </tr>
        </thead>

        <tbody>

          <?php

            if (isset($_GET["fechaInicial"])) {

              $fechaInicial = $_GET["fechaInicial"];
              $fechaFinal = $_GET["fechaFinal"];

            }else {

              $fechaInicial = null;
              $fechaFinal = null;
            }

            $radicados = ControladorRadicados::ctrRangoFechasRadicados($fechaInicial, $fechaFinal);

            foreach ($radicados as $key => $value) {

              $item1 = "id";
              $valor1 = $value["idtransportadora"];

              $transportadora = ControladorTransportadoras::ctrMostrarTransportadoras($item1, $valor1);

              $item2 = "id";
              $valor2 = $value["idremitente"];

              $remitente = ControladorRemitentes::ctrMostrarRemitentes($item2, $valor2);

              $radicado = $value["radicado"];
              $radicado = str_pad($radicado, 7, "0", STR_PAD_LEFT);

              $listaDestinatario = json_decode($value["destinatario"], true);

              echo '<tr>
                      <td>
                        <div class="form-group">
                          <label>
                            <input type="checkbox" class="minimal"  >
                          </label>
                        </div>
                      </td>
                      <td>'.($key+1).'</td>';

              foreach ($listaDestinatario as $key => $destinatario) {

                echo '  <td>R'.$radicado.'</td>
                        <td>'.$transportadora["transportadora"].'</td>
                        <td>'.$remitente["remitente"].'</td>';

                $item3 = "id";
                $valor3 = $destinatario["idEmpresa"];

                $empresa = ControladorEmpresas::ctrMostrarEmpresas($item3, $valor3);

                $item4 = "id";
                $valor4 = $destinatario["idCliente"];

                $cliente = ControladorClientes::ctrMostrarClientes($item4, $valor4);

                $item5 = "id";
                $valor5 = $destinatario["idEstablecimiento"];

                $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item5, $valor5);


                if($destinatario["idCliente"] != null){
                  echo '<td>'.$empresa["empresa"].' - '.$cliente["nombre"].'</td>';
                } else {
                  echo '<td>'.$empresa["empresa"].'</td>';
                }

                echo '  <td>'.$establecimiento["identificador"].'</td>
                        <td>'.$value["tipo"].'</td>
                        <td>'.$value["fecha"].'</td>';

                echo ' </tr>';

              }

            }

          ?>

        </tbody>

       </table>

      </div>

    </div>

    </div>
    </div>

  </section>

</div>

<?php

  $eliminarRadicado = new ControladorRadicados();
  $eliminarRadicado -> ctrEliminarRadicado();

?>
