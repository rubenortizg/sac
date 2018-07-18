<?php

require_once "../controladores/empresas.controlador.php";
require_once "../modelos/empresas.modelo.php";

class AjaxEmpresas{

	/*=============================================
	EDITAR EMPRESA
	=============================================*/

	public $idEmpresa;

	public function ajaxEditarEmpresa(){

		$item = "id";
		$valor = $this->idEmpresa;

		$respuesta = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR EMPRESA
	=============================================*/

	public $activarEmpresa;
	public $activarId;


	public function ajaxActivarEmpresa(){

		$tabla = "empresas";

		$item1 = "estado";
		$valor1 = $this->activarEmpresa;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloEmpresas::mdlActualizarEmpresa($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR EMPRESA
	=============================================*/

	public $validarEmpresa;

	public function ajaxValidarEmpresa(){

		$item = "empresa";
		$valor = $this->validarEmpresa;

		$respuesta = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR EMPRESA
=============================================*/
if(isset($_POST["idEmpresa"])){

	$editar = new AjaxEmpresas();
	$editar -> idEmpresa = $_POST["idEmpresa"];
	$editar -> ajaxEditarEmpresa();

}

/*=============================================
ACTIVAR EMPRESA
=============================================*/

if(isset($_POST["activarEmpresa"])){

	$activarEmpresa = new AjaxEmpresas();
	$activarEmpresa -> activarEmpresa = $_POST["activarEmpresa"];
	$activarEmpresa -> activarId = $_POST["activarId"];
	$activarEmpresa -> ajaxActivarEmpresa();

}

/*=============================================
VALIDAR NO REPETIR EMPRESA
=============================================*/

if(isset( $_POST["validarEmpresa"])){

	$valEmpresa = new AjaxEmpresas();
	$valEmpresa -> validarEmpresa = $_POST["validarEmpresa"];
	$valEmpresa -> ajaxValidarEmpresa();

}
