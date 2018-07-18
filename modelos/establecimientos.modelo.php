<?php

require_once "conexion.php";

class ModeloEstablecimientos {

  /* =====================================
  CREAR ESTABLECIMIENTO
  ====================================== */

  static public function mdlIngresarEstablecimiento($tabla, $datos){

    $sql ="INSERT INTO $tabla(identificador, tipo, idempresa) VALUES (:identificador, :tipo, :idempresa)";

    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":identificador", $datos["identificador"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
    $stmt->bindParam(":idempresa", $datos["idempresa"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }


  /*=============================================
	MOSTRAR ESTABLECIMIENTOS
	=============================================*/

	static public function mdlMostrarEstablecimientos($tabla, $item, $valor){

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
  EDITAR ESTABLECIMIENTO
  ====================================== */

  static public function mdlEditarEstablecimiento($tabla, $datos){

    $sql ="UPDATE $tabla SET identificador = :identificador, tipo =  :tipo, idempresa = :idempresa WHERE id = :id";

    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":identificador", $datos["identificador"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
    $stmt->bindParam(":idempresa", $datos["idempresa"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }

  /*=============================================
  ACTUALIZAR ESTABLECIMIENTO
  =============================================*/

  static public function mdlActualizarEstablecimiento($tabla, $item1, $valor1, $item2, $valor2){

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
  ELIMINAR ESTABLECIMIENTO
  =============================================*/

  static public function mdlBorrarEstablecimiento($tabla, $datos){

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
