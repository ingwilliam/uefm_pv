<?php

class DesempenoModel extends ModelBase {

    private $table = "desempeno";
    private $idTable = "id";
    
    /**
     * Consulta todos los desempenos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listDesempeno( $busqueda = "WHERE 1" , $order = "false" ) {        
        //realizamos la consulta de todos los desempenos
        if( $order == "false")
            $consulta = $this->db->prepare('SELECT '.$this->table.'.*,meta.nombre AS meta,meta.id AS id_meta FROM '.$this->table.' INNER JOIN meta ON meta.id = '.$this->table.'.meta '.$busqueda);
        else
            $consulta = $this->db->prepare('SELECT '.$this->table.'.*,meta.nombre AS meta,meta.id AS id_meta  FROM '.$this->table.' INNER JOIN meta ON meta.id = '.$this->table.'.meta '.$busqueda.' ORDER BY '.$order);
        
        $consulta->execute();
        
        $arrayRegistro = array();
        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
                $arrayRegistro[$registro[$this->idTable]] = $registro;            
        }                
        //devolvemos la coleccion para que la vista la presente.
        return $arrayRegistro;
    }
    
    /**
     * Consulta todos los desempenos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los desempenos
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el desempeno que el desempeno
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delDesempeno( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el desempeno
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el desempeno se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmDesempeno( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los desempenos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $desempeno = $consulta->fetch();
        if( count($desempeno) > 1 )
            return true;
        else
            return false;
    }
    
    /**
     * Crea en el sistema el desempeno
     * inscrito por el desempeno
     * @param $array array() 
     * @return $id int
     */
    public function newDesempeno( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el desempeno
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el desempeno
     * elegido por el desempeno
     * @param $array array() 
     * @return $id int
     */
    public function modDesempeno( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el desempeno existe
        if( $this->confirmDesempeno($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el desempeno        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el desempeno solicitador por
     * el desempeno y se retorna en un array
     * @param $id int 
     * @return $desempeno array
     */
    public function consultDesempeno( $id ) {
        //realizamos la consulta de todos los desempenos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $desempeno = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $desempeno;        
    }
    
    
    public function consultDesempenoWhere( $where ) {
        //realizamos la consulta de todos los desempenos        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $desempeno = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $desempeno;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de desempeno
     * @param $id int 
     */
    public function estructuraDesempeno() {
        
        $array = array();

        //realizamos la consulta de todos los desempenos
        $estructura = $this->db->table_fields($this->table);                 
        
        foreach( $estructura as $clave => $valor )
        {
            $array[$valor] = "" ;
        }
        
        return $array;
    }
    
    public function listArraySql( $sql , $key , $consecutivo = false) {
        return $this->db->listArraySql($sql , $key , $consecutivo);
    }
    
    public function ejecutaSql($sql) {
        $this->db->exec($sql);        
    }
    
}

?>