<?php

require_once "../../../controladores/radicados.controlador.php";
require_once "../../../modelos/radicados.modelo.php";

require_once "../../../controladores/establecimientos.controlador.php";
require_once "../../../modelos/establecimientos.modelo.php";


class imprimirRadicadoBC{

public $radicado;

public function traerImpresionRadicadoBC(){


// INFORMACIÓN DEL RADICADO

$item = "radicado";
$valor = $this->radicado;
$valorRadicado = "R".str_pad($valor, 7, "0", STR_PAD_LEFT);

$respuestaRadicado = ControladorRadicados::ctrMostrarRadicados($item, $valor);

$destinatario = json_decode($respuestaRadicado["destinatario"], true);

$fecha = substr($respuestaRadicado["fecha"],0,-3);

// ----- Establecimiento Barcode -------

foreach ($destinatario as $key => $value) {
$itemEstablecimiento = "id";
$valorEstablecimiento = $value["idEstablecimiento"];
$respuestaEstablecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);
$barcode =  $valorRadicado.' '.$fecha;
$establecimiento = strtoupper($respuestaEstablecimiento["tipo"]).'  '.$respuestaEstablecimiento["identificador"];
$long = intval((40-strlen($establecimiento))/2);
$espacio = '';
for ($i=0; $i < $long; $i++) {
	$espacio .= ' ';
}

$establecimiento = $espacio.$establecimiento;

}

// CLASE TCPDF

require_once('tcpdf_include.php');

// ----- DEFINE LA CANTIDAD DE STICKERS A IMPRIMIR 1 o 2 -----------
$stickerIndividual = false;

// ------ TIPO DE PAPEL A USAR (/tcpdf/include/tcpdf_static.php)----
if ($stickerIndividual == true) {
	// ---------- Impresión a Un (1) sticker ---------------
	$pdf = new TCPDF('L', 'mm', 'STICKER25X50', true, 'UTF-8', false);
}else {
	// ---------- Impresión a Dos (2) sticker --------------
	$pdf = new TCPDF('L', 'mm', 'STICKER25X100', true, 'UTF-8', false);
}

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//establecer margenes
$pdf->SetMargins(0, 3, 0);
$pdf->SetAutoPageBreak(TRUE, 0);


$pdf->startPageGroup();

$pdf->SetFont('', 'B', 7.5);

$pdf->AddPage();

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
	'text' => false,
	'font' => 'helvetica',
	'fontsize' => 1,
	'stretchtext' => 3.75
);

// CODE 128 AUTO

if ($stickerIndividual == true) {

	// ---------- Impresión a Un (1) sticker --------------

	$image_file = 'images/logoMultiplaza.png';
	$pdf->Image($image_file, 10, 1, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	$pdf->Ln(5);
	$pdf->write1DBarcode($valorRadicado, 'C128', '', '', '', 13.5, 0.4, $style, 'N');
	$pdf->Text(8, 18, $barcode, 0, false);
	$pdf->Text(5, 21, $establecimiento, 0, false);

}else {

	// ---------- Impresión a dos (2) sticker --------------

	$html = '<table><tr><td>';
	$image_file = 'images/logoMultiplaza.png';
	$params = $pdf->serializeTCPDFtagParameters(array($image_file, 10, 1, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false));
	$html .= '<tcpdf method="Image" params="'.$params.'" />';
	$html .= '</td><td>';
	$params = $pdf->serializeTCPDFtagParameters(array($image_file, 60, 1, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false));
	$html .= '<tcpdf method="Image" params="'.$params.'" />';
	$html .= '</td></tr>';
	$html .= '<tr><td>';
	$params = $pdf->serializeTCPDFtagParameters(array($valorRadicado, 'C128', '', '', '', 13.5, 0.35, $style, 'T'));
	$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
	$html .= '</td><td>';
	$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
	$html .= '</td></tr>';
	$html .= '<tr><td>';
	$params = $pdf->serializeTCPDFtagParameters(array(8, 18, $barcode, 0, false));
	$html .= '<tcpdf method="Text" params="'.$params.'" />';
	$params = $pdf->serializeTCPDFtagParameters(array(5, 21, $establecimiento, 0, false));
	$html .= '<tcpdf method="Text" params="'.$params.'" />';
	$html .= '</td><td>';
	$params = $pdf->serializeTCPDFtagParameters(array(58, 18,$barcode, 0, false));
	$html .= '<tcpdf method="Text" params="'.$params.'" />';
	$params = $pdf->serializeTCPDFtagParameters(array(55, 21, $establecimiento, 0, false));
	$html .= '<tcpdf method="Text" params="'.$params.'" />';
	$html .= '</td></tr></table>';
	$pdf->writeHTML($html, true, 0, true, 0);

}

// ------------------------------------
// SALIDA DEL ARCHIVO
// ------------------------------------

// ---- Enviar a imprimir el PDF ------
<1p></1p>df->IncludeJS("print();");

// ---- Generar el nombre del PDF -----
$pdf->Output('radicado.pdf', 'I');


}

}

$radicadoBARCODE = new imprimirRadicadoBC();
$radicadoBARCODE -> radicado =$_GET["radicado"];
$radicadoBARCODE -> traerImpresionRadicadoBC();



?>
