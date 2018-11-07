<?php

class ValoracionModel extends ModelBase {

    private $table = "valoracion";
    private $idTable = "id";
    
    /**
     * Consulta todos los valoracions registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listValoracion( $busqueda = "WHERE 1" , $order = "false" ) {                
        //realizamos la consulta de todos los valoracions
        if( $order == "false")
            $consulta = $this->db->prepare('SELECT '.$this->table.'.*,desempeno.nombre_desempeno AS desempeno,desempeno.id AS id_desempeno FROM '.$this->table.' INNER JOIN desempeno ON desempeno.id = '.$this->table.'.desempeno '.$busqueda);
        else
            $consulta = $this->db->prepare('SELECT '.$this->table.'.*,desempeno.nombre_desempeno AS desempeno,desempeno.id AS id_desempeno FROM '.$this->table.' INNER JOIN desempeno ON desempeno.id = '.$this->table.'.desempeno '.$busqueda.' ORDER BY '.$order);
        
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
     * Consulta todos los valoracions registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los valoracions
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el valoracion que el valoracion
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delValoracion( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el valoracion
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el valoracion se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmValoracion( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los valoracions
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $valoracion = $consulta->fetch();
        if( count($valoracion) > 1 )
            return true;
        else
            return false;
    }
    
    /**
     * Crea en el sistema el valoracion
     * inscrito por el valoracion
     * @param $array array() 
     * @return $id int
     */
    public function newValoracion( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el valoracion
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el valoracion
     * elegido por el valoracion
     * @param $array array() 
     * @return $id int
     */
    public function modValoracion( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el valoracion existe
        if( $this->confirmValoracion($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el valoracion        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el valoracion solicitador por
     * el valoracion y se retorna en un array
     * @param $id int 
     * @return $valoracion array
     */
    public function consultValoracion( $id ) {
        //realizamos la consulta de todos los valoracions
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $valoracion = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $valoracion;        
    }
    
    
    public function consultValoracionWhere( $where ) {
        //realizamos la consulta de todos los valoracions        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $valoracion = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $valoracion;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de valoracion
     * @param $id int 
     */
    public function estructuraValoracion() {
        
        $array = array();

        //realizamos la consulta de todos los valoracions
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