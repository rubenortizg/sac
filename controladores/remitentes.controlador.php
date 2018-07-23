<?php

class ControladorRemitentes {

  /* =====================================
  CREAR REMITENTES
  ====================================== */

  static public function ctrCrearRemitente(){

    if (isset($_POST["nuevoRemitente"])) {

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["nuevoRemitente"])){

        $tabla = "remitentes";

        $datos = $_POST["nuevoRemitente"];

        $respuesta = ModeloRemitentes::mdlIngresarRemitente($tabla, $datos);

        if ($respuesta == "ok") {

          echo '<script>

					swal({

						type: "success",
						title: "¡El remitente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "remitentes";

						}

					});


					</script>';
        }

      } else {

        echo '<script>

					swal({

						type: "error",
						title: "¡El remitente no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "remitentes";

						}

					});

				</script>';

      }

    }

  }


  /* =====================================
  CREAR REMITENTES - EXTERNO
  ====================================== */

  static public function ctrCrearRemitenteExterno(){

    if (isset($_POST["nuevoRemitente"])) {

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["nuevoRemitente"])){

        $tabla = "remitentes";

        $datos = $_POST["nuevoRemitente"];

        $respuesta = ModeloRemitentes::mdlIngresarRemitente($tabla, $datos);

        if ($respuesta == "ok") {

          echo '<script>

          swal({

            type: "success",
            title: "¡El remitente ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "radicador";

            }

          });


          </script>';
        }

      } else {

        echo '<script>

          swal({

            type: "error",
            title: "¡El remitente no puede ir vacía o llevar caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "radicador";

            }

          });

        </script>';

      }

    }

  }

  /* =====================================
  EDITAR REMITENTES
  ====================================== */

  static public function ctrEditarRemitente(){

    if (isset($_POST["editarRemitente"])) {

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["editarRemitente"])){

        $tabla = "remitentes";

        $datos = array("remitente" => $_POST["editarRemitente"] ,
                       "id" => $_POST["idRemitente"]);

        $respuesta = ModeloRemitentes::mdlEditarRemitente($tabla, $datos);

        if ($respuesta == "ok") {

          echo '<script>

          swal({

            type: "success",
            title: "¡El remitente ha sido editado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "remitentes";

            }

          });


          </script>';
        }

      } else {

        echo '<script>

          swal({

            type: "error",
            title: "¡El remitente no puede ir vacía o llevar caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "remitentes";

            }

          });

        </script>';

      }

    }

  }

  /* =====================================
  BORRAR REMITENTES
  ====================================== */

  static public function ctrBorrarRemitente(){

    if (isset($_GET["idRemitente"])) {

      $tabla = "remitentes";
      $datos = $_GET["idRemitente"];

      $respuesta = ModeloRemitentes::mdlBorrarRemitente($tabla, $datos);

      if ($respuesta == "ok") {

        echo'<script>

				swal({
					  type: "success",
					  title: "El remitente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "remitentes";

								}
							})

				</script>';

      }
    }
  }

  /* =====================================
  MOSTRAR REMITENTES
  ====================================== */

  static public function ctrMostrarRemitentes($item, $valor){

    $tabla = "remitentes";

    $respuesta = ModeloRemitentes::mdlMostrarRemitentes($tabla, $item, $valor);

    return $respuesta;
  }


}
