<?php

class PlaneacionController extends ControllerBase {

    private $url = "planeacion.php";
    private $modelo = "models/PlaneacionModel.php";
    private $table = "planeacion";
    private $id = "id";
    private $pagina = "planeacion";

    //Accion index
    public function planeacion() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en planeacion en la busqueda
        $parametros_busqueda="&busqueda=".$_GET["busqueda"];
        $busqueda = "";
        if ($_GET) {
            $arrayRegistro = $_GET;
            $arrayRegistro[$this->id] = "";
            if ($_GET["busqueda"]) {
                unset($_GET["busqueda"]);
                $eliminaCaracter = false;
                foreach ($_GET as $clave => $valor) {
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" )&& ($clave != "max" )&& ($clave != "item" )) {
                        if ($valor) {
                            $eliminaCaracter = true;
                            if ( $clave == "nombre" )
                                $busqueda = $busqueda . " $this->table.$clave LIKE '%" . $valor . "%' AND";
                            else
                                $busqueda = $busqueda . " $this->table.$clave = '" . $valor . "' AND";
                        }
                    }
                }
                if ($eliminaCaracter)
                    $busqueda = " where " . substr($busqueda, 0, strlen($busqueda) - 3);
            }
        }
        else {
            $arrayRegistro = $Planeacion->estructuraPlaneacion();
        }

        
        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id"=>$_GET["id"],"activo"=>"1");                   
                    $Planeacion->modPlaneacion($array);
                }
                else
                {
                    $array = array("id"=>$_GET["id"],"activo"=>"0");                   
                    $Planeacion->modPlaneacion($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }
        
        //Consulta sql del modulo
        $sql = "SELECT v.nombre_valoracion,pe.periodo,pe.anio,m.nombre AS meta,d.nombre_desempeno,a.nombre AS asignatura,c.nombre AS curso_nombre,p.* FROM $this->table AS p
                INNER JOIN plan_estudio AS pe ON pe.id = p.plan_estudio
                INNER JOIN meta AS m ON m.id = p.meta
                INNER JOIN desempeno AS d ON d.id = p.desempeno
                INNER JOIN asignatura AS a ON a.id = pe.asignatura
                INNER JOIN curso AS c ON c.id = p.curso
                INNER JOIN valoracion AS v ON v.id = p.valoracion
                ";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY p.fecha_evaluacion";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Cramos el paginador
        $paginador = new PHPPaging($modulo->thisdb());
        $paginador->param = "&controlador=Planeacion&accion=planeacion".$parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 50);
        
        $sql = $sql." LIMIT $paginador->start_row, $paginador->max_rows";
        
        $consulta = $modulo->listarPaginador($sql);        
        $arrayPaginador = array();        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
                $arrayPaginador[] = $registro;            
        }
        
        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['paginador'] = $paginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    //Accion index
    public function nuevo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $modulo = new ModuloModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        $arrayRegistro = $Planeacion->estructuraPlaneacion();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Nuevo";
        $vars['accion'] = "nuevo";
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function nuevoRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/MetaModel.php";
        require "models/DesempenoModel.php";
        require "models/ValoracionModel.php";
        
        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $Meta = new MetaModel();
        $Desempeno = new DesempenoModel();
        $Valoracion = new ValoracionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del planeacion
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
               
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $array_ids = explode("-", $_POST["plan_estudio"]);
            $_POST["plan_estudio"] = $array_ids[0];
            $_POST["curso"] = $array_ids[1];
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];
            $_POST["activo"] = 1;            
            $id = $Planeacion->newPlaneacion($_POST);
            $arrayRegistro = $Planeacion->consultPlaneacion($id);
            $arrayRegistro["plan_estudio"]=$arrayRegistro["plan_estudio"]."-".$arrayRegistro["curso"];
            $vars['alerta'] = 1;
            $vars['accion'] = "editar";
            
            $arrayMeta = $Meta->consultMeta($arrayRegistro["meta"]);
            $arrayDesempeno = $Desempeno->consultDesempeno($arrayRegistro["desempeno"]);
            $arrayValoracion = $Valoracion->consultValoracion($arrayRegistro["valoracion"]);
            
            $vars['arrayMeta'] = $arrayMeta;
            $vars['arrayDesempeno'] = $arrayDesempeno;
            $vars['arrayValoracion'] = $arrayValoracion;

            
        } else {
            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
            $vars['alerta'] = 3;
            $vars['accion'] = "listar";
        }
        
        $vars['accionDocumento'] = "nuevo";        
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Editar";        
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function editarRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/MetaModel.php";
        require "models/DesempenoModel.php";
        require "models/ValoracionModel.php";
        
        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $Meta = new MetaModel();
        $Desempeno = new DesempenoModel();
        $Valoracion = new ValoracionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        
        //Creamos el array para el formulario del planeacion
        if (isset($_GET["id"]))
            $id=$_GET["id"];
        else
            $id=$_POST["id"];

        if ($Planeacion->confirmPlaneacion($id)) {            
            $arrayRegistro = $Planeacion->consultPlaneacion($id);
            $arrayRegistro["plan_estudio"]=$arrayRegistro["plan_estudio"]."-".$arrayRegistro["curso"];                        
            $arrayMeta = $Meta->consultMeta($arrayRegistro["meta"]);
            $arrayDesempeno = $Desempeno->consultDesempeno($arrayRegistro["desempeno"]);
            $arrayValoracion = $Valoracion->consultValoracion($arrayRegistro["valoracion"]);
            
            if (!isset($_GET["id"]))
            {
                if (in_array("1", $arrayPermiso)==true||in_array("2", $arrayPermiso)==true) {
                    $array_ids = explode("-", $_POST["plan_estudio"]);
                    $_POST["plan_estudio"] = $array_ids[0];
                    $_POST["curso"] = $array_ids[1];                    
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    $Planeacion->modPlaneacion($_POST);                
                    $arrayRegistro = $Planeacion->consultPlaneacion($id);
                    $arrayRegistro["plan_estudio"]=$arrayRegistro["plan_estudio"]."-".$arrayRegistro["curso"];                    
                    $vars['alerta'] = 2;
                }
                else
                {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }
            }
            
            $vars['arrayMeta'] = $arrayMeta;
            $vars['arrayDesempeno'] = $arrayDesempeno;
            $vars['arrayValoracion'] = $arrayValoracion;
            
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";        
            $vars['accion'] = "editar";        
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Planeacion&accion=planeacion");
        }
        
    }
    
    public function selectMetas(){
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del planeacion
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
               
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            echo $sql="SELECT
                    *
                  FROM meta 
                  WHERE plan_estudio = '".$_POST["id"]."' AND activo=1
                  ORDER BY nombre
                  ";
            $arrayselect = $Planeacion->listArraySql($sql, "id");
            $select = "<option value=''>:: Seleccione ::</option>";
            if( count($arrayselect) > 0 )
            {                
                foreach( $arrayselect as $clave => $valor )
                {
                    $select = $select."<option value='".$valor["id"]."'>".$valor["nombre"]."</option>";                    
                }                             
                
            } 
            
            echo $select;
        } else {
            echo "<option value=''>::No tiene permisos::</option>";
        }
    }
    
    public function selectDesempeno(){
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del planeacion
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
               
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $sql="SELECT
                    *
                  FROM desempeno 
                  WHERE plan_estudio = '".$_POST["id"]."' AND meta = '".$_POST["id2"]."' AND activo=1
                  ORDER BY nombre_desempeno
                  ";
            $arrayselect = $Planeacion->listArraySql($sql, "id");
            $select = "<option value=''>:: Seleccione ::</option>";
            if( count($arrayselect) > 0 )
            {                
                foreach( $arrayselect as $clave => $valor )
                {
                    $select = $select."<option value='".$valor["id"]."'>".$valor["nombre_desempeno"]."</option>";                    
                }                             
                
            } 
            
            echo $select;
        } else {
            echo "<option value=''>::No tiene permisos::</option>";
        }
    }
    
    public function selectValoracion(){
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Planeacion = new PlaneacionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del planeacion logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del planeacion
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
               
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $sql="SELECT
                    *
                  FROM valoracion 
                  WHERE plan_estudio = '".$_POST["id"]."' AND desempeno = '".$_POST["id2"]."' AND activo=1
                  ORDER BY nombre_valoracion
                  ";
            $arrayselect = $Planeacion->listArraySql($sql, "id");
            $select = "<option value=''>:: Seleccione ::</option>";
            if( count($arrayselect) > 0 )
            {                
                foreach( $arrayselect as $clave => $valor )
                {
                    $select = $select."<option value='".$valor["id"]."'>".$valor["nombre_valoracion"]."</option>";                    
                }                             
                
            } 
            
            echo $select;
        } else {
            echo "<option value=''>::No tiene permisos::</option>";
        }
    }
}

?>