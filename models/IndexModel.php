<?php

class IndexModel {

    protected $db;

    public function __construct() {
        //Traemos la unica instancia de PDO
        $this->db = SPDO::singleton();
    }

    public function redesSociales() {
        return $this->db->listArray( "banner" , "id", "publicar = 'S' AND ubicacion = 'RedesSociales' AND acceso = 'Publico'" , "orden" );
    }
    
    public function menuSuperior() {
        return $this->db->listArray( "seccion" , "id", "publicar = 'S' AND ubicacion = 'Menu' AND acceso = 'Publico'" , "orden DESC" );
    }
    
    public function bannerPrincipal () {
        return $this->db->listArray( "banner" , "id", "publicar = 'S' AND ubicacion = 'Principal' AND acceso = 'Publico'" , "orden" );
    }
    
    public function articuloMenu () {
        return $this->db->listArray( "articulo" , "id", "publicar = 'S' AND destacado_home_dos = 'S' AND acceso = 'Publico'" , "orden" );
    }
    
    public function eventosHome () {
        return $this->db->listArray( "evento" , "id", "destacado  = 'S'" , "fecha_inicio LIMIT 4" );
    }
    
    public function arrayLogo() {
        return $this->db->consultRegistroSql("SELECT * FROM banner WHERE publicar = 'S' AND ubicacion = 'Logo' AND acceso = 'Publico'");        
    }
    
    public function listArraySql($sql) {
        return $this->db->listArraySql( $sql , "id");        
    }

    public function thisdb() {
        return $this->db;        
    }
    
}

?>