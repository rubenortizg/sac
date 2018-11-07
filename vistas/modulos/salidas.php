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

    echo '<div class="box-header with-border">';

    echo '<button class="btn btn-success btnPdfSalidas"><i class="fa fa-file-pdf-o"></i>
            &nbsp;Generar Reporte
          </button>';

    ?>

    </div>

    <div class="row cambioEstado">



    </div>

    <div class="row">
      <div class="col-md-12">

      <div class="box">

      <div class="box-header">
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
           <th>Estado</th>
           <th>Tipo de Correspondencia</th>
           <th>Fecha Radicado</th>
         </tr>
        </thead>

        <tbody>

          <?php

            $item = "estado";
            $valor = 0;

            $radicados = ControladorRadicados::ctrMostrarRadicadosXEstado($item, $valor);

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
                            <input name="'.$value["radicado"].'" type="checkbox" class="minimal"  >
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

                echo '  <td>'.$establecimiento["identificador"].'</td>';

                if($value["estado"] != 0){

                  echo '<td><button class="btn btn-success btn-xs btnEstadoRadicado" idRadicado="'.$value["id"].'" estadoRadicado="0">Entregado</button></td>';

                }else {

                  echo '<td><button class="btn btn-warning btn-xs btnEstadoRadicado" idRadicado="'.$value["id"].'" estadoRadicado="1">Radicado</button></td>';

                }

                echo '  <td>'.$value["tipo"].'</td>
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
