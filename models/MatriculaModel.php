<?php

class MatriculaModel {

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
        $consulta = $this->db->prepare('SELECT * FROM matricula WHERE '.$where );                 
        $consulta->execute();
        $Persona = $consulta->fetch();
        if( count($Persona) > 1 )
            return true;
        else
            return false;
    }
    
    public function newMatricula( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert("matricula",$array);                 
        //realizamos la consulta para insertar el matricula
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    public function consultMatricula( $id ) {
        //realizamos la consulta de todos los matriculas
        $consulta = $this->db->prepare('SELECT * FROM matricula WHERE id = "'.$id.'"');                 
        $consulta->execute();
        $matricula = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $matricula;        
    }
    
}
?>