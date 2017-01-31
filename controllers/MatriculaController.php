<?php

class MatriculaController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function matricula() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/MatriculaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $matriculaModel = new MatriculaModel();

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();         
        $data['menuSuperior'] = $indexModel->menuSuperior();         
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal(); 
        $data['eventosHome'] = $indexModel->eventosHome(); 
        $data['arrayLogo'] = $indexModel->arrayLogo();           
        $data['articuloMenu'] = $indexModel->articuloMenu();   
        $data['tipoDocumento'] = $matriculaModel->listArraySql("SELECT * FROM tipo_documento WHERE activo = true");   
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("matricula.php", $data);
    }

    public function verificar() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/MatriculaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $matriculaModel = new MatriculaModel();
        
        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();         
        $data['menuSuperior'] = $indexModel->menuSuperior();         
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal(); 
        $data['eventosHome'] = $indexModel->eventosHome(); 
        $data['arrayLogo'] = $indexModel->arrayLogo();           
        $data['articuloMenu'] = $indexModel->articuloMenu();   
        $data['tipoDocumento'] = $matriculaModel->listArraySql("SELECT * FROM tipo_documento WHERE activo = true");   
        $data['matriculas'] = $matriculaModel->listArraySql("SELECT * FROM matricula WHERE activo = true AND tipo_documento = '".$_POST["tipo_documento"]."' AND numero_documento = '".$_POST["numero_documento"]."'");   
        $data['matricula_actual'] = $matriculaModel->consultRegistroSql("SELECT * FROM matricula WHERE activo = true AND tipo_documento = '".$_POST["tipo_documento"]."' AND numero_documento = '".$_POST["numero_documento"]."' AND anio = '".$_POST["anio"]."'");
        $data['formXhtml'] = new Xhtml();
        //Finalmente presentamos nuestra plantilla
        $this->view->show("matricula.php", $data);
    }

}

?>