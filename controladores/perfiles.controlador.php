<?php

class ControladorPerfiles{


  /*=============================================
	MOSTRAR PERFILES
	=============================================*/

	static public function ctrMostrarPerfiles($item, $valor){

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR MODULOS EXISTENTES
	=============================================*/

	static public function ctrMostrarColumnas(){

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarColumnas($tabla);

		return $respuesta;
	}


  /*=============================================
	CREAR PERFIL
	=============================================*/

	static public function ctrCrearPerfil(){

		if (isset($_POST["nuevoPerfil"])) {

      $tabla ="perfiles";

			$perfiles = ControladorPerfiles::ctrMostrarColumnas();

			$datos = array("perfil"=>$_POST["nuevoPerfil"]);

			for ($i=2; $i < count($perfiles); $i++) {

				$perfil[$i] = 0;

				if (isset($_POST[$perfiles[$i]['Field'].'leer'])) {
					$perfil[$i] += $_POST[$perfiles[$i]['Field'].'leer'];
				}

				if (isset($_POST[$perfiles[$i]['Field'].'crear'])) {
					$perfil[$i] += $_POST[$perfiles[$i]['Field'].'crear'];
				}

				if (isset($_POST[$perfiles[$i]['Field'].'borrar'])) {
					$perfil[$i] += $_POST[$perfiles[$i]['Field'].'borrar'];
				}

				$datos[$perfiles[$i]['Field']] = $perfil[$i];

			}

      $respuesta = ModeloPerfiles::mdlCrearPerfil($tabla, $datos);

      if($respuesta == "ok"){

        echo '<script>

        swal({

          type: "success",
          title: "¡Perfil creado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false

        }).then(function(result){

          if(result.value){

            window.location = "perfiles";


          }

        });

        </script>';

      }


    }

	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil(){

		if (isset($_POST["editarPerfil"])) {

			$tabla ="perfiles";

			$perfiles = ControladorPerfiles::ctrMostrarColumnas();

			$datos = array("id"=>$_POST["idPerfil"],
										 "perfil"=>$_POST["editarPerfil"]);

			for ($i=2; $i < count($perfiles); $i++) {

				$perfil[$i] = 0;

				if (isset($_POST['editar'.$perfiles[$i]['Field'].'leer'])) {
					$perfil[$i] += $_POST['editar'.$perfiles[$i]['Field'].'leer'];
				}

				if (isset($_POST['editar'.$perfiles[$i]['Field'].'crear'])) {
					$perfil[$i] += $_POST['editar'.$perfiles[$i]['Field'].'crear'];
				}

				if (isset($_POST['editar'.$perfiles[$i]['Field'].'borrar'])) {
					$perfil[$i] += $_POST['editar'.$perfiles[$i]['Field'].'borrar'];
				}

				$datos[$perfiles[$i]['Field']] = $perfil[$i];

			}

			$respuesta = ModeloPerfiles::mdlEditarPerfil($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

				swal({

					type: "success",
					title: "¡Perfil editado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then(function(result){

					if(result.value){

						window.location = "perfiles";


					}

				});

				</script>';

			}


		}

	}


	/* =====================================
  ELIMINAR PERFIL
  ====================================== */

  static public function ctrEliminarPerfil(){

    if(isset($_GET["idPerfil"])){

      $tabla ="perfiles";
      $datos = $_GET["idPerfil"];

      $respuesta = ModeloPerfiles::mdlEliminarPerfil($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El perfil ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "perfiles";

                }
              })

        </script>';

      }

    }

  }


}
