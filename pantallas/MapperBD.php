<?php
abstract class MapperBD {
   protected $conexion;
    
    function __construct(){
        $this->conexion = mssql_connect("192.168.1.10","sa","emildaniel");
	$database = mssql_select_db("mpsiafireportes");
    }
}
?>
