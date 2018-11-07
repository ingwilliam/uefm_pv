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
                    <h2 id="tituloDetalle"><?php echo $articuloActual["nombre"];?></h2>
                    <?php
                    echo $articuloActual["cuerpo"];
                    ?>
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