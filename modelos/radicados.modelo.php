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
	MOSTRAR RADICADOS
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


  /*=============================================
  MOSTRAR RADICADOS ORDEN DESCEDENTE
  =============================================*/

  static public function mdlMostrarRadicadosDescendente($tabla, $item, $valor){

    if($item != null){

      $sql ="SELECT * FROM $tabla WHERE $item = :$item";
      $stmt = Conexion::conectar()-> prepare($sql);
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt -> execute();

      return $stmt -> fetch();

    }else{

      $sql ="SELECT * FROM $tabla ORDER BY id DESC";
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

    $sql = "UPDATE $tabla SET fecha = :fecha, idtransportadora = :idtransportadora, idremitente = :idremitente, destinatario = :destinatario, tipo = :tipo, correspondencia = :correspondencia, idusuario = :idusuario WHERE radicado = :radicado";

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


  /*=============================================
	RANGO FECHAS
	=============================================*/

	static public function mdlRangoFechasRadicados($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

      $sql ="SELECT * FROM $tabla";
      $stmt = Conexion::conectar()-> prepare($sql);
			$stmt -> execute();

			return $stmt -> fetchAll();

		}else if ($fechaInicial == $fechaFinal){

			$sql ="SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'";

      $stmt = Conexion::conectar()-> prepare($sql);

      $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		} else {

      $fechaActual = new DateTime();
      $fechaActualMasUno = $fechaActual->format("Y-m-d");

      $fechaFinal2 = new DateTime($fechaFinal);
      $fechaFinal2 -> add(new DateInterval("P1D"));
      $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

      if ($fechaFinalMasUno == $fechaActualMasUno) {

        $sql ="SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";

      } else {

        $sql ="SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";

      }


      $stmt = Conexion::conectar()-> prepare($sql);

			$stmt -> execute();

			return $stmt -> fetchAll();
    }


		$stmt -> close();
		$stmt = null;

	}

}
