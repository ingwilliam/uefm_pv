<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head_new.php';
        ?>
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
                <a href="index.php?controlador=Matricula&accion=matricula">
                    <img style="float: left;" src="images/anterior.png" alt="Volver"/>
                    <span style="float: left; margin-top: 9px;color: #00529b; font-weight: bold">Volver a colsultar</span>
                </a>
                <div style="clear: both"></div>
                <?php
                if (isset($_GET["anio"])&&isset($_GET["numero_documento"])&&isset($_GET["tipo_documento"])) {
                    if (count($matricula_actual) > 2) {
                        ?>
                        <div class="correcto">
                            Felicitaciones!! Señores padres de familia su hijo se encuentra registrado para el año <b style="color: red"><?php echo $_GET["anio"]; ?></b> para el grado (<?php echo $matriculas["curso_nombre"]; ?>) y el estado actual es <b style="color: red"><?php echo $matricula_actual["estado"]; ?></b>.                            
                            
                            <br/><br/>
                            <a style="font-size: 22px" target="_blank" href="admin/libs/TCPDF-master/examples/formato_matricula.php?id=<?php echo $matricula_actual["id"]; ?>">1 Imprimir Hoja de Matricula</a>
                            <br/><br/>
                            <a style="font-size: 22px" target="_blank" href="admin/libs/TCPDF-master/examples/formato_pago_matricula.php?id=<?php echo $matricula_actual["id"]; ?>">2 Imprimir Pago Matricula</a>
                            
                        </div>                
                        <?php
                    } else {
                        //OJO ME QUEDE EN GUARDAR LA MATRICULA VERIFICAR CUANDO HAY UNO NUEVO POR QUE NO TRAE LA CEDULA NI EL TIPO
                        
                        if(count($matriculas)>0)
                        {
                            $matricula_actual=$matriculas;
                        } 
                        
                        $matricula_actual["curso"]="";
                        ?>                        
                        <div style="clear: both"></div>
                        <div class="info">
                            Señores padres de familia para poder registrar a su hijo para el año <b style="color: red"><?php echo $_GET["anio"]; ?></b> debe registrar la siguiente informacion:                            
                        </div>
                        <div id="accordion">
                            <h3>Matriculas <?php echo $_GET["anio"]; ?> UEFM</h3>
                            <div>                                
                                <form method="post" enctype="multipart/form-data" class="niceform" action="index.php?controlador=Matricula&accion=registrar">
                                    <h2 style="margin: 0px;">Datos del estudiante</h2>
                                    <b style="font-size: 12px;">Los campos con (<em style="color: red; font-weight: bold">*</em>) son obligatorios</b><br/><br/>
                                    <table style="width: 100%">
                                        <tr>
                                            <td>Grado <em style="color: red; font-weight: bold">*</em></td>
                                            <td>Tipo de documento <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Numero de documento <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Ciudad de expedicion <em style="color: red; font-weight: bold">*</em></td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->select("curso", "curso", $matricula_actual["curso"], "validar ", "Grado", "", "curso", "id", "nombre", "", "1", " id ASC"); ?></td>
                                            <td><?php $formXhtml->select("tipo_documento", "tipo_documento", $matricula_actual["tipo_documento"], "validar ", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC",array(),"",":: Seleccione ::"); ?></td>                                                                         
                                            <td><?php $formXhtml->inputtext("text", "numero_documento", "numero_documento", $matricula_actual["numero_documento"], "validar numeric", "Numero de documento" , "", "", "", ""); ?></td>
                                            <td><?php $formXhtml->selectExtra("ciudad_expedicion", "ciudad_expedicion", $matricula_actual["ciudad_expedicion"], "validar ", "Ciudad de expedicion Documento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", "departamento"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Primer nombre <em style="color: red; font-weight: bold">*</em></td>
                                            <td>Segundo nombre</td>                            
                                            <td>Primer apellido <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Segundo apellido</td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "primer_nombre", "primer_nombre", $matricula_actual["primer_nombre"], "validar ", "Primer nombre"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "segundo_nombre", "segundo_nombre", $matricula_actual["segundo_nombre"], "", "Segundo nombre"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "primer_apellido", "primer_apellido", $matricula_actual["primer_apellido"], "validar ", "Primer apellido"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "segundo_apellido", "segundo_apellido", $matricula_actual["segundo_apellido"], "", "Segundo apellido"); ?></td>
                                        </tr>                        
                                        <tr>
                                            <td>Genero</td>
                                            <td>Ciudad de nacimiento <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Fecha de nacimiento <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Tipo de discapacidad</td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->radio("genero", "genero", $matricula_actual["genero"], "validar", "Genero", "", array("M" => "M", "F" => "F")); ?></td>
                                            <td><?php $formXhtml->select("ciudad_nacimiento", "ciudad_nacimiento", $matricula_actual["ciudad_nacimiento"], "validar ", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", $tableextra = "departamento"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "fecha_nacimiento", "fecha_nacimiento", $matricula_actual["fecha_nacimiento"], "validar  calendario", "Fecha de nacimiento", "", "", "", "readonly='readonly'", "", "", true); ?></td>
                                            <td><?php $formXhtml->select("tipo_discapacidad", "tipo_discapacidad", $matricula_actual["tipo_discapacidad"], "", "Tipo de discapacidad", "", "tipo_discapacidad", "id", "nombre", "", "1", " nombre ASC"); ?></td>
                                        </tr>

                                        <tr>
                                            <td>RH <em style="color: red; font-weight: bold">*</em></td>
                                            <td>EPS <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>IPS</td>                            
                                            <td>ARS</td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "rh", "rh", $matricula_actual["rh"], "validar", "RH"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "eps", "eps", $matricula_actual["eps"], "validar", "EPS"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "ips", "ips", $matricula_actual["ips"], "", "IPS"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "ars", "ars", $matricula_actual["ars"], "", "ARS"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sisben <em style="color: red; font-weight: bold">*</em></td>
                                            <td>Numero de celular <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Telefono</td>                            
                                            <td>Dirección de residencia <em style="color: red; font-weight: bold">*</em></td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "sisben", "sisben", $matricula_actual["sisben"], "validar ", "Sisben"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "celular", "celular", $matricula_actual["celular"], "validar numeric ", "Numero de celular"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "telefono", "telefono", $matricula_actual["telefono"], "numeric ", "Telefono"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "ubicacion", "ubicacion", $matricula_actual["ubicacion"], "validar ", "Dirección de residencia"); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Barrio <em style="color: red; font-weight: bold">*</em></td>
                                            <td>Estrato <em style="color: red; font-weight: bold">*</em></td>                                                                                                                                
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->select("barrio", "barrio", $matricula_actual["barrio"], "validar ", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "estrato", "estrato", $matricula_actual["estrato"], "validar ", "Estrato"); ?></td>                                            
                                        </tr>
                                    </table> 
                                    <br/>
                                    <h2 style="margin: 0px;">Datos del acudiente (Padre o Madre)</h2>
                                    <b style="font-size: 12px;">Los campos con (<em style="color: red; font-weight: bold">*</em>) son obligatorios</b><br/><br/>
                                    <table style="width: 100%">
                                        <tr>
                                            <td>Tipo de documento <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Numero de documento <em style="color: red; font-weight: bold">*</em></td>                                                                                                    
                                            <td>Primer nombre <em style="color: red; font-weight: bold">*</em></td>
                                            <td>Segundo nombre</td>                                                                        
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->select("tipo_documento_padre", "padre[tipo_documento]", "", "validar ", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC",array(),"",":: Seleccione ::"); ?></td>                                                                         
                                            <td><?php $formXhtml->inputtext("text", "numero_documento_padre", "padre[numero_documento]", "", "validar numeric", "Numero de documento" , "", "", "", ""); ?></td>                                            
                                            <td><?php $formXhtml->inputtext("text", "primer_nombre_padre", "padre[primer_nombre]", "", "validar ", "Primer nombre"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "segundo_nombre_padre", "padre[segundo_nombre]", "", "", "Segundo nombre"); ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Primer apellido <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Segundo apellido</td>                            
                                            <td>Fecha de nacimiento <em style="color: red; font-weight: bold">*</em></td>                                                                                                    
                                            <td>Ciudad de nacimiento <em style="color: red; font-weight: bold">*</em></td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "primer_apellido_padre", "padre[primer_apellido]", "", "validar ", "Primer apellido"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "segundo_apellido_padre", "padre[segundo_apellido]", "", "", "Segundo apellido"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "fecha_nacimiento_padre", "padre[fecha_nacimiento]", "", "validar  calendario", "Fecha de nacimiento", "", "", "", "readonly='readonly'", "", "", true); ?></td>                                            
                                            <td><?php $formXhtml->select("ciudad_nacimiento_padre", "padre[ciudad_nacimiento]", "", "validar ", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", $tableextra = "departamento"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Numero de celular <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Telefono <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Dirección de residencia <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Barrio <em style="color: red; font-weight: bold">*</em></td>                                                                                                                                
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "celular_padre", "padre[celular]", "", "validar numeric ", "Numero de celular"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "telefono_padre", "padre[telefono]", "", "validar numeric ", "Telefono"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "ubicacion_padre", "padre[ubicacion]", "", "validar ", "Dirección de residencia"); ?></td>
                                            <td><?php $formXhtml->select("barrio_padre", "padre[barrio]", "", "validar ", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td>Genero</td>
                                            <td>RH <em style="color: red; font-weight: bold">*</em></td>                                                                        
                                            <td>Email <em style="color: red; font-weight: bold">*</em></td>                                                                        
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->radio("genero_padre", "padre[genero]", "", "validar", "Genero", "", array("M" => "M", "F" => "F")); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "rh_padre", "padre[rh]", "", "validar", "RH"); ?></td>                                            
                                            <td><?php $formXhtml->inputtext("text", "email_padre", "padre[email]", "", "validar email email_validar_padre", "Email"); ?></td>                                            
                                        </tr>
                                    </table>
                                    <br/>
                                    <h2 style="margin: 0px;">Datos del acudiente</h2>
                                    <b style="font-size: 12px;">Los campos con (<em style="color: red; font-weight: bold">*</em>) son obligatorios</b><br/><br/>
                                    <table style="width: 100%">
                                        <tr>
                                            <td>Tipo de documento <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Numero de documento <em style="color: red; font-weight: bold">*</em></td>                                                                                                    
                                            <td>Primer nombre <em style="color: red; font-weight: bold">*</em></td>
                                            <td>Segundo nombre</td>                                                                        
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->select("tipo_documento_acudiente", "acudiente[tipo_documento]", "", "validar ", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC",array(),"",":: Seleccione ::"); ?></td>                                                                         
                                            <td><?php $formXhtml->inputtext("text", "numero_documento_acudiente", "acudiente[numero_documento]", "", "validar numeric", "Numero de documento" , "", "", "", ""); ?></td>                                            
                                            <td><?php $formXhtml->inputtext("text", "primer_nombre_acudiente", "acudiente[primer_nombre]", "", "validar", "Primer nombre"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "segundo_nombre_acudiente", "acudiente[segundo_nombre]", "", "", "Segundo nombre"); ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Primer apellido <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Segundo apellido</td>                            
                                            <td>Fecha de nacimiento <em style="color: red; font-weight: bold">*</em></td>                                                                                                    
                                            <td>Ciudad de nacimiento <em style="color: red; font-weight: bold">*</em></td>                            
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "primer_apellido_acudiente", "acudiente[primer_apellido]", "", "validar ", "Primer apellido"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "segundo_apellido_acudiente", "acudiente[segundo_apellido]", "", "", "Segundo apellido"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "fecha_nacimiento_acudiente", "acudiente[fecha_nacimiento]", "", "validar  calendario", "Fecha de nacimiento", "", "", "", "readonly='readonly'", "", "", true); ?></td>                                            
                                            <td><?php $formXhtml->select("ciudad_nacimiento_acudiente", "acudiente[ciudad_nacimiento]", "", "validar ", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", $tableextra = "departamento"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Numero de celular <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Telefono <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Dirección de residencia <em style="color: red; font-weight: bold">*</em></td>                            
                                            <td>Barrio <em style="color: red; font-weight: bold">*</em></td>                                                                                                                                
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->inputtext("text", "celular_acudiente", "acudiente[celular]", "", "validar numeric ", "Numero de celular"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "telefono_acudiente", "acudiente[telefono]", "", "validar numeric ", "Telefono"); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "ubicacion_acudiente", "acudiente[ubicacion]", "", "validar ", "Dirección de residencia"); ?></td>
                                            <td><?php $formXhtml->select("barrio_acudiente", "acudiente[barrio]", "", "validar ", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td>Genero</td>
                                            <td>RH <em style="color: red; font-weight: bold">*</em></td>                                                                        
                                            <td>Email <em style="color: red; font-weight: bold">*</em></td>                                                                        
                                        </tr>
                                        <tr>
                                            <td><?php $formXhtml->radio("genero_acudiente", "acudiente[genero]", "", "validar", "Genero", "", array("M" => "M", "F" => "F")); ?></td>
                                            <td><?php $formXhtml->inputtext("text", "rh_acudiente", "acudiente[rh]", "", "validar", "RH"); ?></td>                                            
                                            <td><?php $formXhtml->inputtext("text", "email_acudiente", "acudiente[email]", "", "validar email email_validar_acudiente", "Email"); ?></td>                                            
                                        </tr>
                                    </table>
                                    <br/>
                                    <center>
                                        <input type="submit" value="Matricular" class="ui-button ui-widget ui-corner-all" />
                                        <input type="hidden" id="anio" name="anio" value="<?php echo $_GET["anio"]; ?>" /> 
                                        <input type="hidden" id="id_padre" name="id_padre" value="" /> 
                                        <input type="hidden" id="id_acudiente" name="id_acudiente" value="" /> 
                                        <?php
                                        if(isset($matricula_actual["id"])&&$matricula_actual["id"]>0)
                                        {
                                            if(isset($matricula_actual["estudiante"])&&$matricula_actual["estudiante"]>0)
                                            {
                                            ?>
                                            <input type="hidden" name="estudiante" value="<?php echo $matricula_actual["estudiante"]; ?>" />                                        
                                            <?php
                                            }
                                            ?>
                                            <input type="hidden" id="id" name="id" value="<?php echo $matricula_actual["id"]; ?>" />                                        
                                            <?php
                                        }
                                        ?>
                                    </center>
                                    <br/>
                                </form>
                            </div>                             
                        </div>
                        <?php
                    }
                } else {
                    ?>                
                        <div class="info"><b>Señores padres de familia para poder formalizar la matricula de su hijo debe ingresar toda la informaci&oacute;n para el año <?php echo $_GET["anio"]; ?>, por favor digit&eacute; el numero de documento de su hijo: </b></div>
                    <form method="get" enctype="multipart/form-data" class="niceform" action="index.php">
                        <table style="margin: 0 auto; width: 590px">
                            <tr>
                                <td class="tituloContacto" style="text-align: center !important">Año de matricula <em>*</em></td>
                                <td class="tituloContacto" style="text-align: center !important">Tipo de Documento <em>*</em></td>
                                <td class="tituloContacto" style="text-align: center !important">Numero de Documento <em>*</em></td>                            
                            </tr>                        
                            <tr>
                                <td><?php $formXhtml->select("anio", "anio", "", "validar", "Añor de matricula", "", "", "", "", "", "", "",array(date("Y")=>date("Y"),date("Y")+1=>date("Y")+1)); ?></td>
                                <td><?php $formXhtml->select("tipo_documento_", "tipo_documento", "", "validar", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?></td>
                                <td><?php $formXhtml->inputtext("text", "numero_documento_", "numero_documento", "", "validar numeric", "Numero de documento"); ?></td>
                            </tr>                        
                            <tr>
                                <td colspan="3" align="center">
                                    <input type="hidden" name="controlador" value="Matricula" />                                        
                                    <input type="hidden" name="accion" value="verificar" />                                                                            
                                    <input type="submit" value="Enviar" />                                        
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
