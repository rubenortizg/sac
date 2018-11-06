<?php

require_once "../controladores/clientefacturas.controlador.php";
require_once "../modelos/clientefacturas.modelo.php";

class AjaxClienteFacturas{

	/*=============================================
	EDITAR CLIENTE FACTURA
	=============================================*/

	public $idClienteFactura;
	public $traerClienteFacturas;

	public function ajaxEditarClienteFactura(){

		if($this->traerClienteFacturas == "ok"){

					$item = null;
					$valor = null;

					$respuesta = ControladorClienteFacturas::ctrMostrarClienteFacturas($item, $valor);

					echo json_encode($respuesta);

		} else {

			$item = "id";
			$valor = $this->idClienteFactura;

			$respuesta = ControladorClienteFacturas::ctrMostrarClienteFacturas($item, $valor);

			echo json_encode($respuesta);

		}


	}

	/*=============================================
	ACTIVAR CLIENTE FACTURA
	=============================================*/

	public $activarClienteFactura;
	public $activarId;


	public function ajaxActivarClienteFactura(){

		$tabla = "facturas";

		$item1 = "estado";
		$valor1 = $this->activarClienteFactura;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloClienteFacturas::mdlActualizarClienteFactura($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR CLIENTE FACTURA
	=============================================*/

	public $validarClienteFactura;

	public function ajaxValidarClienteFactura(){

		$item = "ctacontrato";
		$valor = $this->validarClienteFactura;

		$respuesta = ControladorClienteFacturas::ctrMostrarClienteFacturas($item, $valor);

		echo json_encode($respuesta);

	}



}

/*=============================================
EDITAR CLIENTE FACTURA
=============================================*/

if(isset( $_POST["idClienteFactura"])){

	$editarClienteFactura = new AjaxClienteFacturas();
	$editarClienteFactura -> idClienteFactura = $_POST["idClienteFactura"];
	$editarClienteFactura -> ajaxEditarClienteFactura();

}

/*=============================================
LISTAR CLIENTE FACTURA
=============================================*/

if(isset( $_POST["traerClienteFacturas"])){

	$traerClienteFacturas = new AjaxClienteFacturas();
	$traerClienteFacturas -> traerClienteFacturas = $_POST["traerClienteFacturas"];
	$traerClienteFacturas -> ajaxEditarClienteFactura();

}

/*=============================================
ACTIVAR CLIENTE FACTURA
=============================================*/

if(isset($_POST["activarClienteFactura"])){

	$activarClienteFactura = new AjaxClienteFacturas();
	$activarClienteFactura -> activarClienteFactura = $_POST["activarClienteFactura"];
	$activarClienteFactura -> activarId = $_POST["activarId"];
	$activarClienteFactura -> ajaxActivarClienteFactura();

}

/*=============================================
VALIDAR NO REPETIR CLIENTE FACTURA
=============================================*/

if(isset( $_POST["validarClienteFactura"])){

	$valClienteFactura = new AjaxClienteFacturas();
	$valClienteFactura -> validarClienteFactura = $_POST["validarClienteFactura"];
	$valClienteFactura -> ajaxValidarClienteFactura();

}
