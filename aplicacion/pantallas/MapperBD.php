<?php
abstract class MapperBD {

    protected $PDO;
   
    protected $errorDesc;
    protected $selectStmt;
    protected $insertStmt;
    protected $updateStmt;
    protected $deleteStmt;

    
    function __construct(){
        if(!isset($PDO)){
            $this->PDO = Registro::$PDO;
	    $this->errorDesc = Registro::$errorDesc;
        }
    }
  
	abstract function buscarPorId($id);
    abstract function buscarTodos();
    abstract function insertar($obj);
    abstract function actualizar($obj);
    abstract function borrar($obj);
    
}
?>
