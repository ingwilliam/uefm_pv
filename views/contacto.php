<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/headcontacto.php';
        ?>
    </head>
    <body>
        <div id="pagina">
            <div id="cabecera">
                <?php
                include 'include/cabecera.php';
                ?>
            </div>
            <div id="contenidoHome" class="contenidoCuerpo">
                <div id="contenidoContacto">
                    <h2>Formulario de Contacto</h2>
                    <p>Ingrese los datos a continuación y pronto estaremos en contacto </p>
                    <form method="post" enctype="multipart/form-data" class="niceform" action="index.php?controlador=Contacto&accion=enviar">
                        <table id="tablaContacto">
                            <tr>
                                <td class="tituloContacto">Nombre y Apellidos <em>*</em></td>
                                <td><input type="text" value="" name="nombre" size="25" id="nombre" class="validar" /></td>
                            </tr>
                            <tr>
                                <td class="tituloContacto">Email <em>*</em></td>
                                <td><input type="text" value="" name="email" size="25" id="email" class="validar email" /></td>
                            </tr>
                            <tr>
                                <td class="tituloContacto">Ciudad <em>*</em></td>
                                <td><input type="text" value="" name="ciudad" size="25" id="ciudad" class="validar" /></td>
                            </tr>
                            <tr>
                                <td class="tituloContacto">Telefono <em>*</em></td>
                                <td><input type="text" value="" name="telefono" size="25" id="telefono" class="validar" /></td>
                            </tr>
                            <tr>
                                <td class="tituloContacto">Mensaje <em>*</em></td>
                                <td>
                                    <textarea id="mensaje" name="mensaje" cols="35" rows="8" class="validar" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"><br/>
                                    <input type="submit" value="Enviar" class="enviarContacto" />                                        
                                </td>
                            </tr>
                        </table>                                                 
                    </form>


                </div>
                <div id="contenidoHomeDerCon">
                    <h3>Dirección y Telefono</h3>
                    Calle 42 bis sur N° 80 F 93 - 5706360
                    <h3>Localidad</h3>
                    Kennedy (8)
                    <h3>Fecha de fundación</h3>
                    Octubre 31 De 1992
                    <h3>Inscripción Ante Secretaria De Educación</h3>
                    0053
                    <h3>Resolución Oficial No</h3>
                    O8-0109 - Expedida El 3 De Marzo De 2009
                    <br/><br/>
                    Educación Para Jóvenes Y Adultos Resolución<br/>
                    08-0227del 5 De Agosto Del 2.
                    <h3>Jornada</h3>
                    Única Y Sábado
                    <h3>Horario jornada única</h3>
                    6:15 am a 3:00 pm
                    <h3>Horario sábado</h3>
                    8:00 am a 3:00 pm


                </div>
                <div style="clear: both"></div>
                <br/><br/>
                <h1 id="tituloDetalle">Localización satélital</h1>
                <div id="map_canvas" style="width: 850px; height: 400px;"></div>                
            </div>
            <div id="piePagina">
                <?php
                include 'include/piepagina.php';
                ?>
            </div>
        </div>
    </body>
</html>
