<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Radicacion de Correspondencia

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Radicacion Correspondencia</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="radicador">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalRadicar">
            Radicar Correspondencia
          </button>
        </a>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>No. Radicado</th>
           <th>Transportadora</th>
           <th>Remitente</th>
           <th>Destinatario</th>
           <th>Establecimiento</th>
           <th>Tipo de Correspondencia</th>
           <th>Fecha Radicado</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>

          <?php

            $item = null;
            $valor = null;

            $radicados = ControladorRadicados::ctrMostrarRadicados($item, $valor);



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
                        <td>'.$value["fecha"].'</td>
                        <td>

                          <div class="btn-group">

                            <button class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i></button>
                            <button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button>

                            <button class="btn btn-warning btn-sm btnEditarRadicado" idRadicado="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                            <button class="btn btn-danger btn-sm btnEliminarRadicado" idRadicado="'.$value["id"].'"><i class="fa fa-times"></i></button>

                          </div>

                        </td>

                      </tr>';

              }

            }

          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php

  $eliminarRadicado = new ControladorRadicados();
  $eliminarRadicado -> ctrEliminarRadicado();

?>
