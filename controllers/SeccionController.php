<?php

class SeccionController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function seccion() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/SeccionModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $seccionModel = new SeccionModel();

        $sql = "SELECT * FROM articulo WHERE publicar = 'S' AND acceso = 'Publico' AND seccion = '".$_GET["ids"]."' ORDER BY nombre";
        
        //Cramos el paginador
        $paginador = new PHPPaging($indexModel->thisdb());
        $paginador->rowCount($sql);
        $paginador->config(3, 6);
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
        $data['seccionActual'] = $seccionModel->consultRegistroSql("SELECT * FROM seccion WHERE id = '".$_GET["ids"]."' AND publicar = 'S' ORDER BY orden");
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("seccion.php", $data);
    }

    public function agregar() {
        echo 'Aquí incluiremos nuestro formulario para insertar items';
    }

}

?>