<?php

class ControladorEmpresas{

	/*=============================================
	REGISTRO DE EMPRESA
	=============================================*/

	static public function ctrCrearEmpresa(){

		if(isset($_POST["nuevaEmpresa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["nuevaEmpresa"])){

			  /*=============================================
				VALIDAR IMAGEN DEL LOGO
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevoLogoEmpresa"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevoLogoEmpresa"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR EL LOGO DE LA EMPRESA
					=============================================*/

					$nuevaEmpresaDir = str_replace(array('ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','.',' '),array('n','N','a','e','i','o','u','A','E','I','O','U','_','_'),trim($_POST["nuevaEmpresa"]));

					$directorio = "vistas/img/empresas/".$nuevaEmpresaDir;

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevoLogoEmpresa"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresas/".$nuevaEmpresaDir."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevoLogoEmpresa"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevoLogoEmpresa"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresas/".$nuevaEmpresaDir."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevoLogoEmpresa"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/* =====================================
					VALIDAR EMPRESA
				========================================== */

				$tabla = "empresas";

				$datos = array("empresa" => $_POST["nuevaEmpresa"],
					           "logo"=>$ruta);

				$respuesta = ModeloEmpresas::mdlIngresarEmpresa($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La empresa ha sido guardada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "empresas";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La empresa no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "empresas";

						}

					});


				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/

	static public function ctrMostrarEmpresas($item, $valor){

		$tabla = "empresas";

		$respuesta = ModeloEmpresas::mdlMostrarEmpresas($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR EMPRESA
	=============================================*/

	static public function ctrEditarEmpresa(){

		if(isset($_POST["editarEmpresa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. ]+$/', $_POST["editarEmpresa"])){

				/*=============================================
				VALIDAR DIRECTORIO IMAGEN
				=============================================*/

				$nuevaEmpresaDir = str_replace(array('ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','.',' '),array('n','N','a','e','i','o','u','A','E','I','O','U','_','_'),trim($_POST["editarEmpresa"]));


				$actualEmpresaDir = str_replace(array('ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','.',' '),array('n','N','a','e','i','o','u','A','E','I','O','U','_','_'),trim($_POST["empresaActual"]));


				if ($nuevaEmpresaDir != $actualEmpresaDir) {
					rename("vistas/img/empresas/".$actualEmpresaDir, "vistas/img/empresas/".$nuevaEmpresaDir);
					$logoActual = substr($_POST["logoActualEmpresa"], -7);
					$ruta = "vistas/img/empresas/".$nuevaEmpresaDir."/".$logoActual;
				} else {
					$ruta = $_POST["logoActualEmpresa"];
				}


				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				if(isset($_FILES["editarLogoEmpresa"]["tmp_name"]) && !empty($_FILES["editarLogoEmpresa"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarLogoEmpresa"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR EL LOGO DE LA EMPRESA
					=============================================*/

					$directorio = substr($ruta, 0, -7);

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["logoActualEmpresa"])){

						unlink($ruta);

					}else{

						mkdir($directorio, 0755);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarLogoEmpresa"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresas/".$nuevaEmpresaDir."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarLogoEmpresa"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarLogoEmpresa"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresas/".$nuevaEmpresaDir."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarLogoEmpresa"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/* =====================================
          VALIDAR EMPRESA
        ========================================== */

				$tabla = "empresas";

				$datos = array("id" => $_POST["idEmpresa"],
								 "empresa" => $_POST["editarEmpresa"],
							   "logo" => $ruta);

				$respuesta = ModeloEmpresas::modalEditarEmpresa($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La empresa ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empresas";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La empresa no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empresas";

							}
						})

			  	</script>';

			}

		}

	}

	/* =====================================
		BORRAR EMPRESA
	========================================== */

	static public function ctrBorrarEmpresa(){

		if(isset($_GET["idEmpresa"])){

			$tabla ="empresas";
			$datos = $_GET["idEmpresa"];

			if($_GET["logoEmpresa"] != ""){

				unlink($_GET["logoEmpresa"]);

				$directorio = substr($_GET["logoEmpresa"], 0, -7);
				rmdir($directorio);

			}

			$respuesta = ModeloEmpresas::mdlBorrarEmpresa($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La empresa ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "empresas";

								}
							})

				</script>';

			}

		}

	}

}
