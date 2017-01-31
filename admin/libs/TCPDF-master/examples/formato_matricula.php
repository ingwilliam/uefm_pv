<?php

require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES . 'logo.jpg';
        $this->Image($image_file, 15, 5, 22, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        
        // Title
        $this->Cell(0, 0, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 0, 'UNIDAD EDUCATIVA  EL FUTURO DEL MAÑANA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 6);
        $this->Cell(0, 0, 'RESOLUCIÓN OFICIAL 08-0051 EXPEDIDA EL 15DE FEBRERO DE 2012 Y', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 0, 'RESOLUCIÓN OFICIAL:No 08-0227 DEL 5 DE AGOSTO DEL 2.009 DE EDUCACIÓN FORMAL DE ADULTOS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 0, '“EN BÚSQUEDA HACIA LA FORMACIÓN DE PERSONAS AUTÓNOMAS Y RESPONSABLES EN UN AMBIENTE DE CONVIVENCIA”', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 0, 'NIT: 830050759 -6 DANE: 311001047880', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 0, 'INSCRITO ANTE SECRETARIA DE EDUCACIÓN N° 0053', 0, false, 'C', 0, '', 0, false, 'M', 'M');                
        // set style for barcode
        $style = array(
                'border' => 2,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
        );
        $this->Ln();
        $this->write2DBarcode('WILLIAM BARBOSA', 'QRCODE,L', 173, 6, 22, 22, $style, 'N');
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ingeniero William Barbosa');
$pdf->SetTitle('Formato Matricula UEFM');
$pdf->SetSubject('Formato Matricula UEFM');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 7));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 10);


// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
        table {
		font-size: 10pt;	
	}
        
	td {
		border: 1px solid #E3E3E3;	
                background-color: #ffffee;
	}
</style>
<h3>Información Alumno</h3>        
<table>
 <tr>
  <td width="135"><b>Nombres y Apellidos</b></td>
  <td width="400" colspan="5"></td>
  <td width="100" rowspan="8"></td>
 </tr>
 <tr>
  <td width="108"><b>Tipo Documento</b></td>
  <td width="40"></td>
  <td width="127"><b>Numero Documento</b></td>
  <td width="260"></td>
 </tr>        
 <tr>
  <td width="135"><b>Fecha de Nacimiento</b></td>
  <td width="73"></td>
  <td width="40"><b>Edad</b></td>
  <td width="30"></td>
  <td width="177"><b>Lugar de Nacimiento</b></td>
  <td ></td>
 </tr>                                 
 <tr>
  <td width="70"><b>Direccion</b></td>
  <td width="465" colspan="5"></td>
 </tr>                
 <tr>
  <td width="45"><b>Barrio</b></td>
  <td width="207" ></td>
  <td width="53"><b>Estrato</b></td>
  <td width="30"></td>      
  <td width="50"><b>Celular</b></td>
  <td width="150" ></td>  
 </tr> 
 <tr>
  <td width="60"><b>Telefono</b></td>
  <td width="90" ></td>
  <td width="53"><b>Genero</b></td>
  <td width="73"></td>
  <td width="30"><b>RH</b></td>
  <td width="40"></td>  
  <td width="50"><b>Sisben</b></td>
  <td width="139" ></td>
 </tr>    
 <tr>
  <td width="33"><b>EPS</b></td>
  <td width="145" ></td>
  <td width="33"><b>IPS</b></td>
  <td width="145" ></td>
  <td width="34"><b>ARS</b></td>
  <td width="145" ></td>
 </tr>                
 <tr>
  <td width="180"><b>Grado en el que se matricula</b></td>
  <td width="355"></td>  
 </tr>                
</table>
        
<h3>Historia Académica</h3>        
<table>
 <tr>
  <td align="center"><b>Año</b></td>
  <td align="center"><b>Grado-Institución-Naturaleza(Privado,Distrital)</b></td>  
 </tr>
 <tr>
  <td></td>
  <td></td>  
 </tr>
 <tr>
  <td></td>
  <td></td>  
 </tr>
 <tr>
  <td></td>
  <td></td>  
 </tr>
 <tr>
  <td></td>
  <td></td>  
 </tr>
 <tr>
  <td></td>
  <td></td>  
 </tr>
 </table>    
<h3>Información Familiar</h3>        
<table>
 <tr>
  <td rowspan="3"><b>Padre</b></td>
  <td><b>Nombre</b></td>  
  <td></td>  
  <td><b>Identificación</b></td>  
  <td></td>
 </tr>
 <tr>
  <td><b>Dirección</b></td>  
  <td></td>  
  <td><b>Telefono</b></td>  
  <td></td>  
 </tr>
 <tr>       
  <td><b>Ocupación</b></td>  
  <td></td>  
  <td><b>Telefono</b></td>  
  <td></td>  
 </tr>
 </table>
<br/><br/>     
<table>
 <tr>
  <td width="160"><b>Observaciones matricula</b></td>
  <td width="478"></td>  
 </tr>
 <tr>
  <td colspan="2" align="center">Aceptamos el Proyecto Educativo Institucional (PEI) y cumplir con el manual de convivencia y demás planes, programas, normas y disposiciones de la Institución Educativa</td>  
 </tr>
 </table>    
<br/><br/>
<table>
 <tr>
  <td align="center"><br/><br/><br/><br/><br/><br/><b>FIRMA DEL ALUMNO</b></td>
  <td align="center"><br/><br/><br/><br/><br/><br/><b>FIRMA DEL PADRE O ACUDIENTE</b></td>  
 </tr>
 <tr>
  <td align="center"><br><br><br><br><br><br><b>FIRMA DEL RECTOR (A)</b></td>
  <td align="center"><br/><br/><br/><br/><br/><br/><b>FIRMA SECRETARIA</b></td>  
 </tr>
 </table>        
        
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
        
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('formato_pago_matricula.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
