<?php

class ContactoController {

    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function contacto() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();
        $data['menuSuperior'] = $indexModel->menuSuperior();
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal();
        $data['eventosHome'] = $indexModel->eventosHome();
        $data['arrayLogo'] = $indexModel->arrayLogo();
        $data['articuloMenu'] = $indexModel->articuloMenu();

        //Finalmente presentamos nuestra plantilla
        $this->view->show("contacto.php", $data);
    }

    public function enviar() {
        $mail = "La persona ".$_POST['nombre'].", de la ciudad ".$_POST['ciudad']." dejo el siguiente mensaje <br/> ".$_POST['mensaje']." <br/> Sus datos de contacto son: <b>Email: ".$_POST['email']."</b><br/><b>Telefono: ".$_POST['telefono']."</b>";
        //Titulo
        $titulo = "Contactenos www.colegioelfuturo.edu.co";
        //cabecera  
        //dirección del remitente 
        $header = "From: Administrador UEFM <contactenos@colegioelfuturo.edu.co/>\n";
        $header .= "Content-Type: text/html\n";
        //Enviamos el mensaje a tu_dirección_email 
        $bool = mail("rectoria_uefm@yahoo.es", $titulo, $mail, $header);
        
        if ($bool) {
            echo "<script type=\"text/javascript\">alert('Su mensaje ha sido enviado correctamente');</script> ";
        } else {
            echo "<script type=\"text/javascript\">alert('Su mensaje no se enviado correctamente');</script> ";
        }
        
        echo "<script type=\"text/javascript\">location.href='index.php?controlador=Contacto&accion=contacto';</script>";
        
    }

}
?>