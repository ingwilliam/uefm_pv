<?php

$config = Config::singleton();

$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'uefmcolegioweb');
$config->set('dbuser', 'root');
$config->set('dbpass', 'ingwilliam10');


$config->set('DIRROOT', dirname( __FILE__ ).'/');
$config->set('URLROOT', "http://" . $_SERVER["HTTP_HOST"] ."/uefm/");
$config->set('BANNERS_DIR', $config->get("DIRROOT")."../images/banners/");
$config->set('BANNERS_ROOT',  $config->get("URLROOT")."images/banners/");

$config->set('SECCION_DIR', $config->get("DIRROOT")."../images/seccion/");
$config->set('SECCION_ROOT',  $config->get("URLROOT")."images/seccion/");

$config->set('GALARTICULO_DIR', $config->get("DIRROOT")."../images/galarticulo/");
$config->set('GALARTICULO_ROOT',  $config->get("URLROOT")."images/galarticulo/");

$config->set('PRODUCTOS_DIR', $config->get("DIRROOT")."../images/productos/");
$config->set('PRODUCTOS_ROOT',  $config->get("URLROOT")."images/productos/");

$config->set('USUARIO_DIR', $config->get("DIRROOT")."../images/usuario/");
$config->set('USUARIO_ROOT',  $config->get("URLROOT")."images/usuario/");

?>