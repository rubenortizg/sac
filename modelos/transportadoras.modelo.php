<?php

require_once "conexion.php";

class ModeloTransportadoras{

	/*=============================================
	MOSTRAR TRANSPORTADORAS
	=============================================*/

	static public function mdlMostrarTransportadoras($tabla, $item, $valor){

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
	REGISTRO DE TRANSPORTADORA
	=============================================*/

	static public function mdlIngresarTransportadora($tabla, $datos){

		$sql ="INSERT INTO $tabla(transportadora, logo) VALUES (:transportadora, :logo)";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":transportadora", $datos["transportadora"], PDO::PARAM_STR);
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
	EDITAR TRANSPORTADORA
	=============================================*/

	static public function modalEditarTransportadora($tabla, $datos){

		$sql ="UPDATE $tabla SET transportadora = :transportadora, logo = :logo WHERE  id = :id";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt -> bindParam(":transportadora", $datos["transportadora"], PDO::PARAM_STR);
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
	ACTUALIZAR TRANSPORTADORA
	=============================================*/

	static public function mdlActualizarTransportadora($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR TRANSPORTADORA
	=============================================*/

	static public function mdlBorrarTransportadora($tabla, $datos){

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
