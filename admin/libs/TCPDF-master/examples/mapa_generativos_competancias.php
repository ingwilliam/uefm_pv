<?php

require_once('tcpdf_include.php');
require '../../../libs/Config.php'; //de configuracion
require '../../../libs/SPDO.php'; //PDO con singleton
require '../../../config.php'; //Archivo con configuraciones.

$db = SPDO::singleton();

$array_plan = $db->consultRegistroSql("SELECT p.*,a.nombre AS nombre_asignatura FROM plan_estudio AS p "
        . "INNER JOIN asignatura AS a ON a.id = p.asignatura"
        . " WHERE p.activo = 1 AND p.id = " . $_GET["id"] . ";");

$sql = "SELECT 
                        up.*,c.nombre    
                    FROM
                        plan_estudio_curso AS up 
                    INNER JOIN curso AS c ON c.id =up.curso
                    WHERE
                        c.activo = 1 AND up.plan_estudio='" . $array_plan["id"] . "'";

$arrayCursos = $db->listArraySql($sql, "curso", true);

$cursos="";
$id_cursos="";
foreach($arrayCursos as $clave => $valor)
{
    $cursos = $cursos.",".$valor["nombre"];
    $id_cursos = $id_cursos.",".$valor["curso"];
}

$cursos = substr($cursos, 1); 
$id_cursos = substr($id_cursos, 1); 


$sql = "SELECT p.* FROM plan_estudio AS p 
INNER JOIN plan_estudio_curso AS pec ON pec.plan_estudio=p.id 
WHERE p.activo = 1 AND p.periodo = '1' AND p.anio='".$array_plan["anio"]."' AND p.asignatura = '".$array_plan["asignatura"]."' AND pec.curso IN ($id_cursos)
ORDER BY p.fecha_crear DESC LIMIT 1;";

$array_plan_1 = $db->consultRegistroSql($sql, "curso", true);

$arrayMetas_1 = $db->listArraySql("SELECT m.* FROM meta AS m WHERE m.plan_estudio='" . $array_plan_1["id"] . "' AND activo=1","id",true);

$arrayDesempenos_1 = $db->listArraySql("SELECT d.* FROM desempeno AS d WHERE d.plan_estudio='" . $array_plan_1["id"] . "' AND activo=1","id",true);

$arrayValoracion_1 = $db->listArraySql("SELECT v.* FROM valoracion AS v WHERE v.plan_estudio='" . $array_plan_1["id"] . "'  AND activo=1","id",true);


$metas_1="";
foreach($arrayMetas_1 as $clave => $valor)
{
    $metas_1 = $metas_1."<tr><td>".$valor["nombre"]."</td></tr>";
}

$desempenos_1="";
foreach($arrayDesempenos_1 as $clave => $valor)
{
    $desempenos_1 = $desempenos_1."<li>".$valor["nombre_desempeno"];
    $count=0;
    $valoracion_1="";
    foreach($arrayValoracion_1 as $clave2 => $valor2)
    {        
       if($valor["id"]==$valor2["desempeno"])
       {
           $count=1;
           $valoracion_1 = $valoracion_1."<li>".$valor2["nombre_valoracion"]."</li>";
       }
    }
    if($count==1)
    {
        $desempenos_1 = $desempenos_1."<ul>".$valoracion_1."</ul>";
    }
    $desempenos_1 = $desempenos_1."</li>";
}

$sql = "SELECT p.* FROM plan_estudio AS p 
INNER JOIN plan_estudio_curso AS pec ON pec.plan_estudio=p.id 
WHERE p.activo = 1 AND p.periodo = '2' AND p.anio='".$array_plan["anio"]."' AND p.asignatura = '".$array_plan["asignatura"]."' AND pec.curso IN ($id_cursos)
ORDER BY p.fecha_crear DESC LIMIT 1;";

$array_plan_2 = $db->consultRegistroSql($sql, "curso", true);

$arrayMetas_2 = $db->listArraySql("SELECT m.* FROM meta AS m WHERE m.plan_estudio='" . $array_plan_2["id"] . "' AND activo=1","id",true);

$arrayDesempenos_2 = $db->listArraySql("SELECT d.* FROM desempeno AS d WHERE d.plan_estudio='" . $array_plan_2["id"] . "' AND activo=1","id",true);

