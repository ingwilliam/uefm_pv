<?php

class UsuarioModel {

    protected $db;

    public function __construct() {
        //Traemos la unica instancia de PDO
        $this->db = SPDO::singleton();
    }

    public function consultRegistroSql($sql) {
        return $this->db->consultRegistroSql($sql);        
    }
    
    public function listArraySql($sql) {
        return $this->db->listArraySql( $sql , "id");        
    }

    public function thisdb() {
        return $this->db;        
    }
    
    public function confirmMatriculaWhere( $where ) {
        //realizamos la consulta de todos los Persona
        $consulta = $this->db->prepare('SELECT * FROM usuario WHERE '.$where );                 
        $consulta->execute();
        $Persona = $consulta->fetch();
        if( count($Persona) > 1 )
            return true;
        else
            return false;
    }
    
    public function confirmEstudiante( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los usuarios
        $consulta = $this->db->prepare('SELECT * FROM usuario WHERE id = "'.$id.'"');                 
        $consulta->execute();
        $estudiante = $consulta->fetch();
        if( count($estudiante) > 1 )
            return true;
        else
            return false;
    }
    
    public function modUsuario( $array ) {
        //condicion para modificar
        $condicion = "id = '".$array["id"]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update("usuario", $array , $condicion);                 
        //confirmamos si realmente el usuario existe
        if( $this->confirmUsuario($array["id"]) )        
        {
            //realizamos la consulta para modificar el usuario        
            $this->db->exec($consulta);
            
            return $array["id"];
        }
        else
            return 0;
                
    }
    
    public function confirmUsuarioWhere( $where ) {
        //realizamos la consulta de todos los Persona
        $consulta = $this->db->prepare('SELECT * FROM usuario WHERE '.$where );                 
        $consulta->execute();
        $Persona = $consulta->fetch();
        if( count($Persona) > 1 )
            return true;
        else
            return false;
    }
    
    public function newUsuario( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert("usuario",$array);                 
        //realizamos la consulta para insertar el usuario
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    public function ejecutaSql($sql) {
        $this->db->exec($sql);        
    }
    
    public function confirmUsuario( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los usuarios
        $consulta = $this->db->prepare('SELECT * FROM usuario WHERE id = "'.$id.'"');                 
        $consulta->execute();
        $usuario = $consulta->fetch();
        if( count($usuario) > 1 )
            return true;
        else
            return false;
    }
    
    public function consultUsuarioWhere( $where ) {
        //realizamos la consulta de todos los matriculas
        $consulta = $this->db->prepare('SELECT * FROM usuario WHERE '.$where);                 
        $consulta->execute();
        $matricula = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $matricula;        
    }
    
}

?>