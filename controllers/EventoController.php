<?php

class EventoController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function evento() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/EventoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $eventoModel = new EventoModel();

        //Indicamos la consulta al objeto
        if (isset($_POST["anio"])) {
            $dia = $_POST["dia"];
            $mes = $_POST["mes"];
            $anio = $_POST["anio"];
            if ($dia)
                $sql = "SELECT * FROM evento WHERE day( fecha_inicio ) = $dia AND month( fecha_inicio ) = $mes AND year( fecha_inicio ) = $anio ORDER BY nombre";
            else
                $sql = "SELECT * FROM evento WHERE month( fecha_inicio ) = $mes AND year( fecha_inicio ) = $anio ORDER BY nombre";
        }
        else
        {    
            if (isset($_GET["anio"])) {
                $dia = $_GET["dia"];
                $mes = $_GET["mes"];
                $anio = $_GET["anio"];
                if ($dia)
                    $sql = "SELECT * FROM evento WHERE day( fecha_inicio ) = $dia AND month( fecha_inicio ) = $mes AND year( fecha_inicio ) = $anio ORDER BY nombre";
                else
                    $sql = "SELECT * FROM evento WHERE month( fecha_inicio ) = $mes AND year( fecha_inicio ) = $anio ORDER BY nombre";
            }else {
                $tiempo_actual = time();
                $mes = date("n", $tiempo_actual);
                $anio = date("Y", $tiempo_actual);
                $sql = "SELECT * FROM evento WHERE month( fecha_inicio ) = $mes AND year( fecha_inicio ) = $anio ORDER BY nombre";
            }
        }


        //Cramos el paginador
        $paginador = new PHPPaging($indexModel->thisdb());
        $paginador->rowCount($sql);
        $paginador->config(3, 3);
        $sql = $sql . " LIMIT $paginador->start_row, $paginador->max_rows";

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();
        $data['menuSuperior'] = $indexModel->menuSuperior();
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal();
        $data['eventosHome'] = $indexModel->eventosHome();
        $data['arrayLogo'] = $indexModel->arrayLogo();
        $data['articuloMenu'] = $indexModel->articuloMenu();
        $data['arrayPaginador'] = $indexModel->listArraySql($sql);
        $data['paginador'] = $paginador;
        $data['db'] = $indexModel->thisdb();
        if(isset($dia))
        {
            $data['dia'] = $dia;
        }
        $data['mes'] = $mes;
        $data['anio'] = $anio;

        //Finalmente presentamos nuestra plantilla
        $this->view->show("evento.php", $data);
    }

    public function detalle() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/EventoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $eventoModel = new EventoModel();

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
        
        $data['eventoActual']=$eventoModel->consultRegistroSql("SELECT * FROM evento WHERE id = '".$_GET["id"]."'");
        
        $data['galeriaEvento']=$eventoModel->listArraySql("SELECT * FROM galeria WHERE publicar = 'S' AND evento = '".$data['eventoActual']["id"]."'");
        
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("detalle_evento.php", $data);
    }

}

?>