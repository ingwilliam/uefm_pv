<?php
/*
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
 */
require 'admin/libs/Config.php'; //de configuracion
require 'admin/config.php'; //de configuracion
require 'admin/libs/SPDO.php'; //PDO con singleton
require 'admin/libs/Xhtml.php'; //Formularios del sistema

$formXhtml = new Xhtml();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Matriculas <?php echo date("Y"); ?> UEFM</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="resources/jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="resources/jquery-ui-1.12.1.custom/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="resources/jquery-ui-1.12.1.custom/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <script src="resources/jquery-ui-1.12.1.custom/external/jquery/jquery.js" type="text/javascript"></script>
        <script src="resources/jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script>
        <script>
            $(function () {
                $("#accordion").accordion();
                $("#dialog-confirm").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        "Buscar": function () {
                            $(this).dialog("close");
                        }
                    }
                });
            });
        </script>
        <style>
            select{
                width: 250px;
            }
        </style>
    </head>
    <body>
        <div style="width: 1100px; margin: 0px auto">
            <center>
                <img src="resources/images/logo.png" alt="UEFM"/>
            </center>
            <div id="accordion">
                <h3>Matriculas <?php echo date("Y"); ?> UEFM</h3>
                <div>
                    <table>
                        <tr>
                            <td>Grado</td>
                            <td>Tipo de documento</td>                            
                            <td>Numero de documento</td>                            
                            <td>Ciudad de expedicion del documento</td>                            
                        </tr>
                        <tr>
                            <td><?php $formXhtml->select("curso", "curso", $vars["arrayRegistro"]["curso"], "validar form-control", "Grado", "", "curso", "id", "nombre", "", "1", " nombre ASC"); ?></td>
                            <td><?php $formXhtml->select("tipo_documento", "tipo_documento", $vars["arrayRegistro"]["tipo_documento"], "validar form-control", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control", "Numero de documento"); ?></td>
                            <td><?php $formXhtml->selectExtra("ciudad_expedicion", "ciudad_expedicion", $vars["arrayRegistro"]["ciudad_expedicion"], "validar form-control", "Ciudad de expedicion Documento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", "departamento"); ?></td>
                        </tr>
                        <tr>
                            <td>Primer nombre</td>
                            <td>Segundo nombre</td>                            
                            <td>Primer apellido</td>                            
                            <td>Segundo apellido</td>                            
                        </tr>
                        <tr>
                            <td><?php $formXhtml->inputtext("text", "primer_nombre", "primer_nombre", $vars["arrayRegistro"]["primer_nombre"], "validar form-control", "Primer nombre"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "segundo_nombre", "segundo_nombre", $vars["arrayRegistro"]["segundo_nombre"], "form-control", "Segundo nombre"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "primer_apellido", "primer_apellido", $vars["arrayRegistro"]["primer_apellido"], "validar form-control", "Primer apellido"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "segundo_apellido", "segundo_apellido", $vars["arrayRegistro"]["segundo_apellido"], "form-control", "Segundo apellido"); ?></td>
                        </tr>                        
                        <tr>
                            <td>Genero</td>
                            <td>Ciudad de nacimiento</td>                            
                            <td>Fecha de nacimiento</td>                            
                            <td>Tipo de discapacidad</td>                            
                        </tr>
                        <tr>
                            <td><?php $formXhtml->radio("genero", "genero", $vars["arrayRegistro"]["genero"], "validar", "Genero", "", array("M" => "M", "F" => "F")); ?></td>
                            <td><?php $formXhtml->select("ciudad_nacimiento", "ciudad_nacimiento", $vars["arrayRegistro"]["ciudad_nacimiento"], "validar form-control", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", $tableextra = "departamento"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "fecha_nacimiento", "fecha_nacimiento", $vars["arrayRegistro"]["fecha_nacimiento"], "validar form-control calendario", "Fecha de nacimiento", "", "", "", "", "", "", true); ?></td>
                            <td><?php $formXhtml->select("tipo_discapacidad", "tipo_discapacidad", $vars["arrayRegistro"]["tipo_discapacidad"], "form-control", "Tipo de discapacidad", "", "tipo_discapacidad", "id", "nombre", "", "1", " nombre ASC"); ?></td>
                        </tr>

                        <tr>
                            <td>RH</td>
                            <td>EPS</td>                            
                            <td>IPS</td>                            
                            <td>ARS</td>                            
                        </tr>
                        <tr>
                            <td><?php $formXhtml->inputtext("text", "rh", "rh", $vars["arrayRegistro"]["rh"], "validar form-control", "RH"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "eps", "eps", $vars["arrayRegistro"]["eps"], "validar form-control", "EPS"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "ips", "ips", $vars["arrayRegistro"]["ips"], "validar form-control", "IPS"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "ars", "ars", $vars["arrayRegistro"]["ars"], "validar form-control", "ARS"); ?></td>
                        </tr>

                        <tr>
                            <td>Sisben</td>
                            <td>Numero de celular</td>                            
                            <td>Telefono</td>                            
                            <td>Dirección de residencia</td>                            
                        </tr>
                        <tr>
                            <td><?php $formXhtml->inputtext("text", "sisben", "sisben", $vars["arrayRegistro"]["sisben"], "validar form-control", "Sisben"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "celular", "celular", $vars["arrayRegistro"]["celular"], "validar numeric form-control", "Numero de celular"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "telefono", "telefono", $vars["arrayRegistro"]["telefono"], "validar numeric form-control", "Telefono"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "ubicacion", "ubicacion", $vars["arrayRegistro"]["ubicacion"], "validar form-control", "Dirección de residencia"); ?></td>
                        </tr>

                        <tr>
                            <td>Barrio</td>
                            <td>Estrato</td>                                                                                    
                        </tr>
                        <tr>
                            <td><?php $formXhtml->select("barrio", "barrio", $vars["arrayRegistro"]["barrio"], "validar form-control", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?></td>
                            <td><?php $formXhtml->inputtext("text", "estrato", "estrato", $vars["arrayRegistro"]["estrato"], "validar form-control", "Estrato"); ?></td>                            
                        </tr>
                    </table>
                    <center>
                        <button class="ui-button ui-widget ui-corner-all">Matricular</button>
                    </center>
                </div>            
            </div>
        </div>
        <div id="dialog-confirm" title="Buscar estudiante">
            <table>
                <tr>
                    <td>Numero de documento</td>
                    <td><?php $formXhtml->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control", "Numero de documento"); ?></td>
                </tr>
            </table>            
        </div>
    </body>
</html>
