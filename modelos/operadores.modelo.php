<?php

require_once "conexion.php";

class ModeloOperadores {

  /* =====================================
  CREAR OPERADOR
  ====================================== */

  static public function mdlIngresarOperador($tabla, $datos){

  }


  /*=============================================
	MOSTRAR OPERADORES
	=============================================*/

	static public function mdlMostrarOperadores($tabla, $item, $valor){

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
  EDITAR OPERADOR
  ====================================== */

  static public function mdlEditarOperador($tabla, $datos){

  }

  /*=============================================
  ACTUALIZAR OPERADOR
  =============================================*/

  static public function mdlActualizarOperador($tabla, $item1, $valor1, $item2, $valor2){

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
  ELIMINAR OPERADOR
  =============================================*/

  static public function mdlBorrarOperador($tabla, $datos){

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
