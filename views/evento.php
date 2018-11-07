<?php
include 'libs/calendario.php'; //Calendario
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head.php';
        ?>
    </head>
    <body>
        <div id="pagina">
            <div id="cabecera">
                <?php
                include 'include/cabecera.php';
                ?>
            </div>
            <div id="bannerHome">
                <?php
                include 'include/bannerhome.php';
                ?>
            </div>
            <div id="contenidoHome" class="contenidoCuerpo">
                <div id="contenidoHomeIzqInterna">
                    <h2 id="tituloDetalle">Eventos institucionales</h2>
                    <?php
                    mostrar_calendario($db,$mes,$anio);

                    formularioCalendario($mes,$anio);
                    ?>
                    <br/><br/><br/>
                    <table class="tableEventos">
                        <thead>
                            <tr>
                                <th scope="col">Nombre del evento</th>
                                <th scope="col">Fecha inicio</th>
                                <th scope="col">Lugar del evento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($arrayPaginador as $valor) {
                            ?>
                            <tr>
                                <td><a href="index.php?controlador=Evento&accion=detalle&id=<?php echo $valor["id"];?>" title="<?php echo $valor["nombre"];?>" ><?php echo $valor["nombre"];?></a></td>
                                <td><?php echo $valor["fecha_inicio"];?></td>
                                <td><?php echo $valor["descripcion"];?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>    
                    </table>
                    <br/>
                    <div class="pagination">
                    <?php
                    echo $paginador->pages("btn");
                    ?>
                    </div>
                </div>
                <div id="contenidoHomeDer">
                    <?php
                    include 'include/contenidohomeder.php';
                    ?>
                </div>
                <div style="clear: both"></div>
            </div>
            <div id="piePagina">
            <?php
            include 'include/piepagina.php';
            ?>
            </div>
        </div>
    </body>
</html>
