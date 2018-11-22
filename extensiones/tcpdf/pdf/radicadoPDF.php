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

	public $radicadoEncabezado;

	//Encabezado Pagina
	public function Header() {

		$valor = $this->radicadoEncabezado;
		$valorRadicado = "R".str_pad($valor, 7, "0", STR_PAD_LEFT);

		// Logo
		$image_file = 'images/logo.png';
		$this->Image($image_file, 16, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Especificando Fuente
		$this->SetFont('helvetica', 'B', 7);
		// Titulo Encabezado

    // Estilo barcode
    $style = array(
    	'position' => 'R',
    	'align' => 'C',
    	'stretch' => false,
    	'fitwidth' => true,
    	'cellfitalign' => '',
    	'border' => false,
    	'hpadding' => 'auto',
    	'vpadding' => 'auto',
    	'fgcolor' => array(0,0,0),
    	'bgcolor' => false, //array(255,255,255),
    	'text' => false,
    	'font' => 'helvetica',
    	'fontsize' => 8,
    	'stretchtext' => 4
    );

    // CODE 128 AUTO
    $data1 = '<table>
                <tr>
                    <td style="background-color:white; width:180px">
                      <div style="font-size:8.5px; text-align:right; line-height:9px;">
                        <br>
                        SAC - SISTEMA DE CORRESPONDENCIA
                        <br>
                        Calle 2 # 24-02
                      </div>
                    </td>
                    <td style="background-color:white; width:15px;"></td>
                    <td style="background-color:white; font-size:13px; width:100px; text-align:center; color:red; line-height:15px; "><br><br>RADICADO No. <br>'.$valorRadicado.'</td>
                </tr>
              </table>';
    $this->writeHTML($data1, false, false, false, false, '');
    $this->write1DBarcode($valorRadicado, 'C128', '', 10, '', 15, 0.4, $style, 'N');



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



class imprimirRadicado{

public $radicado;

public function traerImpresionRadicado(){

// INFORMACIÓN DEL RADICADO

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


// Creando nuevo documento PDF

$pdf = new RADPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf-> radicadoEncabezado = $_GET["radicado"];

// Definiendo informacion documento

$pdf->SetCreator('RUDDOR - SAC');
$pdf->SetAuthor('RUDDOR - Consultoría Tecnológica');
$pdf->SetTitle('Radicado: '.$valorRadicado);
$pdf->SetSubject('Comprobante Radicado');
$pdf->SetKeywords('Radicado, '.$valorRadicado);

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

// ---------------------------- Bloque 2 - Remitente  --------------------------------

$bloque2 = <<<EOF

  <table>
    <tr>
      <td style="width:645px"><img src="/images/back.jpg"></td>
    </tr>
  </table>

  <table style="font-size:10px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:485px;">
        Transportadora: $respuestaTransportadora[transportadora]
      </td>

      <td style="border: 1px solid #666; background-color:white; width:160px; text-align:right;">
        Fecha Radicado: $fecha
      </td>

    </tr>

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:485px;">
        Remitente: $respuestaRemitente[remitente]
      </td>

      <td style="border: 1px solid #666; background-color:white; width:160px; text-align:right;">
        Hora Radicado: $hora
      </td>
    </tr>

    <tr>

      <td style="border-bottom: 1px solid #666; background-color:white; width:645px;"></td>

    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------- Fin - Bloque 2 - Remitente -----------------------------------

// ---------------------------- Bloque 3 - Encabezado Destinatario  --------------------------

$bloque3 = <<<EOF

  <table style="font-size:10px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:145px; text-align:center">Establecimiento</td>
      <td style="border: 1px solid #666; background-color:white; width:250px; text-align:center">Empresa</td>
      <td style="border: 1px solid #666; background-color:white; width:250px; text-align:center">Cliente</td>

    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------- Fin - Bloque 3 - Encabezado Destinatario ------------------------

// ---------------------------- Bloque 4 - Destinatario  ----------------------------------------

foreach ($destinatario as $key => $value) {

// INFORMACION DESTINATARIO

// ---- Establecimiento

$itemEstablecimiento = "id";
$valorEstablecimiento = $value["idEstablecimiento"];

$respuestaEstablecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

// ---- Empresa

$itemEmpresa = "id";
$valorEmpresa = $value["idEmpresa"];

$respuestaEmpresa = ControladorEmpresas::ctrMostrarEmpresas($itemEmpresa, $valorEmpresa);

// ---- Cliente

$itemCliente = "id";
$valorCliente = $value["idCliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

$bloque4 = <<<EOF

  <table style="font-size:10px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:145px; text-align:center">$respuestaEstablecimiento[tipo] - $respuestaEstablecimiento[identificador]</td>
      <td style="border: 1px solid #666; background-color:white; width:250px; text-align:center">$respuestaEmpresa[empresa]</td>
      <td style="border: 1px solid #666; background-color:white; width:250px; text-align:center">$respuestaCliente[nombre]</td>

    </tr>

    <tr>

      <td style="border-bottom: 1px solid #666; background-color:white; width:645px;"></td>

    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------- Fin - Bloque 4 - Destinatario -----------------------------------

// ---------------------------- Bloque 5 - Encabezado Correspondencia  --------------------------

$bloque5 = <<<EOF


  <table style="font-size:10px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:185px; text-align:center">Tipo</td>
      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Cantidad</td>
      <td style="border: 1px solid #666; background-color:white; width:370px; text-align:center">Observaciones</td>

    </tr>
  </table>
EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------- Fin - Bloque 5 - Encabezado Correspondencia -----------------------

// ---------------------------- Bloque 6 - Correspondencia  ---------------------------------------

foreach ($correspondencia as $key => $value) {

// INFORMACION CORRESPONDENCIA

// ---- Categoria

$itemCategoria = "id";
$valorCategoria = $value["id"];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemCategoria, $valorCategoria);

$bloque6 = <<<EOF

  <table style="font-size:10px; padding:5px 10px;">

    <tr>

      <td style="border: 1px solid #666; background-color:white; width:185px; text-align:center">$respuestaCategoria[categoria]</td>
      <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">$value[cantidad]</td>
      <td style="border: 1px solid #666; background-color:white; width:370px; text-align:center">$value[observacion]</td>

    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

}

// ---------------------------- Fin - Bloque 6 - Correspondencia ------------------------


// ---------------------------- Bloque 7 - Usuarios  ------------------------------------

// INFORMACION USUARIO

$itemUsuario = "id";
$valorUsuario = $respuestaRadicado["idusuario"];

$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

$bloque7 = <<<EOF

  <table style="font-size:10px; padding:5px 10px;">

    <tr>
      <td style="background-color:white; width:540px;"></td>
    </tr>

    <tr>
      <td style="background-color:white; width:540px;"></td>
    </tr>

    <tr>

      <td style="border-bottom: 1px solid #666; background-color:white; width:290px; text-align:center"></td>
      <td style="background-color:white; width:65px; text-align:center"></td>
      <td style="border-bottom: 1px solid #666; background-color:white; width:290px; text-align:center"></td>

    </tr>

    <tr>

      <td style="background-color:white; width:290px; text-align:center">SAC - $respuestaUsuario[nombre]</td>
      <td style="background-color:white; width:65px; text-align:center"></td>
      <td style="background-color:white; width:290px; text-align:center">$respuestaEmpresa[empresa] - $respuestaCliente[nombre]</td>

    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');


// ---------------------------- Fin - Bloque 7 - Usuarios ------------------------


// ------------------------------------
// SALIDA DEL ARCHIVO
// ------------------------------------

$pdf->Output('radicado'.$valorRadicado.'pdf');

}

}

$radicadoPDF = new imprimirRadicado();
$radicadoPDF -> radicado = $_GET["radicado"];
$radicadoPDF -> traerImpresionRadicado();

?>
