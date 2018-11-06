<?php


class ControladorFacturas {

  /* =====================================
  RADICAR FACTURA
  ====================================== */

  static public function ctrRadicarFactura(){

    if (isset($_POST["nuevaFactura"])) {

      /* =====================================
      VALIDAR EL TIPO DE FACTURA
      ====================================== */

      $barcode = $_POST["nuevaFactura"];

      $tabla = "operadores";
      $itemOperador = "codoperador";
      $valorOperador = substr( $_POST["nuevaFactura"],3,13);

      $operador = ModeloFacturas::mdlMostrarOperadores($tabla, $itemOperador, $valorOperador);

      /* =====================================
      VALIDAR OPERADOR ENEL - CODENSA BOGOTA
      ====================================== */

      if ($operador["codoperador"] == "7707209914253") {

        $tabla = "facturas";
        $itemFactura = "ctacontrato";
        $valorFactura = substr( $_POST["nuevaFactura"],22,8);

        $factura = ModeloFacturas::mdlMostrarCtasContrato($tabla, $itemFactura, $valorFactura);

        if ($factura != null) {

          $NoFactura = substr( $_POST["nuevaFactura"],30,10);

          $listaDestinatario = array( "idEstablecimiento" => $factura["idestablecimiento"],
                                      "idEmpresa" => $factura["idempresa"],
                                      "idCliente" => "");

          $listaDestinatario = "[".json_encode($listaDestinatario)."]";

          $listaCorrespondencia = array( "id" => "1",
                                         "cantidad" => "1",
                                         "observacion" => "Enel Codensa Cta Contrato No $valorFactura, Factura No. $NoFactura");

          $listaCorrespondencia = "[".json_encode($listaCorrespondencia)."]";

          $tabla ="radicados";

          $datos = array( "radicado"=>$_POST["radicadoReal"],
                          "fecha"=>$_POST["nuevaFecha"],
                          "idtransportadora"=>"1",
                          "idremitente"=>"1",
                          "destinatario"=>$listaDestinatario,
                          "tipo"=>"Individual",
                          "correspondencia"=>$listaCorrespondencia,
                          "idusuario" => $_SESSION["id"]);

          $respuesta = ModeloRadicados::mdlIngresarRadicado($tabla, $datos);



          if($respuesta == "ok"){

            echo '<script>

            swal({

              type: "success",
              title: "¡Factura CODENSA radicada correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false

            }).then(function(result){

              if(result.value){

                window.open("http://localhost/sac/extensiones/tcpdf/pdf/radicadoBARCODE.php?radicado='.$datos["radicado"].'", "_blank");
                window.location = "facturas";


              }

            });

            </script>';

          }


        } else {

          echo '<script>

  					swal({

  						type: "error",
  						title: "¡La cuenta contrato no existe!",
  						showConfirmButton: true,
  						confirmButtonText: "Cerrar"

  					}).then(function(result){

  						if(result.value){

  							window.location = "facturas";

  						}

  					});


  				</script>';
        }

      }

      /* =====================================
      VALIDAR OPERADOR GAS NATURAL CUNDIBOYACENSE
      ====================================== */

      if ($operador["codoperador"] == "7707208424432") {

        $tabla = "facturas";
        $itemFactura = "ctacontrato";
        $valorFactura = substr( $_POST["nuevaFactura"],21,7);

        $factura = ModeloFacturas::mdlMostrarCtasContrato($tabla, $itemFactura, $valorFactura);

        if ($factura != null) {

          $listaDestinatario = array( "idEstablecimiento" => $factura["idestablecimiento"],
                                      "idEmpresa" => $factura["idempresa"],
                                      "idCliente" => "");

          $listaDestinatario = "[".json_encode($listaDestinatario)."]";

          $listaCorrespondencia = array( "id" => "1",
                                         "cantidad" => "1",
                                         "observacion" => "Factura Gas Natural Cta Contrato. $valorFactura");

          $listaCorrespondencia = "[".json_encode($listaCorrespondencia)."]";

          $tabla ="radicados";

          $datos = array( "radicado"=>$_POST["radicadoReal"],
                          "fecha"=>$_POST["nuevaFecha"],
                          "idtransportadora"=>"3",
                          "idremitente"=>"3",
                          "destinatario"=>$listaDestinatario,
                          "tipo"=>"Individual",
                          "correspondencia"=>$listaCorrespondencia,
                          "idusuario" => $_SESSION["id"]);

          $respuesta = ModeloRadicados::mdlIngresarRadicado($tabla, $datos);



          if($respuesta == "ok"){

            echo '<script>

            swal({

              type: "success",
              title: "¡Factura GAS NATURAL radicada correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false

            }).then(function(result){

              if(result.value){

                window.open("http://localhost/sac/extensiones/tcpdf/pdf/radicadoBARCODE.php?radicado='.$datos["radicado"].'", "_blank");
                window.location = "facturas";


              }

            });

            </script>';

          }


        } else {

          echo '<script>

  					swal({

  						type: "error",
  						title: "¡La cuenta contrato no existe!",
  						showConfirmButton: true,
  						confirmButtonText: "Cerrar"

  					}).then(function(result){

  						if(result.value){

  							window.location = "facturas";

  						}

  					});


  				</script>';
        }

      }

      /* =====================================
      VALIDAR OPERADOR GAS NATURAL BOGOTA
      ====================================== */

      if ($operador["codoperador"] == "7707208029194") {

        $tabla = "facturas";
        $itemFactura = "ctacontrato";
        $valorFactura = substr( $_POST["nuevaFactura"],21,7);

        $factura = ModeloFacturas::mdlMostrarCtasContrato($tabla, $itemFactura, $valorFactura);

        if ($factura != null) {

          $fechaFactura = substr( $_POST["nuevaFactura"],28,8);

          $listaDestinatario = array( "idEstablecimiento" => $factura["idestablecimiento"],
                                      "idEmpresa" => $factura["idempresa"],
                                      "idCliente" => "");

          $listaDestinatario = "[".json_encode($listaDestinatario)."]";

          $listaCorrespondencia = array( "id" => "1",
                                         "cantidad" => "1",
                                         "observacion" => "Factura Gas Natural Cta Contrato. $valorFactura, fecha lectura $fechaFactura");

          $listaCorrespondencia = "[".json_encode($listaCorrespondencia)."]";

          $tabla ="radicados";

          $datos = array( "radicado"=>$_POST["radicadoReal"],
                          "fecha"=>$_POST["nuevaFecha"],
                          "idtransportadora"=>"3",
                          "idremitente"=>"3",
                          "destinatario"=>$listaDestinatario,
                          "tipo"=>"Individual",
                          "correspondencia"=>$listaCorrespondencia,
                          "idusuario" => $_SESSION["id"]);

          $respuesta = ModeloRadicados::mdlIngresarRadicado($tabla, $datos);



          if($respuesta == "ok"){

            echo '<script>

            swal({

              type: "success",
              title: "¡Factura GAS NATURAL radicada correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false

            }).then(function(result){

              if(result.value){

                window.open("http://localhost/sac/extensiones/tcpdf/pdf/radicadoBARCODE.php?radicado='.$datos["radicado"].'", "_blank");
                window.location = "facturas";


              }

            });

            </script>';

          }


        } else {

          echo '<script>

  					swal({

  						type: "error",
  						title: "¡La cuenta contrato no existe!",
  						showConfirmButton: true,
  						confirmButtonText: "Cerrar"

  					}).then(function(result){

  						if(result.value){

  							window.location = "facturas";

  						}

  					});


  				</script>';
        }

      }


      /* =====================================
      VALIDAR OPERADOR ACUEDUCTO EMAAF
      ====================================== */

      if ($operador["codoperador"] == "7709998005006") {

        $tabla = "facturas";
        $itemFactura = "ctacontrato";
        $valorFactura = substr( $_POST["nuevaFactura"],21,7);

        $factura = ModeloFacturas::mdlMostrarCtasContrato($tabla, $itemFactura, $valorFactura);

        if ($factura != null) {

          $listaDestinatario = array( "idEstablecimiento" => $factura["idestablecimiento"],
                                      "idEmpresa" => $factura["idempresa"],
                                      "idCliente" => "");

          $listaDestinatario = "[".json_encode($listaDestinatario)."]";

          $listaCorrespondencia = array( "id" => "1",
                                         "cantidad" => "1",
                                         "observacion" => "Factura Acueducto Funza Cta Contrato. $valorFactura");

          $listaCorrespondencia = "[".json_encode($listaCorrespondencia)."]";

          $tabla ="radicados";

          $datos = array( "radicado"=>$_POST["radicadoReal"],
                          "fecha"=>$_POST["nuevaFecha"],
                          "idtransportadora"=>"2",
                          "idremitente"=>"2",
                          "destinatario"=>$listaDestinatario,
                          "tipo"=>"Individual",
                          "correspondencia"=>$listaCorrespondencia,
                          "idusuario" => $_SESSION["id"]);

          $respuesta = ModeloRadicados::mdlIngresarRadicado($tabla, $datos);



          if($respuesta == "ok"){

            echo '<script>

            swal({

              type: "success",
              title: "¡Factura ACUEDUCTO radicada correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false

            }).then(function(result){

              if(result.value){

                window.open("http://localhost/sac/extensiones/tcpdf/pdf/radicadoBARCODE.php?radicado='.$datos["radicado"].'", "_blank");
                window.location = "facturas";


              }

            });

            </script>';

          }


        } else {

          echo '<script>

            swal({

              type: "error",
              title: "¡La cuenta contrato no existe!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"

            }).then(function(result){

              if(result.value){

                window.location = "facturas";

              }

            });


          </script>';
        }

      }

      /* =====================================
      VALIDAR OPERADOR ACUEDUCTO BOGOTA
      ====================================== */

      if ($operador["codoperador"] == "7707200485271") {

        $tabla = "facturas";
        $itemFactura = "ctacontrato";
        $valorFactura = substr( $_POST["nuevaFactura"],20,8);

        $factura = ModeloFacturas::mdlMostrarCtasContrato($tabla, $itemFactura, $valorFactura);

        if ($factura != null) {

          $listaDestinatario = array( "idEstablecimiento" => $factura["idestablecimiento"],
                                      "idEmpresa" => $factura["idempresa"],
                                      "idCliente" => "");

          $listaDestinatario = "[".json_encode($listaDestinatario)."]";

          $listaCorrespondencia = array( "id" => "1",
                                         "cantidad" => "1",
                                         "observacion" => "Factura Acueducto Bogotá Cta Contrato. $valorFactura");

          $listaCorrespondencia = "[".json_encode($listaCorrespondencia)."]";

          $tabla ="radicados";

          $datos = array( "radicado"=>$_POST["radicadoReal"],
                          "fecha"=>$_POST["nuevaFecha"],
                          "idtransportadora"=>"2",
                          "idremitente"=>"2",
                          "destinatario"=>$listaDestinatario,
                          "tipo"=>"Individual",
                          "correspondencia"=>$listaCorrespondencia,
                          "idusuario" => $_SESSION["id"]);

          $respuesta = ModeloRadicados::mdlIngresarRadicado($tabla, $datos);



          if($respuesta == "ok"){

            echo '<script>

            swal({

              type: "success",
              title: "¡Factura ACUEDUCTO radicada correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false

            }).then(function(result){

              if(result.value){

                window.open("http://localhost/sac/extensiones/tcpdf/pdf/radicadoBARCODE.php?radicado='.$datos["radicado"].'", "_blank");
                window.location = "facturas";


              }

            });

            </script>';

          }


        } else {

          echo '<script>

            swal({

              type: "error",
              title: "¡La cuenta contrato no existe!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"

            }).then(function(result){

              if(result.value){

                window.location = "facturas";

              }

            });


          </script>';
        }

      }


    }

  }

}
