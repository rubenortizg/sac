<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	public $idCliente;
	public $idEstablecimiento;

	public function ajaxEditarCliente(){

		if($this->idEstablecimiento){

			$item = "idestablecimiento";
			$valor = $this->idEstablecimiento;

			$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

			echo json_encode($respuesta);

		} else {

			$item = "id";
			$valor = $this->idCliente;

			$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

			echo json_encode($respuesta);

		}

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/

if(isset( $_POST["idCliente"])){

	$editarCliente = new AjaxClientes();
	$editarCliente -> idCliente = $_POST["idCliente"];
	$editarCliente -> ajaxEditarCliente();

}

/*=============================================
LISTAR CLIENTES
=============================================*/

if(isset( $_POST["idEstablecimiento"])){

	$traerClientes = new AjaxClientes();
	$traerClientes -> idEstablecimiento = $_POST["idEstablecimiento"];
	$traerClientes -> ajaxEditarCliente();

}
