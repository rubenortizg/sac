<?php

class ControladorTransportadoras{

	/*=============================================
	REGISTRO DE TRANSPORTADORA
	=============================================*/

	static public function ctrCrearTransportadora(){

		if(isset($_POST["nuevaTransportadora"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["nuevaTransportadora"])){

			  /*=============================================
				VALIDAR IMAGEN DEL LOGO
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevoLogo"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevoLogo"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR EL LOGO DE LA TRANSPORTADORA
					=============================================*/

					$nuevaTransportadoraDir = str_replace(array('ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','.',' '),array('n','N','a','e','i','o','u','A','E','I','O','U','_','_'),trim($_POST["nuevaTransportadora"]));

					$directorio = "vistas/img/transportadoras/".$nuevaTransportadoraDir;

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevoLogo"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/transportadoras/".$nuevaTransportadoraDir."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevoLogo"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevoLogo"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/transportadoras/".$nuevaTransportadoraDir."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevoLogo"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/* =====================================
					VALIDAR TRANSPORTADORA
				========================================== */

				$tabla = "transportadoras";

				$datos = array("transportadora" => $_POST["nuevaTransportadora"],
					           "logo"=>$ruta);

				$respuesta = ModeloTransportadoras::mdlIngresarTransportadora($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La transportadora ha sido guardada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "transportadoras";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La transportadora no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "transportadoras";

						}

					});


				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR TRANSPORTADORA
	=============================================*/

	static public function ctrMostrarTransportadoras($item, $valor){

		$tabla = "transportadoras";

		$respuesta = ModeloTransportadoras::mdlMostrarTransportadoras($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR TRANSPORTADORA
	=============================================*/

	static public function ctrEditarTransportadora(){

		if(isset($_POST["editarTransportadora"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["editarTransportadora"])){

				/*=============================================
				VALIDAR DIRECTORIO IMAGEN
				=============================================*/

				$nuevaTransportadoraDir = str_replace(array('ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','.',' '),array('n','N','a','e','i','o','u','A','E','I','O','U','_','_'),trim($_POST["editarTransportadora"]));


				$actualTransportadoraDir = str_replace(array('ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','.',' '),array('n','N','a','e','i','o','u','A','E','I','O','U','_','_'),trim($_POST["transportadoraActual"]));


				if ($nuevaTransportadoraDir != $actualTransportadoraDir) {
					rename("vistas/img/transportadoras/".$actualTransportadoraDir, "vistas/img/transportadoras/".$nuevaTransportadoraDir);
					$logoActual = substr($_POST["logoActual"], -7);
					$ruta = "vistas/img/transportadoras/".$nuevaTransportadoraDir."/".$logoActual;
				} else {
					$ruta = $_POST["logoActual"];
				}


				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				if(isset($_FILES["editarLogo"]["tmp_name"]) && !empty($_FILES["editarLogo"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarLogo"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR EL LOGO DE LA TRANSPORTADORA
					=============================================*/

					$directorio = substr($ruta, 0, -7);

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["logoActual"])){

						unlink($ruta);

					}else{

						mkdir($directorio, 0755);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarLogo"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/transportadoras/".$nuevaTransportadoraDir."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarLogo"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarLogo"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/transportadoras/".$nuevaTransportadoraDir."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarLogo"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/* =====================================
          VALIDAR TRANSPORTADORA
        ========================================== */

				$tabla = "transportadoras";

				$datos = array("id" => $_POST["idTransportadora"],
								 "transportadora" => $_POST["editarTransportadora"],
							   "logo" => $ruta);

				$respuesta = ModeloTransportadoras::modalEditarTransportadora($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La transportadora ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "transportadoras";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La transportadora no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "transportadoras";

							}
						})

			  	</script>';

			}

		}

	}

	/* =====================================
		BORRAR TRANSPORTADORA
	========================================== */

	static public function ctrBorrarTransportadora(){

		if(isset($_GET["idTransportadora"])){

			$tabla ="transportadoras";
			$datos = $_GET["idTransportadora"];

			if($_GET["logoTransportadora"] != ""){

				unlink($_GET["logoTransportadora"]);

				$directorio = substr($_GET["logoTransportadora"], 0, -7);
				rmdir($directorio);

			}

			$respuesta = ModeloTransportadoras::mdlBorrarTransportadora($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La transportadora ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "transportadoras";

								}
							})

				</script>';

			}

		}

	}

}
