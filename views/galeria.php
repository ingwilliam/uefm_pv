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
                    <h2 id="tituloDetalle">Galerias</h2>
                    <?php
                    $numeroDiv = 1;
                    $numeroItem = 1;
                    foreach($arrayPaginador as $valor) {
                        $totalFotos = $db->listArraySql( "SELECT * FROM galeria WHERE albun = '".$valor["id"]."'" ,"id");
                        
                        
                        if( $numeroItem == 4 )
                            $numeroDiv = 2;
                        if( $numeroItem == 7 )
                            $numeroDiv = 3;
                        if( ! file_exists("images/thumb/".$valor["archivo"]) )
                        {
                            if( ! file_exists($config->get("GALARTICULO_ROOT").$valor["archivo"]) )
                            {
                                $xhtml->generarThumb("images/thumb/".$valor["archivo"], $config->get("GALARTICULO_ROOT").$valor["archivo"], "138", "147");
                            }                            
                        }

                    ?>
                    <div class="albunes">
                        <h4 class="tituloGaleria<?php echo $numeroDiv;?>"><?php echo $valor["nombre"];?></h4>
                        <div>
                            <?php
                            if( count($totalFotos) > 0 )
                            {    
                            ?>
                            <a href="index.php?controlador=Galeria&accion=detalle&id=<?php echo $valor["id"];?>"><img src="<?php echo "images/thumb/".$valor["archivo"];?>" alt="<?php echo $valor["nombre"];?>" /></a>
                            <?php
                            }
                            else
                            {
                            ?>
                            <img src="<?php echo "images/thumb/".$valor["archivo"];?>" alt="<?php echo $valor["nombre"];?>" />
                            <?php
                            }    
                            ?>
                        </div>
                        <span><?php echo count($totalFotos);?> fotos</span>
                    </div>                    
                    <?php
                        $numeroItem++;
                    }
                    ?>                    
                    <div style="clear: both"></div>
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
