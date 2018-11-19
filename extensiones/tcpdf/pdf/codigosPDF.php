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

require_once "../../../controladores/facturas.controlador.php";
require_once "../../../modelos/facturas.modelo.php";

require_once "../../../controladores/operadores.controlador.php";
require_once "../../../modelos/operadores.modelo.php";


class imprimirCodigos{

public $operador;

public function traerImpresionCodigos(){


// INFORMACIÓN DE LOS CODIGOS OPERADOR

$tabla = "facturas";

$itemOperador = "idoperador";
$valorOperador = $this->operador;

$respuestaFacturas = ModeloFacturas::mdlMostrarTotalCtasContrato($tabla, $itemOperador, $valorOperador);

$tabla = "operadores";

$item = "id";
$valor = $this->operador;
$respuestaOperadores = ModeloOperadores::mdlMostrarOperadores($tabla, $item, $valor);

// CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------- Bloque 1 - Encabezado --------------------------

$bloque1 = <<<EOF

  <table>
    <tr>
        <td style="width:10px"></td>
        <td style="width:170px"><div><img src="images/logoMultiplaza.png"></div></td>

        <td style="background-color:white; width:200px; text-align:center<; color:red; line-height:13px; "><br><br>Codigos Facturas<br>$respuestaOperadores[nombre]</td>

        <td style="background-color:white; width:170px">

          <div style="font-size:8.5px; text-align:right; line-height:9px;">
            SAC - SISTEMA DE CORRESPONDENCIA
            <br>
            Calle 2 # 24-02
          </div>

        </td>



    </tr>
  </table>


EOF;


$pdf->writeHTML($bloque1, false, false, false, false, '');


// ---------------------------- Fin - Bloque 1 - Encabezado --------------------------


// ---------------------------- Bloque 2 - Espaciado  --------------------------------

$bloque2 = <<<EOF

  <table>
    <tr>
      <td style="width:740px"><img src="/images/back.jpg"></td>
    </tr>
  </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------- Fin - Bloque 2 - Espaciado --------------------------


// ---------------------------- Bloque 3 - Codigos  ---------------------------------

// define barcode style
$style = array(
	'position' => 'C',
	'align' => 'C',
	'stretch' => true,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => false,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 3.75
);

$html = '<table style="font-size:8px; padding:5px 10px;">';

foreach ($respuestaFacturas as $respuestaFactura) {

// INFORMACION ESTABLECIMIENTO

$itemEstablecimiento ="id";
$valorEstablecimiento = $respuestaFactura["idestablecimiento"];

$respuestaEstablecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

// PDF CODIGOS

$html .= '<tr>
          <td style="width:12px"></td>
          <td style="border: 1px solid #666; background-color:white; width:269px; text-align:center"><b>'.$respuestaEstablecimiento["identificador"].'</b></td>
          <td style="border: 1px solid #666; background-color:white; width:269px; text-align:center"><b>'.$respuestaEstablecimiento["identificador"].'</b></td>
         </tr>';
$html .= '<tr><td style="width:12px"></td><td style="border: 1px solid #666; background-color:white; width:269px; text-align:center">';
$params = $pdf->serializeTCPDFtagParameters(array('415'.$respuestaOperadores["codoperador"].'8020'.$respuestaFactura["ctacontrato"], 'C128', '', '', '', 13.5, 0.35, $style, 'T'));
$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
$html .= '</td><td style="border: 1px solid #666; background-color:white; width:269px; height:45px; text-align:center">';
$params = $pdf->serializeTCPDFtagParameters(array('415'.$respuestaOperadores["codoperador"].'8020'.$respuestaFactura["ctacontrato"], 'C128', '', '', '', 13.5, 0.35, $style, 'T'));
$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
$html .= '</td></tr>';


}

$html .= '</table>';
$pdf->writeHTML($html, true, 0, true, 0);

// ---------------------------- Fin - Bloque 3 - Codigos -----------------------------------


// ------------------------------------
// SALIDA DEL ARCHIVO
// ------------------------------------

$pdf->Output('codigos.pdf');

}

}

$codigosPDF = new imprimirCodigos();
$codigosPDF -> operador = $_GET["operador"];
$codigosPDF -> traerImpresionCodigos();

?>
