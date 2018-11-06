<?php

require_once "conexion.php";

class ModeloClienteFacturas {

  /* =====================================
  CREAR CLIENTE FACTURA
  ====================================== */

  static public function mdlIngresarClienteFactura($tabla, $datos){

    $sql ="INSERT INTO $tabla(ctacontrato, idoperador, idempresa, idestablecimiento) VALUES (:ctacontrato, :idoperador, :idempresa, :idestablecimiento)";

    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":ctacontrato", $datos["ctacontrato"], PDO::PARAM_STR);
		$stmt->bindParam(":idoperador", $datos["idoperador"], PDO::PARAM_INT);
    $stmt->bindParam(":idempresa", $datos["idempresa"], PDO::PARAM_INT);
    $stmt->bindParam(":idestablecimiento", $datos["idestablecimiento"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }


  /*=============================================
	MOSTRAR CLIENTE FACTURAS
	=============================================*/

	static public function mdlMostrarClienteFacturas($tabla, $item, $valor){

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
  EDITAR CLIENTE FACTURA
  ====================================== */

  static public function mdlEditarClienteFactura($tabla, $datos){

    $sql ="UPDATE $tabla SET ctacontrato = :ctacontrato, idoperador =  :idoperador, idempresa = :idempresa, idestablecimiento = :idestablecimiento WHERE id = :id";

    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":ctacontrato", $datos["ctacontrato"], PDO::PARAM_STR);
		$stmt->bindParam(":idoperador", $datos["idoperador"], PDO::PARAM_INT);
    $stmt->bindParam(":idempresa", $datos["idempresa"], PDO::PARAM_INT);
    $stmt->bindParam(":idestablecimiento", $datos["idestablecimiento"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }

  /*=============================================
  ACTUALIZAR CLIENTE FACTURA
  =============================================*/

  static public function mdlActualizarClienteFactura($tabla, $item1, $valor1, $item2, $valor2){

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
  ELIMINAR CLIENTE FACTURA
  =============================================*/

  static public function mdlBorrarClienteFactura($tabla, $datos){

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
