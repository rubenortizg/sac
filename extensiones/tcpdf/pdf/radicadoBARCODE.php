<?php

class imprimirRadicadoBC{

public $radicado;

public function traerImpresionRadicadoBC(){


// INFORMACIÓN DEL RADICADO

$item = "radicado";
$valor = $this->radicado;
$valorRadicado = "R".str_pad($valor, 7, "0", STR_PAD_LEFT);

// CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF('L', 'mm', 'STICKER25X50', true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//establecer margenes
$pdf->SetMargins(0, 3, 0);
$pdf->SetAutoPageBreak(TRUE, 0);


$pdf->startPageGroup();

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
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);

// CODE 128 AUTO
$pdf->write1DBarcode($valorRadicado, 'C128', '', '', '', 20, 0.4, $style, 'N');

// ------------------------------------
// SALIDA DEL ARCHIVO
// ------------------------------------

$pdf->IncludeJS("print();");
$pdf->Output('radicado.pdf', 'I');


}

}

$radicadoBARCODE = new imprimirRadicadoBC();
$radicadoBARCODE -> radicado =$_GET["radicado"];
$radicadoBARCODE -> traerImpresionRadicadoBC();



?>
