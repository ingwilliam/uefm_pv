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
                    <h1 id="tituloDetalle"><?php echo $seccionActual["nombre"];?></h1>
                    <?php
                    $numeroDiv = 1;
                    foreach($arrayPaginador as $valor)
                    {
                    ?>
                    <div class="bloqueA">
                        <div class="bloqueB">
                            <img src="<?php echo $config->get("GALARTICULO_ROOT").$valor["archivo_dos"];?>" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["nombre"];?>" />
                        </div>
                        <div class="bloqueC">
                            <h3 class="titulo<?php echo $numeroDiv;?>"><?php echo $valor["nombre"];?></h3>
                            <p><?php echo substr($valor["introduccion"],0,350);?>...</p>
                            <div class="alinearDer"><a href="index.php?controlador=Interna&accion=interna&id=<?php echo $valor["id"];?>" class="vermas<?php echo $numeroDiv;?>" title="<?php echo $valor["nombre"];?>">Ver más <img src="images/flecha<?php echo $numeroDiv;?>.png" alt="ver mas" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["nombre"];?>" /></a></div>
                            <hr/>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <?php
                    $numeroDiv++;

                    if( $numeroDiv == 4 )
                        $numeroDiv = 1;

                    }
                    ?>
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