$arrayValoracion_2 = $db->listArraySql("SELECT v.* FROM valoracion AS v WHERE v.plan_estudio='" . $array_plan_2["id"] . "'  AND activo=1","id",true);


$metas_2="";
foreach($arrayMetas_2 as $clave => $valor)
{
    $metas_2 = $metas_2."<tr><td>".$valor["nombre"]."</td></tr>";
}

$desempenos_2="";
foreach($arrayDesempenos_2 as $clave => $valor)
{
    $desempenos_2 = $desempenos_2."<li>".$valor["nombre_desempeno"];
    $count=0;
    $valoracion_2="";
    foreach($arrayValoracion_2 as $clave2 => $valor2)
    {        
       if($valor["id"]==$valor2["desempeno"])
       {
           $count=1;
           $valoracion_2 = $valoracion_2."<li>".$valor2["nombre_valoracion"]."</li>";
       }
    }
    if($count==1)
    {
        $desempenos_2 = $desempenos_2."<ul>".$valoracion_2."</ul>";
    }
    $desempenos_2 = $desempenos_2."</li>";
}

$sql = "SELECT p.* FROM plan_estudio AS p 
INNER JOIN plan_estudio_curso AS pec ON pec.plan_estudio=p.id 
WHERE p.activo = 1 AND p.periodo = '3' AND p.anio='".$array_plan["anio"]."' AND p.asignatura = '".$array_plan["asignatura"]."' AND pec.curso IN ($id_cursos)
ORDER BY p.fecha_crear DESC LIMIT 1;";

$array_plan_3 = $db->consultRegistroSql($sql, "curso", true);

$arrayMetas_3 = $db->listArraySql("SELECT m.* FROM meta AS m WHERE m.plan_estudio='" . $array_plan_3["id"] . "' AND activo=1","id",true);

$arrayDesempenos_3 = $db->listArraySql("SELECT d.* FROM desempeno AS d WHERE d.plan_estudio='" . $array_plan_3["id"] . "' AND activo=1","id",true);

$arrayValoracion_3 = $db->listArraySql("SELECT v.* FROM valoracion AS v WHERE v.plan_estudio='" . $array_plan_3["id"] . "'  AND activo=1","id",true);

$metas_3="";
foreach($arrayMetas_3 as $clave => $valor)
{
    $metas_3 = $metas_3."<tr><td>".$valor["nombre"]."</td></tr>";
}

$desempenos_3="";
foreach($arrayDesempenos_3 as $clave => $valor)
{
    $desempenos_3 = $desempenos_3."<li>".$valor["nombre_desempeno"];
    $count=0;
    $valoracion_3="";
    foreach($arrayValoracion_3 as $clave2 => $valor2)
    {        
       if($valor["id"]==$valor2["desempeno"])
       {
           $count=1;
           $valoracion_3 = $valoracion_3."<li>".$valor2["nombre_valoracion"]."</li>";
       }
    }
    if($count==1)
    {
        $desempenos_3 = $desempenos_3."<ul>".$valoracion_3."</ul>";
    }
    $desempenos_3 = $desempenos_3."</li>";
}

$sql = "SELECT p.* FROM plan_estudio AS p 
INNER JOIN plan_estudio_curso AS pec ON pec.plan_estudio=p.id 
WHERE p.activo = 1 AND p.periodo = '4' AND p.anio='".$array_plan["anio"]."' AND p.asignatura = '".$array_plan["asignatura"]."' AND pec.curso IN ($id_cursos)
ORDER BY p.fecha_crear DESC LIMIT 1;";

$array_plan_4 = $db->consultRegistroSql($sql, "curso", true);

$arrayMetas_4 = $db->listArraySql("SELECT m.* FROM meta AS m WHERE m.plan_estudio='" . $array_plan_4["id"] . "' AND activo=1","id",true);

$arrayDesempenos_4 = $db->listArraySql("SELECT d.* FROM desempeno AS d WHERE d.plan_estudio='" . $array_plan_4["id"] . "' AND activo=1","id",true);

$arrayValoracion_4 = $db->listArraySql("SELECT v.* FROM valoracion AS v WHERE v.plan_estudio='" . $array_plan_4["id"] . "'  AND activo=1","id",true);


