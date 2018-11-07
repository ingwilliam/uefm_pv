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
        $data['formXhtml'] = new Xhtml();

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

        $arrayRegistro["tipo_documento"] = $_GET["tipo_documento"];
        $arrayRegistro["numero_documento"] = $_GET["numero_documento"];

        //Le pedimos al modelo todos los items
        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();
        $data['redesSociales'] = $indexModel->redesSociales();
        $data['menuSuperior'] = $indexModel->menuSuperior();
        $data['bannerPrincipal'] = $indexModel->bannerPrincipal();
        $data['eventosHome'] = $indexModel->eventosHome();
        $data['arrayLogo'] = $indexModel->arrayLogo();
        $data['articuloMenu'] = $indexModel->articuloMenu();
        $data['matriculas'] = $matriculaModel->consultRegistroSql("
                                                                   SELECT matricula.*,usuario.primer_nombre,usuario.segundo_nombre,usuario.primer_apellido,usuario.segundo_apellido,usuario.fecha_nacimiento,usuario.ciudad_nacimiento,usuario.genero,usuario.rh,curso.nombre as curso_nombre FROM matricula
                                                                   INNER JOIN usuario ON usuario.id=matricula.estudiante
                                                                   INNER JOIN curso ON curso.id=matricula.curso
                                                                   WHERE 
                                                                   matricula.activo = true AND matricula.tipo_documento = '" . $_GET["tipo_documento"] . "' AND matricula.numero_documento = '" . $_GET["numero_documento"] . "' ORDER BY matricula.anio DESC LIMIT 1;");
        $data['matricula_actual'] = $matriculaModel->consultRegistroSql("SELECT * FROM matricula WHERE activo = true AND tipo_documento = '" . $_GET["tipo_documento"] . "' AND numero_documento = '" . $_GET["numero_documento"] . "' AND anio = '" . $_GET["anio"] . "'");
        if (count($data['matricula_actual']) <= 1) {
            $data['matricula_actual'] = $arrayRegistro;
        }
        $data['formXhtml'] = new Xhtml();

        //Finalmente presentamos nuestra plantilla
        $this->view->show("matricula.php", $data);
    }
    
    public function verifica_matricula() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/MatriculaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $matriculaModel = new MatriculaModel();

        $anio = $_POST["anio"];
        
        echo $matriculaModel->confirmMatriculaWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "' AND anio = '" . $anio . "'");
    }
    
    public function verifica_usuario() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/UsuarioModel.php';
        
        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuarioModel = new UsuarioModel();
        
        echo $usuarioModel->confirmUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'");
    }
    
    public function verifica_email() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/UsuarioModel.php';
        
        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuarioModel = new UsuarioModel();
        
        echo $usuarioModel->confirmUsuarioWhere("usuario = '" . $_POST["email"] . "'");
    }
    
    public function buscar_padre() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/UsuarioModel.php';
        
        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuarioModel = new UsuarioModel();
        
        $array_padre = $usuarioModel->consultUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'");
        
        if(count($array_padre)<=1)
        {
            echo 1;
        }
        else
        {
            print_r(json_encode($array_padre));
        }        
    }

    public function registrar() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'models/MatriculaModel.php';
        require 'models/UsuarioModel.php';

        
        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $matriculaModel = new MatriculaModel();
        $usuarioModel = new UsuarioModel();

        $formXhtml = new Xhtml();
        if ($matriculaModel->confirmMatriculaWhere("anio = '" . $_POST["anio"] . "' AND numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'")) {
            $anio = date("Y");
            $formXhtml->alert("Los campos de identificacion (Año, Tipo de documento y Numero de documento) ya se encuentra en la base de datos, este estudiante ya esta matriculado para este año (" . $anio . ")");
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
            exit;
        } else {
            
            //VERIFICO USUARIO SI EXISTE PARA CREAR O ASOCIAR A LA NUEVA MATRICULA
            if (!$usuarioModel->confirmEstudiante($_POST["estudiante"])) {
                if (!$usuarioModel->confirmUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'")) {
                    
                    //CREO EL USUARIO DEL ESTUDIANTE NUEVO
                    $_POST["usuario"] = strtolower($_POST["primer_nombre"][0] . $_POST["segundo_nombre"][0] . $_POST["primer_apellido"] . $_POST["segundo_apellido"][0] . "@colegioelfuturo.edu.co");
                    $_POST["clave"] = sha1($_POST["numero_documento"]);
                    $_POST["fecha_crear"] = date("Y-m-d H:i:s");
                    $_POST["usuario_crear"] = 1;
                    $_POST["activo"] = 1;
                    $_POST["estudiante"] = $usuarioModel->newUsuario($_POST); 
                    
                    //CREO EL PERFIL DE CADA USUARIO
                    $usuarioModel->ejecutaSql("INSERT INTO usuario_perfil(perfil, usuario) VALUES ('5','" . $_POST["estudiante"] . "')");
                    
                } else {
                    $formXhtml->alert("Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la base de datos");            
                    $formXhtml->location("index.php?controlador=Matricula&accion=verificar&numero_documento=".$_POST["numero_documento"]."&tipo_documento=".$_POST["tipo_documento"]."&anio=".$_POST["anio"]);
                    exit;
                }
            }
            else
            {
                if (!$usuarioModel->confirmUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "' AND id<>'" . $_POST["estudiante"] . "'")) 
                {           
                            $id=$_POST["id"];
                            
                            $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                            $_POST["usuario_editar"] = 1;
                            $_POST["id"] = $_POST["estudiante"];
                            
                            $usuarioModel->modUsuario($_POST);
                            $_POST["id"] = $id;
                } else {
                    $formXhtml->alert("Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la base de datos");            
                    $formXhtml->location("index.php?controlador=Matricula&accion=verificar&numero_documento=".$_POST["numero_documento"]."&tipo_documento=".$_POST["tipo_documento"]."&anio=".$_POST["anio"]);
                    exit;                    
                }
            }
            
            //CREO LA MATRICULA DEL AÑO ACTUAL
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = 1;
            $_POST["activo"] = 1;
            $_POST["estado"] = "Inscrito";
            unset($_POST["id"]);
            $id_matricula = $matriculaModel->newMatricula($_POST);
            
            //VERIFICO PADRE YA ESTA EN LA BASE DE DATOS
            if ($usuarioModel->confirmUsuarioWhere("id = '" . $_POST["id_padre"] . "'")) {
                $usuarioModel->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $id_matricula . "','" . $_POST["id_padre"] . "','Padre')");
            }
            else
            {    
                //VERIFICO SI EL USUARIO DEL PADRE EXISTE
                if (!$usuarioModel->confirmUsuarioWhere("numero_documento = '" . $_POST["padre"]["numero_documento"] . "' AND tipo_documento = '" . $_POST["padre"]["tipo_documento"] . "'")) {
                    if (!$usuarioModel->confirmUsuarioWhere("usuario = '" . $_POST["padre"]["email"] . "'")) {
                        $_POST["padre"]["fecha_crear"] = date("Y-m-d H:i:s");
                        $_POST["padre"]["usuario_crear"] = 1;
                        $_POST["padre"]["clave"] = sha1($_POST["padre"]["numero_documento"]);
                        $_POST["padre"]["activo"] = 1;
                        $_POST["padre"]["usuario"] = $_POST["padre"]["email"];
                        $id_padre = $usuarioModel->newUsuario($_POST["padre"]);
                        $usuarioModel->ejecutaSql("INSERT INTO usuario_perfil(perfil, usuario) VALUES ('6','" . $id_padre . "')");
                        $usuarioModel->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $id_matricula . "','" . $id_padre . "','Padre')");                    
                    } else {
                        $formXhtml->alert("El campo (email) del padre de familia que intenta ingresar ya se encuentra en la base de datos de acudientes");                                
                        $formXhtml->location("index.php?controlador=Matricula&accion=verificar&numero_documento=".$_POST["numero_documento"]."&tipo_documento=".$_POST["tipo_documento"]."&anio=".$_POST["anio"]);
                        exit;
                    }
                } else {
                    $acudiente_padre=$usuarioModel->consultUsuarioWhere("numero_documento = '" . $_POST["padre"]["numero_documento"] . "' AND tipo_documento = '" . $_POST["padre"]["tipo_documento"] . "'");
                    $usuarioModel->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $id_matricula . "','" . $acudiente_padre["id"] . "','Padre')");                    
                }
            }
            
            //VERIFICO PADRE YA ESTA EN LA BASE DE DATOS
            if ($usuarioModel->confirmUsuarioWhere("id = '" . $_POST["id_acudiente"] . "'")) {
                $usuarioModel->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $id_matricula . "','" . $_POST["id_acudiente"] . "','Acudiente')");
            }
            else
            {
                //VERIFICO SI EL USUARIO DE ACUDIENTE EXISTE
                if (!$usuarioModel->confirmUsuarioWhere("numero_documento = '" . $_POST["acudiente"]["numero_documento"] . "' AND tipo_documento = '" . $_POST["acudiente"]["tipo_documento"] . "'")) {
                    if (!$usuarioModel->confirmUsuarioWhere("usuario = '" . $_POST["acudiente"]["email"] . "'")) {
                        $_POST["acudiente"]["fecha_crear"] = date("Y-m-d H:i:s");
                        $_POST["acudiente"]["usuario_crear"] = 1;
                        $_POST["acudiente"]["clave"] = sha1($_POST["acudiente"]["numero_documento"]);
                        $_POST["acudiente"]["activo"] = 1;
                        $_POST["acudiente"]["usuario"] = $_POST["acudiente"]["email"];
                        $id_acudiente = $usuarioModel->newUsuario($_POST["acudiente"]);
                        $usuarioModel->ejecutaSql("INSERT INTO usuario_perfil(perfil, usuario) VALUES ('6','" . $id_acudiente . "')");
                        $usuarioModel->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $id_matricula . "','" . $id_acudiente . "','Acudiente')");                    
                    } else {
                        $formXhtml->alert("El campo (email) del acudiente de familia que intenta ingresar ya se encuentra en la base de datos de acudientes");                                
                        $formXhtml->location("index.php?controlador=Matricula&accion=verificar&numero_documento=".$_POST["numero_documento"]."&tipo_documento=".$_POST["tipo_documento"]."&anio=".$_POST["anio"]);
                        exit;
                    }
                } else {
                    $acudiente_acudiente=$usuarioModel->consultUsuarioWhere("numero_documento = '" . $_POST["acudiente"]["numero_documento"] . "' AND tipo_documento = '" . $_POST["acudiente"]["tipo_documento"] . "'");
                    $usuarioModel->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $id_matricula . "','" . $acudiente_acudiente["id"] . "','Padre')");
                }
            }
        
        $anio = date("Y");
        
        $formXhtml->alert("Felicitaciones su registro de matricula esta en estado Inscrito para el año (" . $anio . ")");                                                
        $formXhtml->location("index.php?controlador=Matricula&accion=verificar&numero_documento=".$_POST["numero_documento"]."&tipo_documento=".$_POST["tipo_documento"]."&anio=".$_POST["anio"]);
        exit;
        }
                        
    }

}

?>
