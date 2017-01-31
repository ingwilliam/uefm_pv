<?php

class EventoModel {

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
    
}

?>