$metas_4="";
foreach($arrayMetas_4 as $clave => $valor)
{
    $metas_4 = $metas_4."<tr><td>".$valor["nombre"]."</td></tr>";
}

$desempenos_4="";
foreach($arrayDesempenos_4 as $clave => $valor)
{
    $desempenos_4 = $desempenos_4."<li>".$valor["nombre_desempeno"];
    $count=0;
    $valoracion_4="";
    foreach($arrayValoracion_4 as $clave2 => $valor2)
    {        
       if($valor["id"]==$valor2["desempeno"])
       {
           $count=1;
           $valoracion_4 = $valoracion_4."<li>".$valor2["nombre_valoracion"]."</li>";
       }
    }
    if($count==1)
    {
        $desempenos_4 = $desempenos_4."<ul>".$valoracion_4."</ul>";
    }
    $desempenos_4 = $desempenos_4."</li>";
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        // Logo
        $db = SPDO::singleton();
        $array_plan = $db->consultRegistroSql("SELECT p.* FROM plan_estudio AS p WHERE p.id = " . $_GET["id"] . ";");
        

        $qr = "Cod Plan Estudio " . $array_plan[id] . ": " . $array_plan[anio];

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
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        $this->Ln();
        $this->write2DBarcode($qr, 'QRCODE,L', 173, 6, 22, 22, $style, 'N');
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
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LEGAL", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ingeniero William Barbosa');
$pdf->SetTitle('Mapa Generativos y Competencias UEFM');
$pdf->SetSubject('Mapa Generativos y Competencias UEFM');


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
<div style="text-align:center;font-weight:bold"><br/>LÍNEA DE FORMACIÓN COGNITIVA
<br/>    
GRADO(S): $cursos ASIGNATURA: $array_plan[nombre_asignatura]
<br/><br/>TÓPICO GENERATIVO</div>
<div style="text-align:justify">$array_plan[topico_generativo]</div>
<h4 style="text-align:center">HILO CONDUCTOR</h4>                
<div style="text-align:justify">$array_plan[hilos_conductores]</div>
<br/>        
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">METAS DE COMPRESIÓN $array_plan_1[periodo] PERIODO</td>
    </tr>
    $metas_1
</table>        
<br/>        
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">METAS DE COMPRESIÓN $array_plan_2[periodo] PERIODO</td>
    </tr>
    $metas_2
</table>        
<br/>        
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">METAS DE COMPRESIÓN $array_plan_3[periodo] PERIODO</td>
    </tr>
    $metas_3
</table>        
<br/>        
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">METAS DE COMPRESIÓN $array_plan_4[periodo] PERIODO</td>
    </tr>
    $metas_4
</table>        
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;">COMPETENCIAS POR PERIODO Y DESEMPEÑOS DE COMPRENSIÓN</td>
    </tr>
</table>
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">1 PERIODO</td>
        <td style="text-align:center;" bgcolor="#cccccc">2 PERIODO</td>
        <td style="text-align:center;" bgcolor="#cccccc">3 PERIODO</td>
        <td style="text-align:center;" bgcolor="#cccccc">4 PERIODO</td>
    </tr>    
    <tr>
        <td style="text-align:justify;">
            <ul style='margin:0px;padding:0px'>
                $desempenos_1
            </ul>
        </td>
        <td style="text-align:justify;">
            <ul style='margin:0px;padding:0px'>
                $desempenos_2
            </ul>
        </td>
        <td style="text-align:justify;">
            <ul style='margin:0px;padding:0px'>
                $desempenos_3
            </ul>    
        </td>
        <td style="text-align:justify;">
            <ul style='margin:0px;padding:0px'>
                $desempenos_4
            </ul>    
        </td>
    </tr>    
</table> 
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">ESTRATEGIAS METODOLÓGICAS</td>
        <td style="text-align:justify;">$array_plan[estrategia]</td>
    </tr>
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">RECURSOS</td>
        <td style="text-align:justify;">$array_plan[recursos]</td>
    </tr>
    <tr>
        <td style="text-align:center;" bgcolor="#cccccc">BIBLIOGRAFÍA</td>
        <td style="text-align:justify;">$array_plan[bibliografia]</td>
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
