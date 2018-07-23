<?php

class ControladorTipos {

  /* =====================================
  CREAR TIPOS DE ESTABLECIMIENTO
  ====================================== */

  static public function ctrCrearTipo(){

    if (isset($_POST["nuevoTipo"])) {

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTipo"])){

        $tabla = "tipos";

        $datos = $_POST["nuevoTipo"];

        $respuesta = ModeloTipos::mdlIngresarTipo($tabla, $datos);

        if ($respuesta == "ok") {

          echo '<script>

					swal({

						type: "success",
						title: "¡El Tipo de Establecimiento ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "tipos";

						}

					});


					</script>';
        }

      } else {

        echo '<script>

					swal({

						type: "error",
						title: "¡El tipo de establecimiento no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "tipos";

						}

					});

				</script>';

      }

    }

  }

  /* =====================================
  EDITAR TIPOS DE ESTABLECIMIENTO
  ====================================== */

  static public function ctrEditarTipo(){

    if (isset($_POST["editarTipo"])) {

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTipo"])){

        $tabla = "tipos";

        $datos = array("tipo" => $_POST["editarTipo"] ,
                       "id" => $_POST["idTipo"]);

        $respuesta = ModeloTipos::modalEditarTipo($tabla, $datos);

        if ($respuesta == "ok") {

          echo '<script>

          swal({

            type: "success",
            title: "¡El Tipo de Establecimiento ha sido editado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "tipos";

            }

          });


          </script>';
        }

      } else {

        echo '<script>

          swal({

            type: "error",
            title: "¡El tipo de establecimiento no puede ir vacío o llevar caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "tipos";

            }

          });

        </script>';

      }

    }

  }

  /* =====================================
  BORRAR TIPOS DE ESTABLECIMIENTO
  ====================================== */

  static public function ctrBorrarTipo(){

    if (isset($_GET["idTipo"])) {

      $tabla = "tipos";
      $datos = $_GET["idTipo"];

      $respuesta = ModeloTipos::mdlBorrarTipo($tabla, $datos);

      if ($respuesta == "ok") {

        echo'<script>

				swal({
					  type: "success",
					  title: "El tipo de establecimiento ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "tipos";

								}
							})

				</script>';

      }
    }
  }

  /* =====================================
  MOSTRAR TIPOS DE ESTABLECIMIENTO
  ====================================== */

  static public function ctrMostrarTipos($item, $valor){

    $tabla = "tipos";

    $respuesta = ModeloTipos::mdlMostrarTipos($tabla, $item, $valor);

    return $respuesta;
  }


}
