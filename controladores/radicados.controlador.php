<?php

class ControladorRadicados {

  /* =====================================
  CREAR RADICADO
  ====================================== */

  static public function ctrCrearRadicado(){

    if (isset($_POST["nuevoRadicado"])) {

      $tabla ="radicados";

      $datos = array( "radicado"=>$_POST["radicadoReal"],
                      "fecha"=>$_POST["nuevaFecha"],
                      "idtransportadora"=>$_POST["seleccionarTransportadora"],
                      "idremitente"=>$_POST["seleccionarRemitente"],
                      "destinatario"=>$_POST["listaDestinatario"],
                      "tipo"=>$_POST["nuevoTipoCorrespondencia"],
                      "correspondencia"=>$_POST["listaCorrespondencia"],
                      "idusuario" => $_SESSION["id"]);

      $respuesta = ModeloRadicados::mdlIngresarRadicado($tabla, $datos);



      if($respuesta == "ok"){

        echo '<script>

        swal({

          type: "success",
          title: "¡Correspondencia radicada correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false

        }).then(function(result){

          if(result.value){

            window.open("extensiones/tcpdf/pdf/radicadoBARCODE.php?radicado='.$datos["radicado"].'", "_blank");
            window.location = "radicados";


          }

        });

        </script>';

      }

    }

  }

  /*=============================================
  MOSTRAR RADICADOS
  =============================================*/

  static public function ctrMostrarRadicados($item, $valor){

    $tabla = "radicados";

    $respuesta = ModeloRadicados::mdlMostrarRadicados($tabla, $item, $valor);

    return $respuesta;
  }


  /*=============================================
  MOSTRAR RADICADOS DESCENDENTE
  =============================================*/

  static public function ctrMostrarRadicadosDescendente($item, $valor){

    $tabla = "radicados";

    $respuesta = ModeloRadicados::mdlMostrarRadicadosDescendente($tabla, $item, $valor);

    return $respuesta;
  }


  /* =====================================
  EDITAR RADICADO
  ====================================== */

  static public function ctrEditarRadicado(){

    if (isset($_POST["editarRadicado"])) {

      $tabla ="radicados";

      $item = "radicado";
      $valor = $_POST["radicadoReal"];

      $traerRadicado = ModeloRadicados::mdlMostrarRadicados($tabla, $item, $valor);

      /* =====================================
      VERIFICAR SI VIENEN DESTINATARIO EDITADO
      ====================================== */

      if ($_POST["listaDestinatario"] == "") {
        $listaDestinatario = $traerRadicado["destinatario"];
      } else {
        $listaDestinatario = $_POST["listaDestinatario"];
      }

      if ($_POST["listaCorrespondencia"] == "") {
        $listaCorrespondencia = $traerRadicado["correspondencia"];
      } else {
        $listaCorrespondencia = $_POST["listaCorrespondencia"];
      }


      $datos = array("radicado"=>$_POST["radicadoReal"],
                    "fecha"=>$_POST["nuevaFecha"],
                    "idtransportadora"=>$_POST["seleccionarTransportadora"],
                    "idremitente"=>$_POST["seleccionarRemitente"],
                    "destinatario"=>$listaDestinatario,
                    "tipo"=>$_POST["nuevoTipoCorrespondencia"],
                    "correspondencia"=>$listaCorrespondencia,
                    "idusuario" => $_SESSION["id"]);

      $respuesta = ModeloRadicados::mdlEditarRadicado($tabla, $datos);

      if($respuesta == "ok"){

        echo '<script>

        swal({

          type: "success",
          title: "¡El radicado se actualizo correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false

        }).then(function(result){

          if(result.value){

            window.location = "radicados";

          }

        });

        </script>';

      }

    }

  }

  /* =====================================
  ELIMINAR RADICADO
  ====================================== */

  static public function ctrEliminarRadicado(){

    if(isset($_GET["idRadicado"])){

      $tabla ="radicados";
      $datos = $_GET["idRadicado"];

      $respuesta = ModeloRadicados::mdlEliminarRadicado($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El radicado ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "radicados";

                }
              })

