<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head.php';
        ?>
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
                width: 180px;
            }
            input[type=text]{
                width: 180px;
            }
        </style>
    </head>
    <body>
        <div id="pagina">
            <div id="cabecera">
                <?php
                include 'include/cabecera.php';
                ?>
            </div>
            <div id="contenidoHome" class="contenidoCuerpo" style="min-height: 400px">
                <?php
                if (isset($_POST["anio"])) {
                    if (count($matricula_actual) > 1) {
                        ?>
                        <div class="correcto">
                            Señores padres de familia su hijo se encuentra registrado para el año <b style="color: red"><?php echo date("Y"); ?></b> y el estado actual es <b style="color: red"><?php echo $matricula_actual["estado"]; ?></b>.                            
                        </div>                
                        <div class="info">
                            Por favor tener en cuenta las siguientes recomendaciones:
                            <ul>
                                <li>Si el estado del estudiante es <b style="color: red">Matriculado</b>, felicitaciones su hijo se encuentra matriculado para el año <b style="color: red"><?php echo date("Y"); ?></b></li>
                                <li>Si el estado del estudiante es <b style="color: red">Revisado</b>, debe acercarse a la institución debido a que no han formalizado la matricula para el año <b style="color: red"><?php echo date("Y"); ?></b></li>                                
                                <li>Si el estado del estudiante es <b style="color: red">Inscrito</b>, debe acercarse a la institución para que la información sea revisada y pueda formalizar la matricula para el año <b style="color: red"><?php echo date("Y"); ?></b></li>                                                               
                            </ul>
                        </div>                
                        <?php
                    } else {
                        ?>
                        <div class="info">
                            Señores padres de familia para poder registrar a su hijo para el año <b style="color: red"><?php echo date("Y"); ?></b> debe registrar la siguiente informacion:
                        </div>
                        <div id="accordion">
                            <h3>Matriculas <?php echo date("Y"); ?> UEFM</h3>
                            <form method="post" enctype="multipart/form-data" class="niceform" action="index.php?controlador=Matricula&accion=registrar">
                                <div>
                                    <table style="width: 100%">
                                        <tr>
                                            <td>Grado</td>
                                            <td>Tipo de documento</td>                            
                                            <td>Numero de documento</td>                            
                                            <td>Ciudad de expedicion</td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->select("curso", "curso", $vars["arrayRegistro"]["curso"], "validar form-control", "Grado", "", "curso", "id", "nombre", "", "1", " id ASC"); ?></td>
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
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    ?>                
                    <div class="info"><b>Señores padres de familia para poder formalizar la matricula de su hijo deben registrar a su hijo para el año <?php echo date("Y"); ?>, por favor digite el numero de documento de su hijo: </b></div>
                    <form method="post" enctype="multipart/form-data" class="niceform" action="index.php?controlador=Matricula&accion=verificar">
                        <table style="margin: 0 auto; width: 590px">
                            <tr>
                                <td class="tituloContacto" style="text-align: center !important">Tipo de Documento <em>*</em></td>
                                <td class="tituloContacto" style="text-align: center !important">Numero de Documento <em>*</em></td>                            
                            </tr>                        
                            <tr>
                                <td><?php $formXhtml->select("tipo_documento", "tipo_documento", "", "validar", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?></td>
                                <td><?php $formXhtml->inputtext("text", "numero_documento", "numero_documento", "", "validar", "Numero de documento"); ?></td>
                            </tr>                        
                            <tr>
                                <td colspan="2" align="center">

                                    <input type="hidden" name="anio" value="<?php echo date("Y"); ?>" />                                        
                                    <input type="submit" value="Enviar" class="enviarContacto" />                                        
                                </td>
                            </tr>
                        </table>                                                 
                    </form>   
                    <?php
                }
                ?>
            </div>
            <div id="piePagina">
                <?php
                include 'include/piepagina.php';
                ?>
            </div>
        </div>
    </body>
</html>
