<?php

require_once "conexion.php";

class ModeloRadicados {

  /* =====================================
  INGRESAR RADICADO
  ====================================== */

  static public function mdlIngresarRadicado($tabla, $datos){

    $sql ="INSERT INTO $tabla(radicado, fecha, idtransportadora, idremitente, destinatario, tipo, correspondencia, idusuario) VALUES (:radicado, :fecha, :idtransportadora, :idremitente, :destinatario, :tipo, :correspondencia, :idusuario)";

    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":radicado", $datos["radicado"], PDO::PARAM_INT);
    $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":idtransportadora", $datos["idtransportadora"], PDO::PARAM_INT);
		$stmt->bindParam(":idremitente", $datos["idremitente"], PDO::PARAM_INT);
		$stmt->bindParam(":destinatario", $datos["destinatario"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
    $stmt->bindParam(":correspondencia", $datos["correspondencia"], PDO::PARAM_STR);
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
	MOSTRAR <RADICADOS
	=============================================*/

	static public function mdlMostrarRadicados($tabla, $item, $valor){

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
  EDITAR RADICADO
  ====================================== */

  static public function mdlEditarRadicado($tabla, $datos){

    $sql ="UPDATE $tabla SET identificacion =:identificacion, tipoid =  :tipoid, nombre = :nombre, correo = :correo, telfijo = :telfijo, celular = :celular, ciudad = :ciudad, idempresa = :idempresa, idestablecimiento = :idestablecimiento, idusuario = :idusuario WHERE id = :id";

    $stmt = Conexion::conectar()-> prepare($sql);

    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":identificacion", $datos["identificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoid", $datos["tipoid"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telfijo", $datos["telfijo"], PDO::PARAM_STR);
    $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
    $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt->bindParam(":idempresa", $datos["idempresa"], PDO::PARAM_STR);
    $stmt->bindParam(":idestablecimiento", $datos["idestablecimiento"], PDO::PARAM_STR);
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
  ELIMINAR RADICADO
  =============================================*/

  static public function mdlEliminarRadicado($tabla, $datos){

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
