<?php

require_once "../controladores/tipos.controlador.php";
require_once "../modelos/tipos.modelo.php";

class AjaxTipos{

	/*=============================================
	EDITAR TIPO DE ESTABLECIMIENTO
	=============================================*/

	public $idTipo;

	public function ajaxEditarTipo(){

		$item = "id";
		$valor = $this->idTipo;

		$respuesta = ControladorTipos::ctrMostrarTipos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR TIPO DE ESTABLECIMIENTO
	=============================================*/

	public $validarTipo;

	public function ajaxValidarTipo(){

		$item = "tipo";
		$valor = $this->validarTipo;

		$respuesta = ControladorTipos::ctrMostrarTipos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR TIPO DE ESTABLECIMIENTO
=============================================*/

if(isset( $_POST["idTipo"])){

	$Tipo = new AjaxTipos();
	$Tipo -> idTipo = $_POST["idTipo"];
	$Tipo -> ajaxEditarTipo();

}



/*=============================================
VALIDAR NO REPETIR TIPOS DE ESTABLECIMIENTO
=============================================*/

if(isset( $_POST["validarTipo"])){

	$valTipo = new AjaxTipos();
	$valTipo -> validarTipo = $_POST["validarTipo"];
	$valTipo -> ajaxValidarTipo();

}
