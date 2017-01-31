<?php

class InternaController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function interna() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/InternaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $internaModel = new InternaModel();

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();         
        $data['menuSuperior'] = $indexModel->menuSuperior();         
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal(); 
        $data['eventosHome'] = $indexModel->eventosHome(); 
        $data['arrayLogo'] = $indexModel->arrayLogo();           
        $data['articuloMenu'] = $indexModel->articuloMenu();   
        
        if( isset($_GET["id"]) )
        {
            $data['articuloActual'] = $internaModel->consultRegistroSql("SELECT * FROM articulo WHERE id = '".$_GET["id"]."' AND publicar = 'S'");
            $data['arraySeccionActual'] = $internaModel->consultRegistroSql("SELECT * FROM seccion WHERE publicar = 'S' AND id = '".$data['articuloActual']["seccion"]."' ");            
        }

        if( isset($_GET["ids"]) )
        {
            $data['articuloActual'] = $internaModel->consultRegistroSql("SELECT * FROM articulo WHERE seccion = '".$_GET["ids"]."' AND publicar = 'S'");
            $data['arraySeccionActual'] = $internaModel->consultRegistroSql("SELECT * FROM seccion WHERE publicar = 'S' AND id = '".$data['articuloActual']["seccion"]."' ");            
        }
        
        $data['galeriaArticulo'] = $internaModel->listArraySql( "SELECT * FROM galeria WHERE publicar = 'S' AND articulo = '".$data['articuloActual']["id"]."'" );
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("interna.php", $data);
    }

    public function agregar() {
        echo 'Aquí incluiremos nuestro formulario para insertar items';
    }

}

?>