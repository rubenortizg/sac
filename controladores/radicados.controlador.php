<?php

class ControladorRadicados {

  /* =====================================
  CREAR RADICADOS
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
  EDITAR CLIENTES
  ====================================== */

  static public function ctrEditarRadicado(){

    if (isset($_POST["editarRadicado"])) {


      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"])  &&
         preg_match('/^[0-9]+$/', $_POST["editarDocumento"]) &&
         preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) &&
         preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
         preg_match('/^[()\-0-9 ]+$/', $_POST["editarCelular"]) &&
         preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCiudad"])){

           $tabla = "clientes";

           $datos = array("id" => $_POST["idCliente"],
                          "identificacion" => $_POST["editarDocumento"],
     					            "tipoid" => $_POST["editarTipoDocumento"],
                          "nombre" => $_POST["editarCliente"],
                          "correo" => $_POST["editarEmail"],
                          "telfijo" => $_POST["editarTelefono"],
                          "celular" => $_POST["editarCelular"],
                          "ciudad" => $_POST["editarCiudad"],
                          "idempresa" => $_POST["editarEmpresa"],
                          "idestablecimiento" => $_POST["editarEstablecimiento"],
                          "idusuario" => $_SESSION["id"]);

            $respuesta = ModeloRadicados::mdlEditarRadicado($tabla, $datos);

            if($respuesta == "ok"){

    					echo '<script>

    					swal({

    						type: "success",
    						title: "¡El cliente ha sido editado correctamente!",
    						showConfirmButton: true,
    						confirmButtonText: "Cerrar",
                closeOnConfirm: false

    					}).then(function(result){

    						if(result.value){

    							window.location = "clientes";

    						}

    					});


    					</script>';


    				}

      } else {

        echo '<script>

         swal({

           type: "error",
           title: "¡El cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm: false
         }).then(function(result){

           if(result.value){

             window.location = "clientes";

           }

         });


       </script>';

      }

    }

  }

  /* =====================================
  ELIMINAR CLIENTE
  ====================================== */

  static public function ctrEliminarRadicado(){

    if(isset($_GET["idRadicado"])){

      $tabla ="clientes";
      $datos = $_GET["idCliente"];

      $respuesta = ModeloRadicados::mdlEliminarRadicado($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El cliente ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "clientes";

                }
              })

        </script>';

      }

    }

  }


}
