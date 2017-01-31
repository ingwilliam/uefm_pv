<?php

class GaleriaController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function galeria() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/GaleriaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $galeriaModel = new GaleriaModel();

        $sql="SELECT * FROM albun WHERE 1 ORDER BY id DESC";

        //Cramos el paginador
        $paginador = new PHPPaging($indexModel->thisdb());
        $paginador->rowCount($sql);
        $paginador->config(3, 9);
        $sql = $sql . " LIMIT $paginador->start_row, $paginador->max_rows";

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['xhtml'] = Xhtml::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();
        $data['menuSuperior'] = $indexModel->menuSuperior();
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal();
        $data['eventosHome'] = $indexModel->eventosHome();
        $data['arrayLogo'] = $indexModel->arrayLogo();
        $data['articuloMenu'] = $indexModel->articuloMenu();
        $data['arrayPaginador'] = $indexModel->listArraySql($sql);
        $data['paginador'] = $paginador;
        $data['db'] = $galeriaModel->thisdb();
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("galeria.php", $data);
    }

    public function detalle() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/GaleriaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $galeriaModel = new GaleriaModel();

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['xhtml'] = Xhtml::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();
        $data['menuSuperior'] = $indexModel->menuSuperior();
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal();
        $data['eventosHome'] = $indexModel->eventosHome();
        $data['arrayLogo'] = $indexModel->arrayLogo();
        $data['articuloMenu'] = $indexModel->articuloMenu();
        $data['db'] = $indexModel->thisdb();   
        
        $data['albunActual']=$galeriaModel->consultRegistroSql("SELECT * FROM albun WHERE id = '".$_GET["id"]."'");
        
        $data['galeriaAlbun']=$galeriaModel->listArraySql("SELECT * FROM galeria WHERE publicar = 'S' AND albun = '".$data['albunActual']["id"]."'");
        
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("detalle_galeria.php", $data);
    }

}

?>