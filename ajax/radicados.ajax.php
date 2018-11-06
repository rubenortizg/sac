<?php

require_once "../controladores/radicados.controlador.php";
require_once "../modelos/radicados.modelo.php";

class AjaxRadicados{

	/*=============================================
	ACTIVAR ESTABLECIMIENTO
	=============================================*/

	public $activarRadicado;
	public $activarId;


	public function ajaxActivarRadicado(){

		$tabla = "radicados";

		$item1 = "estado";
		$valor1 = $this->activarRadicado;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloRadicados::mdlActualizarRadicado($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
ACTIVAR ESTABLECIMIENTO
=============================================*/

if(isset($_POST["activarRadicado"])){

	$activarRadicado = new AjaxRadicados();
	$activarRadicado -> activarRadicado = $_POST["activarRadicado"];
	$activarRadicado -> activarId = $_POST["activarId"];
	$activarRadicado -> ajaxActivarRadicado();

}
