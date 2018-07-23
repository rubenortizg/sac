<?php

require_once "../controladores/remitentes.controlador.php";
require_once "../modelos/remitentes.modelo.php";

class AjaxRemitentes{

	/*=============================================
	EDITAR REMITENTE
	=============================================*/

	public $idRemitente;

	public function ajaxEditarRemitente(){

		$item = "id";
		$valor = $this->idRemitente;

		$respuesta = ControladorRemitentes::ctrMostrarRemitentes($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR REMITENTE
	=============================================*/

	public $validarRemitente;

	public function ajaxValidarRemitente(){

		$item = "remitente";
		$valor = $this->validarRemitente;

		$respuesta = ControladorRemitentes::ctrMostrarRemitentes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR REMITENTE
=============================================*/

if(isset( $_POST["idRemitente"])){

	$Remitente = new AjaxRemitentes();
	$Remitente -> idRemitente = $_POST["idRemitente"];
	$Remitente -> ajaxEditarRemitente();

}



/*=============================================
VALIDAR NO REPETIR REMITENTE
=============================================*/

if(isset( $_POST["validarRemitente"])){

	$valRemitente = new AjaxRemitentes();
	$valRemitente -> validarRemitente = $_POST["validarRemitente"];
	$valRemitente -> ajaxValidarRemitente();

}
