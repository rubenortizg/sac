<?php

require_once "conexion.php";

class ModeloPerfiles{

	/*=============================================
	MOSTRAR PERFILES
	=============================================*/

	static public function mdlMostrarPerfiles($tabla, $item, $valor){

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
	MOSTRAR COLUMNAS
	=============================================*/

	static public function mdlMostrarColumnas($tabla){

		$sql ="SHOW columns FROM $tabla";
    $stmt = Conexion::conectar()-> prepare($sql);
		$stmt -> execute();

		return $stmt ->fetchAll();

		$stmt -> close();
		$stmt = null;


	}

	/* =====================================
	CREAR PERFIL
	====================================== */

	static public function mdlCrearPerfil($tabla, $datos){

		$sql ="INSERT INTO $tabla(perfil, inicio, usuarios, transportadoras, empresas, clientes, establecimientos, remitentes, categorias, radicados, reportes, opciones) VALUES (:perfil, :inicio, :usuarios, :transportadoras, :empresas, :clientes, :establecimientos, :remitentes, :categorias, :radicados, :reportes, :opciones)";

		$stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_INT);
		$stmt->bindParam(":usuarios", $datos["usuarios"], PDO::PARAM_INT);
		$stmt->bindParam(":transportadoras", $datos["transportadoras"], PDO::PARAM_INT);
		$stmt->bindParam(":empresas", $datos["empresas"], PDO::PARAM_INT);
		$stmt->bindParam(":clientes", $datos["clientes"], PDO::PARAM_INT);
		$stmt->bindParam(":establecimientos", $datos["establecimientos"], PDO::PARAM_INT);
		$stmt->bindParam(":remitentes", $datos["remitentes"], PDO::PARAM_INT);
		$stmt->bindParam(":categorias", $datos["categorias"], PDO::PARAM_INT);
		$stmt->bindParam(":radicados", $datos["radicados"], PDO::PARAM_INT);
		$stmt->bindParam(":reportes", $datos["reportes"], PDO::PARAM_INT);
		$stmt->bindParam(":opciones", $datos["opciones"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/* =====================================
  EDITAR PERFIL
  ====================================== */

  static public function mdlEditarPerfil($tabla, $datos){

    $sql = "UPDATE $tabla SET perfil = :perfil, inicio = :inicio, usuarios = :usuarios, transportadoras = :transportadoras, empresas = :empresas, clientes = :clientes, establecimientos = :establecimientos, remitentes = :remitentes, categorias = :categorias, radicados = :radicados, reportes = :reportes, opciones = :opciones WHERE id = :id";

    $stmt = Conexion::conectar()-> prepare($sql);

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
    $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_INT);
		$stmt->bindParam(":usuarios", $datos["usuarios"], PDO::PARAM_INT);
		$stmt->bindParam(":transportadoras", $datos["transportadoras"], PDO::PARAM_INT);
    $stmt->bindParam(":empresas", $datos["empresas"], PDO::PARAM_INT);
    $stmt->bindParam(":clientes", $datos["clientes"], PDO::PARAM_INT);
    $stmt->bindParam(":establecimientos", $datos["establecimientos"], PDO::PARAM_INT);
		$stmt->bindParam(":remitentes", $datos["remitentes"], PDO::PARAM_INT);
		$stmt->bindParam(":categorias", $datos["categorias"], PDO::PARAM_INT);
		$stmt->bindParam(":radicados", $datos["radicados"], PDO::PARAM_INT);
		$stmt->bindParam(":reportes", $datos["reportes"], PDO::PARAM_INT);
		$stmt->bindParam(":opciones", $datos["opciones"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }

	/*=============================================
  ELIMINAR PERFIL
  =============================================*/

  static public function mdlEliminarPerfil($tabla, $datos){

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
