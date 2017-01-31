                <a href="#" class="buttons prev">left</a>
                <div class="viewport">
                    <ul id="ulSubMenuHome" class="overview" style="width: 1560px; left: -520px;">
                        <?php
                        foreach( $articuloMenu as $clave => $valor )
                        {

                        if ($valor["id"])
                            $href = "index.php?controlador=Interna&accion=interna&id=" . $valor["id"];
                        else
                            $href = "javascript:void(0)";

                        ?>
                        <li>
                            <table class="tableSubMenu1">
                                <tr class="tituloSubMenu">
                                    <td valign="top"><a href="<?php echo $href;?>" title="<?php echo $valor["nombre"];?>"><?php echo $valor["nombre_dos"];?></a></td>
                                </tr>
                                <tr class="cuerposSubMenu">
                                    <td valign="top"><a href="<?php echo $href;?>" title="<?php echo $valor["nombre"];?>"><img src="<?php echo $config->get("GALARTICULO_ROOT").$valor["archivo"];?>" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["nombre"];?>" width="128px" height="96px"  /></a></td>
                                </tr>
                            </table>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <a href="#" class="buttons next">right</a>