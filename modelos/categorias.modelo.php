<?php

require_once "conexion.php";

class ModeloCategorias {

  /* =====================================
  CREAR CATEGORIA
  ====================================== */

  static public function mdlIngresarCategoria($tabla, $datos){

    $sql ="INSERT INTO $tabla(categoria) VALUES (:categoria)";
    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":categoria", $datos, PDO::PARAM_STR);

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;
  }


  /* =====================================
  EDITAR CATEGORIA
  ====================================== */

  static public function mdlEditarCategoria($tabla, $datos){

    $sql ="UPDATE $tabla SET categoria = :categoria WHERE id = :id";
    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
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
  MOSTRAR CATEGORIAS
  =============================================*/

  static public function mdlMostrarCategorias($tabla, $item, $valor){

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
  BORRAR CATEGORIAS
  =============================================*/

  static public function mdlBorrarCategoria($tabla, $datos){

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
