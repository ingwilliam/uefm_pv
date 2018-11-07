<?php

class GastoRetiroModel extends ModelBase {

    private $table = "gasto_retiro";
    private $idTable = "id";
    
    /**
     * Consulta todos los gasto_retiros registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listGastoRetiro( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los gasto_retiros
        if( $order == "false")
            $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' '.$busqueda);
        else
            $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' '.$busqueda.' ORDER BY '.$order);
        
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
     * Consulta todos los gasto_retiros registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los gasto_retiros
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el gasto_retiro que el gasto_retiro
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delGastoRetiro( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el gasto_retiro
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el gasto_retiro se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmGastoRetiro( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los gasto_retiros
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $gasto_retiro = $consulta->fetch();
        if( count($gasto_retiro) > 1 )
            return true;
        else
            return false;
    }
    
    /**
     * Crea en el sistema el gasto_retiro
     * inscrito por el gasto_retiro
     * @param $array array() 
     * @return $id int
     */
    public function newGastoRetiro( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el gasto_retiro
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el gasto_retiro
     * elegido por el gasto_retiro
     * @param $array array() 
     * @return $id int
     */
    public function modGastoRetiro( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el gasto_retiro existe
        if( $this->confirmGastoRetiro($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el gasto_retiro        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el gasto_retiro solicitador por
     * el gasto_retiro y se retorna en un array
     * @param $id int 
     * @return $gasto_retiro array
     */
    public function consultGastoRetiro( $id ) {
        //realizamos la consulta de todos los gasto_retiros
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $gasto_retiro = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $gasto_retiro;        
    }
    
    
    public function consultGastoRetiroWhere( $where ) {
        //realizamos la consulta de todos los gasto_retiros        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $gasto_retiro = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $gasto_retiro;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de gasto_retiro
     * @param $id int 
     */
    public function estructuraGastoRetiro() {
        
        $array = array();

        //realizamos la consulta de todos los gasto_retiros
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
    
    public function ejecutaSqlArray($sql) {        
        //realizamos la consulta de todos los usuarios        
        $consulta = $this->db->prepare($sql);                 
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $usuario;
    }
    
}

?>