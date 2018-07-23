<?php

require_once "conexion.php";

class ModeloRemitentes {

  /* =====================================
  CREAR REMITENTE
  ====================================== */

  static public function mdlIngresarRemitente($tabla, $datos){

    $sql ="INSERT INTO $tabla(remitente) VALUES (:remitente)";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":remitente", $datos, PDO::PARAM_STR);

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;
  }


  /* =====================================
  EDITAR REMITENTE
  ====================================== */

  static public function mdlEditarRemitente($tabla, $datos){

    $sql ="UPDATE $tabla SET remitente = :remitente WHERE id = :id";
    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":remitente", $datos["remitente"], PDO::PARAM_STR);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;
  }

  /*=============================================
  MOSTRAR REMITENTES
  =============================================*/

  static public function mdlMostrarRemitentes($tabla, $item, $valor){

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
  BORRAR REMITENTE
  =============================================*/

  static public function mdlBorrarRemitente($tabla, $datos){

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
