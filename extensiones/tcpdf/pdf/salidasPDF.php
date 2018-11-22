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
                    <td style="width:80px"></td>

                    <td style="background-color:white; width:380px; text-align:center<; color:red; line-height:20px; "><br>ENTREGA DE<br>CORRESPONDENCIA</td>

                    <td style="background-color:white; width:240px">

                      <div style="font-size:8.5px; text-align:right; line-height:10px;">
                        SAC - SISTEMA DE CORRESPONDENCIA
                        <br>
                        Calle 2 # 24-02
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




class imprimirSalidas{

public $radicado;

public function traerImpresionSalidas(){


// INFORMACIÓN DE LOS RADICADOS

$tabla = "radicados";

if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

  $respuestaRadicados = ModeloRadicados::mdlRangoFechasRadicados($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

} else {

  $item = "estado";
  $valor = 0;

  $respuestaRadicados = ModeloRadicados::mdlMostrarRadicadosXEstado($tabla, $item, $valor);
}

// Creando nuevo documento PDF

$pdf = new RADPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Definiendo informacion documento

$pdf->SetCreator('RUDDOR - SAC');
$pdf->SetAuthor('RUDDOR - Consultoría Tecnológica');
$pdf->SetTitle('Salidas Correspondencia');
$pdf->SetSubject('Salidas');
$pdf->SetKeywords('Salidas');

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

$pdf->startPageGroup();

$pdf->AddPage();


// ---------------------------- Fin - Bloque 1 - Encabezado --------------------------


// ---------------------------- Bloque 2 - Remitente  --------------------------------

$bloque2 = <<<EOF

  <table>
    <tr>
      <td style="width:740px"><img src="/images/back.jpg"></td>
    </tr>
  </table>

  <table style="font-size:8px; padding:5px 10px;">

    <tr>

      <td style="width:5px"></td>

      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">
        <b>Radicado</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:105px; text-align:center">
        <b>Remitente</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:50px; text-align:center">
        <b>Fecha</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">
        <b>Establecimiento</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">
        <b>Empresa</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
        <b>Cliente</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">
        <b>Tipo</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center;">
        <b>Cantidad</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">
        <b>Observación</b>
      </td>

      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">
        <b>Firma</b>
      </td>


    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------- Fin - Bloque 2 - Remitente -----------------------------------


foreach ($respuestaRadicados as $key => $respuestaRadicado) {

$valorRadicado = "R".str_pad($respuestaRadicado["radicado"], 7, "0", STR_PAD_LEFT);

$fecha = substr($respuestaRadicado["fecha"],0,-8);
$hora = substr($respuestaRadicado["fecha"],11,10);
$destinatario = json_decode($respuestaRadicado["destinatario"], true);
$correspondencia = json_decode($respuestaRadicado["correspondencia"], true);

// INFORMACION TRANSPORTADORA

$itemTransportadora ="id";
$valorTransportadora = $respuestaRadicado["idtransportadora"];

$respuestaTransportadora = ControladorTransportadoras::ctrMostrarTransportadoras($itemTransportadora, $valorTransportadora);

// INFORMACION ESTABLECIMIENTO

foreach ($destinatario as $key => $value) {

$itemEstablecimiento ="id";
$valorEstablecimiento = $value["idEstablecimiento"];

$respuestaEstablecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

}
// INFORMACION EMPRESA


foreach ($destinatario as $key => $value) {

$itemEmpresa ="id";
$valorEmpresa = $value["idEmpresa"];

$respuestaEmpresa = ControladorEmpresas::ctrMostrarEmpresas($itemEmpresa, $valorEmpresa);

}

// INFORMACION CLIENTE

foreach ($destinatario as $key => $value) {

$itemCliente ="id";
$valorCliente = $value["idCliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

}

// INFORMACION REMITENTE

$itemRemitente ="id";
$valorRemitente = $respuestaRadicado["idremitente"];

$respuestaRemitente = ControladorRemitentes::ctrMostrarRemitentes($itemRemitente, $valorRemitente);

// INFORMACION TIPO DE CATEGORIA

$tipo = "";

foreach ($correspondencia as $key => $value) {

$itemCategoria ="id";
$valorCategoria = $value["id"];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemCategoria, $valorCategoria);

$tipo .= $respuestaCategoria["categoria"]."<br>";

}

// INFORMACION CANTIDAD

$cantidad = "";

foreach ($correspondencia as $key => $value) {

  $cantidad .= $value["cantidad"]."<br>";

}

// INFORMACION OBSERVACIONES

$observacion = "";

foreach ($correspondencia as $key => $value) {

  $observacion .= $value["observacion"]."<br>";

}


// ---------------------------- Bloque 3 - Remitente  --------------------------------

$bloque3 = <<<EOF

  <table style="font-size:8px; padding:5px 0px;">

    <tr>

      <td style="width:5px"></td>

      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">$valorRadicado</td>

      <td style="border: 1px solid #666; background-color:white; width:105px; text-align:center">$respuestaRemitente[remitente]</td>

      <td style="border: 1px solid #666; background-color:white; width:50px; text-align:center">$respuestaRadicado[fecha]</td>

      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">$respuestaEstablecimiento[identificador]</td>

      <td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">$respuestaEmpresa[empresa]</td>

      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$respuestaCliente[nombre]</td>

      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">$tipo</td>

      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center;">$cantidad</td>

      <td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">$observacion</td>

      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center"></td>


    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------- Fin - Bloque 3 - Remitente -----------------------------------

}

// ------------------------------------
// SALIDA DEL ARCHIVO
// ------------------------------------

$pdf->Output('salidas.pdf');

}

}

$salidasPDF = new imprimirSalidas();
$salidasPDF -> traerImpresionSalidas();

?>
