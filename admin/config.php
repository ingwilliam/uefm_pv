<?php
$config = Config::singleton();

$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'uefmcolegio');
$config->set('dbuser', 'root');
$config->set('dbpass', 'ingwilliam10');

//tiempo de seguridad de la session
$config->set('TIMESESSION', '240');

//nombre de la variable de session
$config->set('SESSIONADMINISTRADOR', 'RECTORIAUEFM');

//directorio raiz donde se encuentra el sitio
$config->set('DIRROOT', dirname( __FILE__ )."/");

//url del la web actual
$config->set('URLROOT', "http://" . $_SERVER["HTTP_HOST"] ."/uefm/");


$config->set('USUARIOS_DIR', $config->get('DIRROOT') . "dist/img/usuario/");
$config->set('USUARIOS_ROOT',  $config->get('URLROOT') . "dist/img/usuario/");
$config->set('MATRICULAS_DIR', $config->get('DIRROOT') . "dist/img/matricula/");
$config->set('MATRICULAS_ROOT',  $config->get('URLROOT') . "dist/img/matricula/");

?>