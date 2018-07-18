<?php

class ControladorClientes {

  /* =====================================
  CREAR CLIENTES
  ====================================== */

  static public function ctrCrearCliente(){

    if (isset($_POST["nuevoCliente"])) {


      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"])  &&
         preg_match('/^[0-9]+$/', $_POST["nuevoDocumento"]) &&
         preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) &&
         preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
         preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoCelular"]) &&
         preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCiudad"])){

           $tabla = "clientes";

           $datos = array("identificacion" => $_POST["nuevoDocumento"],
     					            "tipoid" => $_POST["nuevoTipoDocumento"],
                          "nombre" => $_POST["nuevoCliente"],
                          "correo" => $_POST["nuevoEmail"],
                          "telfijo" => $_POST["nuevoTelefono"],
                          "celular" => $_POST["nuevoCelular"],
                          "ciudad" => $_POST["nuevaCiudad"],
                          "empresa" => $_POST["nuevaEmpresa"],
                          "oficinalocal" => $_POST["nuevoLocalOficina"],
                          "idusuario" => $_SESSION["id"]);

            $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

            if($respuesta == "ok"){

    					echo '<script>

    					swal({

    						type: "success",
    						title: "¡El cliente ha sido guardado correctamente!",
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

  /*=============================================
  MOSTRAR CLIENTES
  =============================================*/

  static public function ctrMostrarClientes($item, $valor){

    $tabla = "clientes";

    $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

    return $respuesta;
  }


  /* =====================================
  EDITAR CLIENTES
  ====================================== */

  static public function ctrEditarCliente(){

    if (isset($_POST["editarCliente"])) {


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
                          "empresa" => $_POST["editarEmpresa"],
                          "oficinalocal" => $_POST["editarLocalOficina"],
                          "idusuario" => $_SESSION["id"]);

            $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

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

  static public function ctrEliminarCliente(){

    if(isset($_GET["idCliente"])){

      $tabla ="clientes";
      $datos = $_GET["idCliente"];

      $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

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
