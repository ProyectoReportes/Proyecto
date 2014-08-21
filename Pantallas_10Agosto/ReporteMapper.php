<?php

class ReporteMapper extends MapperBD{
    
    function __construct()
    {
        parent::__construct(); 
              
    }

	function reporteIngresoEmpleados()
	{
		$result = mssql_query("exec sp_reporte_ingreso_empleados", $this->conexion);
		return $result;

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
