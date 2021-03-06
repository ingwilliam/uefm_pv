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
            <div id="contenidoHome" class="contenidoGaleriaEvento">
                <div id="contenedorGaleria">
                    <h2 id="tituloDetalle"><?php echo $eventoActual["nombre"];?></h2>
                    <p style="margin: 0">
                        <b>Lugar:</b> <?php echo $eventoActual["direccion"];?></br>
                        <b>Fecha de inicio:</b> <?php echo $eventoActual["fecha_inicio"];?></br>
                        <b>Fecha de finalizacion:</b> <?php echo $eventoActual["fecha_fin"];?></br>
                        <b>Descripcion:</b> <?php echo $eventoActual["descripcion"];?>
                    
                    </p>
                    <?php
                    if( count($galeriaEvento) > 0 )
                    {
                    ?>
                    <br/>
                    <div id="gallery" class="content">
                        <div id="controls" class="controls"></div>
                        <div class="slideshow-container">
                            <div id="loading" class="loader"></div>
                            <div id="slideshow" class="slideshow"></div>
                        </div>
                        <div id="caption" class="caption-container"></div>
                    </div>
                    <div id="thumbs" class="navigation">
                        <ul class="thumbs noscript">
                            <?php
                                foreach( $galeriaEvento as $clave => $valor )
                                {
                                if( ! file_exists("images/thumb/mini".$valor["archivo"]) )
                                   $xhtml->generarThumb("images/thumb/mini".$valor["archivo"], $config->get("GALARTICULO_ROOT").$valor["archivo"], "75", "75");
                                if( ! file_exists("images/thumb/max".$valor["archivo"]) )
                                   $xhtml->generarThumb("images/thumb/max".$valor["archivo"], $config->get("GALARTICULO_ROOT").$valor["archivo"], "550", "502");
                                ?>
                                <li>
                                    <a class="thumb" name="leaf" href="<?php echo "images/thumb/max".$valor["archivo"];?>" title="<?php echo $valor["nombre"];?>">
                                        <img src="<?php echo "images/thumb/mini".$valor["archivo"];?>" alt="<?php echo $valor["nombre"];?>" />
                                    </a>
                                    <div class="caption">
                                        <div class="image-title"><?php echo $valor["nombre"];?></div>
                                        <div class="image-desc"><?php echo $valor["descripcion"];?></div>
                                    </div>
                                </li>
                                <?php
                                }
                            
                            ?>
                        </ul>
                    </div>
                    <div style="clear: both;"></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div id="piePagina">
                <?php
                include 'include/piepagina.php';
                ?>
            </div>
        </div>
    </body>
</html>
