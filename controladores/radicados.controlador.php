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

            window.location = "radicador";

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


}
