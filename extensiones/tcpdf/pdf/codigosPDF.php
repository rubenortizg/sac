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



// CLASE TCPDF

require_once('tcpdf_include.php');


// Extiende la clase TCPDF para crear encabezado y pie de pagina
class RADPDF extends TCPDF {

 	public $operadorEncabezado;

	//Encabezado Pagina
	public function Header() {

		$operadorEnc = $this->operadorEncabezado;

		// Logo
		$image_file = 'images/logo.png';
		$this->Image($image_file, 16, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Especificando Fuente
		$this->SetFont('helvetica', '', 13);
		// Titulo Encabezado
    $data1 = '<table>
                <tr>
                    <td style="width:20px"></td>

                    <td style="background-color:white; width:270px; text-align:center<; color:red; line-height:17px; "><br>Codigos Facturas<br>'.$operadorEnc.'</td>

                    <td style="background-color:white; width:180px">

                      <div style="font-size:8.5px; text-align:right; line-height:9px;">
                        MULTIPLAZA - GRUPO ROBLE
                        <br>Calle 19 A # 72 - 57 (Avenida Boyacá con
                        <br>Calle 13 / sentido norte - sur)
                      </div>

                    </td>

                </tr>
              </table>';
    $this->writeHTML($data1, false, false, false, false, '');



	}

	// Pie de pagina
	public function Footer() {
		// Ubicado 15 mm desde el borde inferior
		$this->SetY(-15);
		// Definiendo fuente
		$this->SetFont('helvetica', 'I', 8);
		// Numero de pagina
		$this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}


// CLASE IMPRESION CODIGOS DE BARRAS FACTURAS

class imprimirCodigos{

public $operador;

public function traerImpresionCodigos(){

// DESACTIVAMOS ERRORES POR PANTALLA Y ENVIAMOS A LOG DE ENVENTOS

ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);


// INFORMACIÓN DE LOS CODIGOS OPERADOR

$tabla = "facturas";

$itemOperador = "idoperador";
$valorOperador = $this->operador;

$respuestaFacturas = ModeloFacturas::mdlMostrarTotalCtasContrato($tabla, $itemOperador, $valorOperador);

$tabla = "operadores";

$item = "id";
$valor = $this->operador;
$respuestaOperadores = ModeloOperadores::mdlMostrarOperadores($tabla, $item, $valor);


// Creando nuevo documento PDF

$pdf = new RADPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf-> operadorEncabezado = $respuestaOperadores["nombre"];
// Definiendo informacion documento

$pdf->SetCreator('RUDDOR - SAC');
$pdf->SetAuthor('RUDDOR - Consultoría Tecnológica');
$pdf->SetTitle(' Codigos Facturas '.$respuestaOperadores["nombre"]);
$pdf->SetSubject('Codigo Facturas');
$pdf->SetKeywords('Codigos, Facturas, '.$respuestaOperadores["nombre"]);

// ---------------------------- Bloque 1 - Encabezado --------------------------

// Definiend valores por defecto encabezado
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Especificando fuente Encabezado y pie de pagina
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Especificando fuente monoespacio por defecto
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Definiendo margenes documento
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Definiendo cambio de pagina automatico
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Definiendo factor de escala imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Definiendo dependencia de lenguaje (opcional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


// ---------------------------- Fin - Bloque 1 - Encabezado --------------------------


$pdf->startPageGroup();

$pdf->AddPage();


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


// Codigo Factura

$cantidadElementos = count ($respuestaFacturas);

$pdf->SetFont('helvetica', 'B', 10);


// INFORMACION ESTABLECIMIENTO

for ($k=1; $k <= $cantidadElementos ; $k++) {

	$itemEstablecimiento ="id";
	$valorEstablecimiento = $respuestaFacturas[$k-1]["idestablecimiento"];

	$respuestaEstablecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

	$texto = $respuestaEstablecimiento["identificador"];
	$longitud = strlen($texto);

	$i = $k%10;
	if ($i == 0) {
		$i = 10;
		$pdf->SetXY((214-($longitud*2))/2,23*$i);
		$pdf->Cell(0, 0, $texto, 0, 1);
		// Codigos Facturas Codensa
		if ($valor == '1') {
			$pdf->write1DBarcode('415'.$respuestaOperadores["codoperador"].'802001'.$respuestaFacturas[$k-1]["ctacontrato"], 'C128', '', '', '', 17, 0.4, $style, 'N');
		}
		// Codigos Facturas Acueducto Bogota y Gas Natural
		if ($valor == '2' || $valor == '3') {
			$pdf->write1DBarcode('415'.$respuestaOperadores["codoperador"].'8020'.$respuestaFacturas[$k-1]["ctacontrato"], 'C128', '', '', '', 17, 0.4, $style, 'N');
		}
		$pdf->AddPage();
	} else {
		$pdf->SetXY((214-($longitud*2))/2,23*$i);
		$pdf->Cell(0, 0, $texto, 0, 1);
		// Codigos Facturas Codensa
		if ($valor == '1') {
			$pdf->write1DBarcode('415'.$respuestaOperadores["codoperador"].'802001'.$respuestaFacturas[$k-1]["ctacontrato"], 'C128', '', '', '', 17, 0.4, $style, 'N');
		}
		// Codigos Facturas Acueducto Bogota y Gas Natural
		if ($valor == '2' || $valor == '3') {
			$pdf->write1DBarcode('415'.$respuestaOperadores["codoperador"].'8020'.$respuestaFacturas[$k-1]["ctacontrato"], 'C128', '', '', '', 17, 0.4, $style, 'N');
		}
	}


}


// ---------------------------- Fin - Bloque 3 - Codigos -----------------------------------

/* Limpiamos la salida del búfer y lo desactivamos */
ob_end_clean();


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