        </script>';

      }

    }

  }


  /*=============================================
  RANGO FECHAS
  =============================================*/

  static public function ctrRangoFechasRadicados($fechaInicial, $fechaFinal){

    $tabla = "radicados";

    $respuesta = ModeloRadicados::mdlRangoFechasRadicados($tabla, $fechaInicial, $fechaFinal);

    return $respuesta;
  }


  /* =====================================
  DESCARGA REPORTE EXCEL
  ====================================== */

  static public function ctrDescargarReporte(){

    if (isset($_GET["reporte"])) {

      $tabla = "radicados";

      if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

        $radicados = ModeloRadicados::mdlRangoFechasRadicados($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

      } else {

        $item = null;
        $valor = null;

        $radicados = ModeloRadicados::mdlMostrarRadicados($tabla, $item, $valor);
      }

      /* =====================================
      CREAR REPORTE ARCHIVO EXCEL
      ====================================== */

      $Name = $_GET["reporte"].'.xls';

      header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate");
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public");
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

      echo utf8_decode("<table border='0'>

					<tr>
					<td style='font-weight:bold; border:1px solid #eee;'>No. RADICADO</td>
          <td style='font-weight:bold; border:1px solid #eee;'>TRANSPORTADORA</td>
          <td style='font-weight:bold; border:1px solid #eee;'>REMITENTE</td>
          <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ESTABLECIMIENTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>EMPRESA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO</td>
          <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
          <td style='font-weight:bold; border:1px solid #eee;'>OBSERVACIONES</td>
					</tr>");

      foreach ($radicados as $key => $value) {

        $transportadora = ControladorTransportadoras::ctrMostrarTransportadoras("id", $value["idtransportadora"]);
        $remitente = ControladorRemitentes::ctrMostrarRemitentes("id", $value["idremitente"]);

        echo utf8_decode("<tr>

          <td style='border:1px solid #eee;'>R".str_pad($value["radicado"], 7, "0", STR_PAD_LEFT)."</td>
          <td style='border:1px solid #eee;'>".$transportadora["transportadora"]."</td>
          <td style='border:1px solid #eee;'>".$remitente["remitente"]."</td>
          <td style='border:1px solid #eee;'>".$value["fecha"]."</td>
          <td style='border:1px solid #eee;'>");

        $listaDestinatario = json_decode($value["destinatario"], true);

        foreach ($listaDestinatario as $key => $valueDestinatario) {


          $itemEmpresa = "id";
          $valorEmpresa = $valueDestinatario["idEmpresa"];

          $empresa = ControladorEmpresas::ctrMostrarEmpresas($itemEmpresa, $valorEmpresa);

          $itemCliente = "id";
          $valorCliente = $valueDestinatario["idCliente"];

          $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

          $itemEstablecimiento = "id";
          $valorEstablecimiento = $valueDestinatario["idEstablecimiento"];

          $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

          echo utf8_decode($establecimiento["identificador"]."</td>
            <td style='border:1px solid #eee;'>".$empresa["empresa"]."</td>
            <td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
            <td style='border:1px solid #eee;'>"
          );

        }

        $listaCorrespondencia = json_decode($value["correspondencia"], true);

        foreach ($listaCorrespondencia as $key => $valueCorrespondencia) {


          $itemCategoria = "id";
          $valorCategoria = $valueCorrespondencia["id"];

          $categoria = ControladorCategorias::ctrMostrarCategorias($itemCategoria, $valorCategoria);

          echo utf8_decode($categoria["categoria"]."<br>");

        }

        echo utf8_decode("</td><td style='border:1px solid #eee;'>");

        foreach ($listaCorrespondencia as $key => $valueCorrespondencia) {

          echo utf8_decode($valueCorrespondencia["cantidad"]."<br>");

        }

        echo utf8_decode("</td><td style='border:1px solid #eee;'>");

        foreach ($listaCorrespondencia as $key => $valueCorrespondencia) {

          echo utf8_decode($valueCorrespondencia["observacion"]."<br>");

        }

        echo utf8_decode("</td></tr>");


      }

      echo "</table>";



    }

  }

  /*=============================================
  MOSTRAR RADICADOS X ESTADO
  =============================================*/

  static public function ctrMostrarRadicadosXEstado($item, $valor){

    $tabla = "radicados";

    $respuesta = ModeloRadicados::mdlMostrarRadicadosXEstado($tabla, $item, $valor);

    return $respuesta;
  }


}
