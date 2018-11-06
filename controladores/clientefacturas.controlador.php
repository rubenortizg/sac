<?php

class ControladorClienteFacturas {

  /* =====================================
  CREAR CLIENTE FACTURA
  ====================================== */

  static public function ctrCrearClienteFactura(){

    if (isset($_POST["nuevoOperador"])) {


      if(preg_match('/^[a-zA-Z0-9\-\_ ]+$/', $_POST["nuevaCtaContrato"])){

           $tabla = "facturas";

           $datos = array("ctacontrato" => $_POST["nuevaCtaContrato"],
     					            "idoperador" => $_POST["nuevoOperador"],
                          "idestablecimiento" => $_POST["nuevoEstablecimiento"],
                          "idempresa" => $_POST["nuevaEmpresa"]);

            $respuesta = ModeloClienteFacturas::mdlIngresarClienteFactura($tabla, $datos);

            if($respuesta == "ok"){

    					echo '<script>

    					swal({

    						type: "success",
    						title: "¡La Factura de Cliente ha sido guardada correctamente!",
    						showConfirmButton: true,
    						confirmButtonText: "Cerrar",
                closeOnConfirm: false

    					}).then(function(result){

    						if(result.value){

    							window.location = "clientes-facturas";

    						}

    					});


    					</script>';


    				}

      } else {

        echo '<script>

         swal({

           type: "error",
           title: "¡La Factura de Cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm: false
         }).then(function(result){

           if(result.value){

             window.location = "clientes-facturas;

           }

         });


       </script>';

      }

    }

  }

  /*=============================================
  MOSTRAR CLIENTE FACTURA
  =============================================*/

  static public function ctrMostrarClienteFacturas($item, $valor){

    $tabla = "facturas";

    $respuesta = ModeloClienteFacturas::mdlMostrarClienteFacturas($tabla, $item, $valor);

    return $respuesta;
  }


  /* =====================================
  EDITAR CLIENTE FACTURA
  ====================================== */

  static public function ctrEditarClienteFactura(){

    if (isset($_POST["editarOperador"])) {


      if(preg_match('/^[a-zA-Z0-9\-\_ ]+$/', $_POST["editarCtaContrato"])){

           $tabla = "facturas";

           $datos = array("id" => $_POST["idClienteFactura"],
                          "ctacontrato" => $_POST["editarCtaContrato"],
                          "idoperador" => $_POST["editarOperador"],
     					            "idestablecimiento" => $_POST["editarEstablecimiento"],
                          "idempresa" => $_POST["editarEmpresa"]);

            $respuesta = ModeloClienteFacturas::mdlEditarClienteFactura($tabla, $datos);

            if($respuesta == "ok"){

    					echo '<script>

    					swal({

    						type: "success",
    						title: "¡La Factura de Cliente ha sido editada correctamente!",
    						showConfirmButton: true,
    						confirmButtonText: "Cerrar",
                closeOnConfirm: false

    					}).then(function(result){

    						if(result.value){

    							window.location = "clientes-facturas";

    						}

    					});


    					</script>';


    				}

      } else {

        echo '<script>

         swal({

           type: "error",
           title: "¡La Factura de Cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm: false
         }).then(function(result){

           if(result.value){

             window.location = "clientes-facturas";

           }

         });


       </script>';

      }

    }

  }

  /* =====================================
  ELIMINAR CLIENTE FACTURA
  ====================================== */

  static public function ctrBorrarClienteFactura(){

    if(isset($_GET["idClienteFactura"])){

      $tabla ="facturas";
      $datos = $_GET["idClienteFactura"];

      $respuesta = ModeloClienteFacturas::mdlBorrarClienteFactura($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "La Factura de Cliente ha sido borrada correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "clientes-facturas";

                }
              })

        </script>';

      }

    }

  }


}
