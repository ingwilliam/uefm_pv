                <a href="index.php" ><img id="logo" src="<?php echo $config->get("BANNERS_ROOT").$arrayLogo["archivo"];?>" alt="<?php echo $arrayLogo["nombre"];?>" title="<?php echo $arrayLogo["nombre"];?>" /></a>
                <div id="buscador">
                    <form method="get" action="busqueda.php" id="formBusqueda">
                        Buscar
                        <input type="text" class="inputBuscar" name="busqueda" />
                        <input type="submit" value="" id="botonBuscar" />
                    </form>
                    <ul class="menuRedesSociales">
                        <?php
                        foreach( $redesSociales as $clave => $valor )
                        {

                        $href = $valor["url"];

                        $blank = "_blank";

                        if ($valor["articulo"])
                        {
                            $href = "index.php?controlador=Interna&accion=interna&id=" . $valor["articulo"];
                            $blank = "";
                        }
                        else
                        {
                            if (($href == "") || ($href == "."))
                            {
                                $href = "javascript:void(0)";
                                $blank = "";
                            }
                        }

                        ?>
                        <li><a href="<?php echo $href; ?>" target="<?php echo $blank; ?>" ><img src="<?php echo $config->get("BANNERS_ROOT").$valor["archivo"];?>" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["nombre"];?>" /></a></li>
                        <?php
                        }
                        ?>                     
                    </ul>
                    <div style="clear: both"></div>
                </div>
                <div id="menu">
                    <ul>
                        <?php
                        foreach( $menuSuperior as $clave => $valor )
                        {
                        $href = $valor["url"];
                        if (($href == "") || ($href == "."))
                            $href = "index.php?controlador=Seccion&accion=seccion&ids=" . $clave;
                        ?>
                        <li><a href="<?php echo $href; ?>"  title="Pulse para consultar <?php echo $valor["nombre"]; ?>"><?php echo $valor["nombre"];?></a></li>
                        <?php
                        }
                        ?>                        
                        <li><a title="Unidad Educativa El Futuro Del Mana�a" href="index.php"><img src="images/casita.png" alt="Unidad Educativa El Futuro Del Ma�ana" title="Unidad Educativa El Futuro Del Ma�ana" /></a></li>
                    </ul>
                </div>