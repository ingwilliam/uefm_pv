<div id="comparteRedes">                    
    <!--
    <a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&amp;send=false&amp;layout=box_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:77px; height:60px;margin-right: 2px;" allowTransparency="true"></iframe>
    <g:plusone size="tall"></g:plusone>
    -->
</div>
<?php
if (count($galeriaArticulo) > 0) {
    ?>
    <div id="galeriaInterna">
        <h2 id="tituloDetalleInterna">Galeria de imagenes</h2>
        <?php
        foreach ($galeriaArticulo as $clave => $valor) {
            ?>
            <a href="<?php echo $config->get("GALARTICULO_ROOT") . $valor["archivo"]; ?>" rel="galeriaInterna" title="<?php echo $valor["nombre"]; ?>"><img src="<?php echo $config->get("GALARTICULO_ROOT") . $valor["archivo"]; ?>" alt="<?php echo $valor["nombre"]; ?>" title="<?php echo $valor["nombre"]; ?>" width="50px" height="50px" /></a>
            <?php
        }
        ?>
    </div>
    <br/>
    <?php
}
?>
<div id="loginPagina">
    <div id="cabeceraLogin">Ingrese</div>
    <div id="cuerpoLogin">
        <table id="tablaLogin">
            <tr>
                <td>Usuario</td>
                <td><input type="text" class="inputLogin" /></td>
            </tr>
            <tr>
                <td>Clave</td>
                <td><input type="text" class="inputLogin" /></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="image" src="images/ColegioInterfazCorte2_r8_c13.png" /> </td>
            </tr>
        </table>

    </div>
    <div id="pieLogin"></div>
</div>
<?php
if (count($eventosHome) > 0) {
    ?>
    <br/>
    <div id="eventosPagina">
        <div id="cabeceraEventos">Eventos</div>
        <div id="cuerpoEventos">
            <ul>
                <?php
                foreach ($eventosHome as $clave => $valor) {
                    ?>
                    <li><a href="detalleevento.php?id=<?php echo $clave; ?>"><?php echo $valor["nombre"]; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div id="pieEventos"></div>
    </div>
    <?php
}
?>
                    