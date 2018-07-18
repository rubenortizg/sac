<?php

require_once "conexion.php";

class ModeloClientes {

  /* =====================================
  INGRESAR CLIENTE
  ====================================== */

  static public function mdlIngresarCliente($tabla, $datos){

    $sql ="INSERT INTO $tabla(identificacion, tipoid, nombre, correo, telfijo, celular, ciudad, empresa, oficinalocal, idusuario) VALUES (:identificacion, :tipoid, :nombre, :correo, :telfijo, :celular, :ciudad, :empresa, :oficinalocal, :idusuario)";

    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":identificacion", $datos["identificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoid", $datos["tipoid"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telfijo", $datos["telfijo"], PDO::PARAM_STR);
    $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
    $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
    $stmt->bindParam(":oficinalocal", $datos["oficinalocal"], PDO::PARAM_STR);
    $stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }


  /*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

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

  /* =====================================
  EDITAR CLIENTE
  ====================================== */

  static public function mdlEditarCliente($tabla, $datos){

    $sql ="UPDATE $tabla SET identificacion =:identificacion, tipoid =  :tipoid, nombre = :nombre, correo = :correo, telfijo = :telfijo, celular = :celular, ciudad = :ciudad, empresa = :empresa, oficinalocal = :oficinalocal, idusuario = :idusuario WHERE id = :id";

    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":identificacion", $datos["identificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoid", $datos["tipoid"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telfijo", $datos["telfijo"], PDO::PARAM_STR);
    $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
    $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
    $stmt->bindParam(":oficinalocal", $datos["oficinalocal"], PDO::PARAM_STR);
    $stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }


  /*=============================================
  ELIMINAR CLIENTE
  =============================================*/

  static public function mdlEliminarCliente($tabla, $datos){

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
