<?php

require_once "conexion.php";

class ModeloTipos {

  /* =====================================
  CREAR TIPO DE ESTABLECIMIENTO
  ====================================== */

  static public function mdlIngresarTipo($tabla, $datos){

    $sql ="INSERT INTO $tabla(tipo) VALUES (:tipo)";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":tipo", $datos, PDO::PARAM_STR);

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;
  }


  /* =====================================
  EDITAR TIPO DE ESTABLECIMIENTO
  ====================================== */

  static public function modalEditarTipo($tabla, $datos){

    $sql ="UPDATE $tabla SET tipo = :tipo WHERE id = :id";
    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
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
  MOSTRAR TIPOS DE ESTABLECIMIENTO
  =============================================*/

  static public function mdlMostrarTipos($tabla, $item, $valor){

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
  BORRAR TIPOS DE ESTABLECIMIENTO
  =============================================*/

  static public function mdlBorrarTipo($tabla, $datos){

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
