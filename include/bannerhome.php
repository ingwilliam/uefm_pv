                <div class="slider-wrapper theme-default">
                    <div class="ribbon"></div>
                    <div id="slider" class="nivoSlider">
                        <?php
                        foreach( $bannerPrincipal as $clave => $valor )
                        {
                        $href = $valor["url"];

                        if ($valor["articulo"])
                            $href = "index.php?controlador=Interna&accion=interna&id=" . $valor["articulo"];
                        else
                        {
                            if (($href == "") || ($href == "."))
                                $href = "javascript:void(0)";
                        }
                        
                        ?>
                        <a href="<?php echo $href; ?>" ><img src="<?php echo $config->get("BANNERS_ROOT").$valor["archivo"];?>" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["descripcion"];?>" /></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>