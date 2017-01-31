<?php
class IndexController extends ControllerBase
{
    private $url = "index.php";
    
    //Accion index
    public function index()
    {
        $config = Config::singleton();
        
        //REEMPLEZAR ESTE LINEA EL TODO EL PROYECTO VOY EN IMPLEMENTAR LOS PERMISOS POR CADA MODULO
        
        $vars["dataUser"] = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $this->view->show($this->url, $vars);
    }
    
    public function testView()
    {
        $vars['nombre'] = "Federico";
        $vars['lugar'] = $this->getLugar();
        $this->view->show("test.php", $vars);
    }
    
    private function getLugar()
    {
        return "Buenos Aires, Argentina";
    }
}
?>