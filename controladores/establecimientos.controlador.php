<?php

class ControladorEstablecimientos {

  /* =====================================
  CREAR ESTABLECIMIENTO
  ====================================== */

  static public function ctrCrearEstablecimiento(){

    if (isset($_POST["nuevoTipo"])) {


      if(preg_match('/^[a-zA-Z0-9\-\_ ]+$/', $_POST["nuevoIdentificador"])){

           $tabla = "establecimientos";

           $datos = array("identificador" => $_POST["nuevoIdentificador"],
     					            "tipo" => $_POST["nuevoTipo"],
                          "idempresa" => $_POST["nuevaEmpresa"]);

            $respuesta = ModeloEstablecimientos::mdlIngresarEstablecimiento($tabla, $datos);

            if($respuesta == "ok"){

    					echo '<script>

    					swal({

    						type: "success",
    						title: "¡El establecimiento ha sido guardado correctamente!",
    						showConfirmButton: true,
    						confirmButtonText: "Cerrar",
                closeOnConfirm: false

    					}).then(function(result){

    						if(result.value){

    							window.location = "establecimientos";

    						}

    					});


    					</script>';


    				}

      } else {

        echo '<script>

         swal({

           type: "error",
           title: "¡El establecimiento no puede ir con los campos vacíos o llevar caracteres especiales!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm: false
         }).then(function(result){

           if(result.value){

             window.location = "establecimientos;

           }

         });


       </script>';

      }

    }

  }

  /*=============================================
  MOSTRAR ESTABLECIMIENTO
  =============================================*/

  static public function ctrMostrarEstablecimientos($item, $valor){

    $tabla = "establecimientos";

    $respuesta = ModeloEstablecimientos::mdlMostrarEstablecimientos($tabla, $item, $valor);

    return $respuesta;
  }


  /* =====================================
  EDITAR ESTABLECIMIENTO
  ====================================== */

  static public function ctrEditarEstablecimiento(){

    if (isset($_POST["editarIdentificador"])) {


      if(preg_match('/^[a-zA-Z0-9\-\_ ]+$/', $_POST["editarIdentificador"])){

           $tabla = "establecimientos";

           echo $_POST["editarEmpresa"];

           $datos = array("id" => $_POST["idEstablecimiento"],
                          "identificador" => $_POST["editarIdentificador"],
     					            "tipo" => $_POST["editarTipo"],
                          "idempresa" => $_POST["editarEmpresa"]);

            $respuesta = ModeloEstablecimientos::mdlEditarEstablecimiento($tabla, $datos);

            if($respuesta == "ok"){

    					echo '<script>

    					swal({

    						type: "success",
    						title: "¡El establecimiento ha sido editado correctamente!",
    						showConfirmButton: true,
    						confirmButtonText: "Cerrar",
                closeOnConfirm: false

    					}).then(function(result){

    						if(result.value){

    							window.location = "establecimientos";

    						}

    					});


    					</script>';


    				}

      } else {

        echo '<script>

         swal({

           type: "error",
           title: "¡El establecimiento no puede ir con los campos vacíos o llevar caracteres especiales!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm: false
         }).then(function(result){

           if(result.value){

             window.location = "establecimientos";

           }

         });


       </script>';

      }

    }

  }

  /* =====================================
  ELIMINAR ESTABLECIMIENTO
  ====================================== */

  static public function ctrBorrarEstablecimiento(){

    if(isset($_GET["idEstablecimiento"])){

      $tabla ="establecimientos";
      $datos = $_GET["idEstablecimiento"];

      $respuesta = ModeloEstablecimientos::mdlBorrarEstablecimiento($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El establecimiento ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "establecimientos";

                }
              })

        </script>';

      }

    }

  }


}
