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

}
