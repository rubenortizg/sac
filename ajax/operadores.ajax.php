<?php

require_once "../controladores/operadores.controlador.php";
require_once "../modelos/operadores.modelo.php";

class AjaxOperadores{

	/*=============================================
	EDITAR OPERADOR
	=============================================*/

	public $idOperador;

	public function ajaxEditarOperador(){

		$item = "id";
		$valor = $this->idOperador;

		$respuesta = ControladorOperadores::ctrMostrarOperadores($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR OPERADOR
=============================================*/
if(isset($_POST["idOperador"])){

	$editar = new AjaxOperadores();
	$editar -> idOperador = $_POST["idOperador"];
	$editar -> ajaxEditarOperador();

}
