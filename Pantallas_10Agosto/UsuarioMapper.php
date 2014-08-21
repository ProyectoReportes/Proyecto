<?php

class UsuarioMapper extends MapperBD{
    
    function __construct()
    {
        parent::__construct(); 
              
    }
	
	public function buscarporemail($login)
	{
			
		$result = mssql_query("exec sp_login '".$login->getemail()."', '".$login->getpassword()."'", $this->conexion);

		if($fila = mssql_fetch_assoc($result))
		{
			return $fila;
		}
		else
		{
			return null;
		}	
	}

    
	function buscarPorId($id){
		throw new Exception("Error metodo no implementado");
	}
   function insertar($obj){
       throw new Exception("Error metodo no implementado");
   }
   function buscarTodos(){
       throw new Exception("Error metodo no implementado");
   }
   function actualizar($obj){
       throw new Exception("Error metodo no implementado");
   }
    function borrar($obj){
       throw new Exception("Error metodo no implementado");
   }
   
}
?>
