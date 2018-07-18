<?php

require_once "../controladores/transportadoras.controlador.php";
require_once "../modelos/transportadoras.modelo.php";

class AjaxTransportadoras{

	/*=============================================
	EDITAR TRANSPORTADORA
	=============================================*/

	public $idTtansportadora;

	public function ajaxEditarTransportadora(){

		$item = "id";
		$valor = $this->idTransportadora;

		$respuesta = ControladorTransportadoras::ctrMostrarTransportadoras($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR TRANSPORTADORA
	=============================================*/

	public $activarTransportadora;
	public $activarId;


	public function ajaxActivarTransportadora(){

		$tabla = "transportadoras";

		$item1 = "estado";
		$valor1 = $this->activarTransportadora;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloTransportadoras::mdlActualizarTransportadora($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR TRANSPORTADORA
	=============================================*/

	public $validarTransportadora;

	public function ajaxValidarTransportadora(){

		$item = "transportadora";
		$valor = $this->validarTransportadora;

		$respuesta = ControladorTransportadoras::ctrMostrarTransportadoras($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR TRANSPORTADORA
=============================================*/
if(isset($_POST["idTransportadora"])){

	$editar = new AjaxTransportadoras();
	$editar -> idTransportadora = $_POST["idTransportadora"];
	$editar -> ajaxEditarTransportadora();

}

/*=============================================
ACTIVAR TRANSPORTADORA
=============================================*/

if(isset($_POST["activarTransportadora"])){

	$activarTransporadora = new AjaxTransportadoras();
	$activarTransporadora -> activarTransportadora = $_POST["activarTransportadora"];
	$activarTransporadora -> activarId = $_POST["activarId"];
	$activarTransporadora -> ajaxActivarTransportadora();

}

/*=============================================
VALIDAR NO REPETIR TRANSPORTADORA
=============================================*/

if(isset( $_POST["validarTransportadora"])){

	$valTransportadora = new AjaxTransportadoras();
	$valTransportadora -> validarTransportadora = $_POST["validarTransportadora"];
	$valTransportadora -> ajaxValidarTransportadora();

}
