<?php

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

class AjaxEstablecimientos{

	/*=============================================
	EDITAR ESTABLECIMIENTO
	=============================================*/

	public $idEstablecimiento;

	public function ajaxEditarEstablecimiento(){

		$item = "id";
		$valor = $this->idEstablecimiento;

		$respuesta = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR ESTABLECIMIENTO
	=============================================*/

	public $activarEstablecimiento;
	public $activarId;


	public function ajaxActivarEstablecimiento(){

		$tabla = "establecimientos";

		$item1 = "estado";
		$valor1 = $this->activarEstablecimiento;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloEstablecimientos::mdlActualizarEstablecimiento($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR ESTABLECIMIENTO
	=============================================*/

	public $validarEstablecimiento;

	public function ajaxValidarEstablecimiento(){

		$item = "identificador";
		$valor = $this->validarEstablecimiento;

		$respuesta = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR ESTABLECIMIENTO
=============================================*/

if(isset( $_POST["idEstablecimiento"])){

	$editarEstablecimiento = new AjaxEstablecimientos();
	$editarEstablecimiento -> idEstablecimiento = $_POST["idEstablecimiento"];
	$editarEstablecimiento -> ajaxEditarEstablecimiento();

}

/*=============================================
ACTIVAR ESTABLECIMIENTO
=============================================*/

if(isset($_POST["activarEstablecimiento"])){

	$activarEstablecimiento = new AjaxEstablecimientos();
	$activarEstablecimiento -> activarEstablecimiento = $_POST["activarEstablecimiento"];
	$activarEstablecimiento -> activarId = $_POST["activarId"];
	$activarEstablecimiento -> ajaxActivarEstablecimiento();

}

/*=============================================
VALIDAR NO REPETIR ESTABLECIMIENTO
=============================================*/

if(isset( $_POST["validarEstablecimiento"])){

	$valEstablecimiento = new AjaxEstablecimientos();
	$valEstablecimiento -> validarEstablecimiento = $_POST["validarEstablecimiento"];
	$valEstablecimiento -> ajaxValidarEstablecimiento();

}
