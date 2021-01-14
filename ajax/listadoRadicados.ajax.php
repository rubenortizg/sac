<?php

session_start();

require_once "../controladores/radicados.controlador.php";
require_once "../controladores/transportadoras.controlador.php";
require_once "../controladores/remitentes.controlador.php";
require_once "../controladores/empresas.controlador.php";
require_once "../controladores/clientes.controlador.php";
require_once "../controladores/establecimientos.controlador.php";

require_once "../modelos/radicados.modelo.php";
require_once "../modelos/transportadoras.modelo.php";
require_once "../modelos/remitentes.modelo.php";
require_once "../modelos/empresas.modelo.php";
require_once "../modelos/clientes.modelo.php";
require_once "../modelos/establecimientos.modelo.php";

class listaRadicados{

    public function mostrarTablaRadicados(){

        if (isset($_GET["fechaInicial"])) {

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

        }else {

            $fechaInicial = null;
            $fechaFinal = null;
        }

        $radicados = ControladorRadicados::ctrRangoFechasRadicados($fechaInicial, $fechaFinal);
        $transportadoras = ControladorTransportadoras::ctrMostrarTransportadoras(null,null);
        $remitentes = ControladorRemitentes::ctrMostrarRemitentes(null, null);
        $empresas = ControladorEmpresas::ctrMostrarEmpresas(null, null);
        $clientes = ControladorClientes::ctrMostrarClientes(null, null);
        $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos(null, null);


        if (count($radicados) == 0) {

            $datosJson = '{ "data":[]}';

        } else {

            $datosJson = '{"data":[
                ';


            foreach ($radicados as $key => $value) {

                $radicado = $value["radicado"];
                $radicado = str_pad($radicado, 7, "0", STR_PAD_LEFT);

                foreach ($transportadoras as $objeto) {
                    if ($objeto["id"] == $value["idtransportadora"]) {
                        $transportadora = $objeto["transportadora"];     
                    }
                }

                foreach ($remitentes as $objeto) {
                    if ($objeto["id"] == $value["idremitente"]) {
                        $remitente = $objeto["remitente"];     
                    }
                }
                
                if($value["estado"] == 0){
                    $estado = "<button class='btn btn-warning btn-xs'>Radicado</button>";
                }elseif ($value["estado"] == 1) {
                    $estado = "<button class='btn btn-success btn-xs'>Entregado</button>";
                }

                $divBotones = "<div class='btn-group'>";
                
                $divBotones .= "<button class='btn btn-success btn-sm btnPdfRadicado' codigoRadicado='".$value["radicado"]."'><i class='fa fa-file-pdf-o'></i></button><button class='btn btn-primary btn-sm btnImprimirRadicado' codigoRadicado='".$value["radicado"]."'><i class='fa fa-print'></i></button>";
                    
                    
                if ($_SESSION["acceso"]["radicados"] >= "6" && $_SESSION["acceso"]["opciones"] >= "6"  ) {
                    $divBotones .= "<button class='btn btn-warning btn-sm btnEditarRadicado' idRadicado='".$value["id"]."'><i class='fa fa-pencil'></i></button>";
                }

                if ($_SESSION["acceso"]["radicados"] >= "7") {
                    $divBotones .= "<button class='btn btn-danger btn-sm btnEliminarRadicado' idRadicado='".$value["id"]."'><i class='fa fa-times'></i></button>";
                }
                
                $divBotones .= "</div>";

                $listaDestinatario = json_decode($value["destinatario"], true);

                foreach ($listaDestinatario as $objeto) {

                    foreach ($empresas as $objetoEmp) {
                        if ($objetoEmp["id"] == $objeto["idEmpresa"]) {
                            $empresa = $objetoEmp["empresa"];     
                        }
                    }

                    foreach ($clientes as $objetoCli) {
                        if ($objetoCli["id"] == $objeto["idCliente"]) {
                            $cliente = $objetoCli["nombre"];     
                        }
                    }

                    if($objeto["idCliente"] != null){
                        $destinatario = $empresa.' - '.$cliente;
                    } else {
                        $destinatario = $empresa;
                    }

                    foreach ($establecimientos as $objetoEst) {
                        if ($objetoEst["id"] == $objeto["idEstablecimiento"]) {
                            $establecimiento = $objetoEst["identificador"];     
                        }
                    }
                          
                }

                $datosJson .= '[
                    "'.($key+1).'",
                    "R'.$radicado.'",
                    "'.$transportadora.'",
                    "'.$remitente.'",
                    "'.$destinatario.'",
                    "'.$establecimiento.'",
                    "'.$estado.'",
                    "'.$value["tipo"].'",
                    "'.$value["fecha"].'",
                    "'.$divBotones.'"
                ],';

            }

            $datosJson = substr($datosJson, 0, -1);

            $datosJson .= ']}';
    

        }

        echo $datosJson;

  }   //cierre metodo
} // cierre clase


$activarTablaRadicados = new listaRadicados();
$activarTablaRadicados -> mostrarTablaRadicados();

