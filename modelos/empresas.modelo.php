<?php

require_once "conexion.php";

class ModeloEmpresas{

	/*=============================================
	MOSTRAR EMPRESAS
	=============================================*/

	static public function mdlMostrarEmpresas($tabla, $item, $valor){

		if($item != null){

			$sql ="SELECT * FROM $tabla WHERE $item = :$item";
      $stmt = Conexion::conectar()-> prepare($sql);
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$sql ="SELECT * FROM $tabla";
      $stmt = Conexion::conectar()-> prepare($sql);
			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE EMPRESA
	=============================================*/

	static public function mdlIngresarEmpresa($tabla, $datos){

		$sql ="INSERT INTO $tabla(empresa, logo) VALUES (:empresa, :logo)";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR EMPRESA
	=============================================*/

	static public function modalEditarEmpresa($tabla, $datos){

		$sql ="UPDATE $tabla SET empresa = :empresa, logo = :logo WHERE  id = :id";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt -> bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR EMPRESA
	=============================================*/

	static public function mdlActualizarEmpresa($tabla, $item1, $valor1, $item2, $valor2){

		$sql ="UPDATE $tabla SET $item1 = :$item1 WHERE  $item2 = :$item2";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	BORRAR EMPRESA
	=============================================*/

	static public function mdlBorrarEmpresa($tabla, $datos){

		$sql ="DELETE FROM $tabla WHERE id = :id";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();
		$stmt = null;

	}

}
