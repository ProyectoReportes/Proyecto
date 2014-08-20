<?php
/**
 * 
 */
class Registro {
    
    public static $PDO;
	
	$cadenaMysql='mysql:host=localhost;dbname=bdreportes;charset=utf8';
	$cadenaMssql="dblib:dbname=mpsiafireportes;host=192.168.1.10";
	$usuario="sa";
	$clave="emildaniel";
	
	function __construct() {
		try{
		    // Se envia en la cadena de conexion el charset=utf8, aunque ya la base de datos esté
		    // configurada con el charset utf8 y el collation igual a utf8_unicode_ci
            self::$PDO = new PDO($cadenaMssql,$usuario, $clave);
        }catch(Exception $e){
            throw new Exception("Error al conectarse");
        } 
	}
	
    
}
?>
