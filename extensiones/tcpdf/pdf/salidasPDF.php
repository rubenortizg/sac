<?php

require_once "../../../controladores/radicados.controlador.php";
require_once "../../../modelos/radicados.modelo.php";

require_once "../../../controladores/empresas.controlador.php";
require_once "../../../modelos/empresas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/establecimientos.controlador.php";
require_once "../../../modelos/establecimientos.modelo.php";

require_once "../../../controladores/transportadoras.controlador.php";
require_once "../../../modelos/transportadoras.modelo.php";

require_once "../../../controladores/remitentes.controlador.php";
require_once "../../../modelos/remitentes.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";




class imprimirSalidas{

public $radicado;

public function traerImpresionSalidas(){

// INFORMACIÓN DE LOS RADICADOS

$item = "radicado";
$valor = $this->radicado;
$valorRadicado = "R".str_pad($valor, 7, "0", STR_PAD_LEFT);

$respuestaRadicado = ControladorRadicados::ctrMostrarRadicados($item, $valor);

$fecha = substr($respuestaRadicado["fecha"],0,-8);
$hora = substr($respuestaRadicado["fecha"],11,10);
$destinatario = json_decode($respuestaRadicado["destinatario"], true);
$tipo = $respuestaRadicado["tipo"];
$correspondencia = json_decode($respuestaRadicado["correspondencia"], true);

// INFORMACION TRANSPORTADORA

$itemTransportadora ="id";
$valorTransportadora = $respuestaRadicado["idtransportadora"];

$respuestaTransportadora = ControladorTransportadoras::ctrMostrarTransportadoras($itemTransportadora, $valorTransportadora);

// INFORMACION REMITENTE

$itemRemitente ="id";
$valorRemitente = $respuestaRadicado["idremitente"];

$respuestaRemitente = ControladorRemitentes::ctrMostrarRemitentes($itemRemitente, $valorRemitente);


// CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------- Bloque 1 - Encabezado --------------------------

$bloque1 = <<<EOF

  <table>
    <tr>
        <td style="width:190px"><div><img src="images/logoMultiplaza.png"></div></td>

        <td style="background-color:white; width:330px; text-align:center<; color:red; line-height:13px; "><br><br>ENTREGA DE<br>CORRESPONDENCIA </td>

        <td style="background-color:white; width:220px">

          <div style="font-size:8.5px; text-align:right; line-height:9px;">
            MULTIPLAZA - GRUPO ROBLE
            <br>
            Calle 19 A # 72 - 57 (Avenida Boyacá con Calle 13 / sentido norte - sur)
          </div>

        </td>



    </tr>
  </table>


EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------- Fin - Bloque 1 - Encabezado --------------------------


// ---------------------------- Bloque 2 - Remitente  --------------------------------

$bloque2 = <<<EOF

  <table>
    <tr>
      <td style="width:540px"><img src="/images/back.jpg"></td>
    </tr>
  </table>

  <table style="font-size:8px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:62px; text-align:center">
        <b>Radicado</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:88px; text-align:center">
        <b>Transportadora</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:95px; text-align:center">
        Remitente
      </td>

      <td style="border: 1px solid #666; background-color:white; width:50px; text-align:center">
        Fecha
      </td>

      <td style="border: 1px solid #666; background-color:white; width:85px; text-align:center">
        Establecimiento
      </td>

      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
        Empresa
      </td>

      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">
        Cliente
      </td>

      <td style="border: 1px solid #666; background-color:white; width:45px; text-align:center">
        Tipo
      </td>

      <td style="border: 1px solid #666; background-color:white; width:57px; text-align:center;">
        Cantidad
      </td>

      <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">
        Firma
      </td>


    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------- Fin - Bloque 2 - Remitente -----------------------------------


// ---------------------------- Bloque 3 - Remitente  --------------------------------

$bloque3 = <<<EOF

  <table style="font-size:8px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:62px; text-align:center">
        $valorRadicado
      </td>

      <td style="border: 1px solid #666; background-color:white; width:88px; text-align:center">
        $respuestaTransportadora[transportadora]
      </td>

      <td style="border: 1px solid #666; background-color:white; width:95px; text-align:center">
        Remitente
      </td>

      <td style="border: 1px solid #666; background-color:white; width:50px; text-align:center">
        Fecha
      </td>

      <td style="border: 1px solid #666; background-color:white; width:85px; text-align:center">
        Establecimiento
      </td>

      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
        Empresa
      </td>

      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">
        Cliente
      </td>

      <td style="border: 1px solid #666; background-color:white; width:45px; text-align:center">
        Tipo
      </td>

      <td style="border: 1px solid #666; background-color:white; width:57px; text-align:center;">
        Cantidad
      </td>

      <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">
        Firma
      </td>


    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------- Fin - Bloque 3 - Remitente -----------------------------------



// ------------------------------------
// SALIDA DEL ARCHIVO
// ------------------------------------

$pdf->Output('radicado'.$valorRadicado.'pdf');

}

}

$salidasPDF = new imprimirSalidas();
$salidasPDF -> radicado =$_GET["radicado"];
$salidasPDF -> traerImpresionSalidas();

?>
