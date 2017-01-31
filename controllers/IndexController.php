<?php

class IndexController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function index() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        $sql = "SELECT * FROM articulo WHERE publicar = 'S' AND destacado_home = 'S' AND acceso = 'Publico' ORDER BY orden";
        
        //Cramos el paginador
        $paginador = new PHPPaging($indexModel->thisdb());
        $paginador->rowCount($sql);
        $paginador->config(3, 3);
        $sql = $sql." LIMIT $paginador->start_row, $paginador->max_rows";                
        
        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();         
        $data['menuSuperior'] = $indexModel->menuSuperior();         
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal(); 
        $data['eventosHome'] = $indexModel->eventosHome(); 
        $data['arrayLogo'] = $indexModel->arrayLogo();           
        $data['articuloMenu'] = $indexModel->articuloMenu();             
        $data['arrayPaginador'] =$indexModel->listArraySql($sql);        
        $data['paginador'] = $paginador;
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("index.php", $data);
    }

    public function agregar() {
        echo 'Aquí incluiremos nuestro formulario para insertar items';
    }

}

?>