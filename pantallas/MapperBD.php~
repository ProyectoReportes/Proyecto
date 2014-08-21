<?php
abstract class MapperBD {
   protected $conexion;
    protected $selectStmt;
    protected $insertStmt;
    protected $updateStmt;
    protected $deleteStmt;

    
    function __construct(){
        $this->conexion = mssql_connect("192.168.1.10","sa","emildaniel");
	$database = mssql_select_db("mpsiafireportes");
    }
  
	abstract function buscarPorId($id);
    abstract function buscarTodos();
    abstract function insertar($obj);
    abstract function actualizar($obj);
    abstract function borrar($obj);
    
}
?>
