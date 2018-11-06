<?php

class ControladorOperadores {

  /* =====================================
  CREAR OPERADOR
  ====================================== */

  static public function ctrCrearOperador(){

  }

  /*=============================================
  MOSTRAR OPERADORES
  =============================================*/

  static public function ctrMostrarOperadores($item, $valor){

    $tabla = "operadores";

    $respuesta = ModeloOperadores::mdlMostrarOperadores($tabla, $item, $valor);

    return $respuesta;
  }


  /* =====================================
  EDITAR OPERADORES
  ====================================== */

  static public function ctrEditarOperador(){

  }

  /* =====================================
  ELIMINAR OPERADOR
  ====================================== */

  static public function ctrBorrarOperador(){

  }


}
