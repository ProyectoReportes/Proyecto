<?php
/**
 * 
 */
class Registro {
    
    public static $PDO;
	
	function __construct() {

		try{
		    // Se envia en la cadena de conexion el charset=utf8, aunque ya la base de datos esté
		    // configurada con el charset utf8 y el collation igual a utf8_unicode_ci
            self::$PDO = new PDO('mysql:host=localhost;dbname=bdreportes;charset=utf8','root', '123');
        }catch(Exception $e){
            throw new Exception("Error al conectarse");
        } 
	}
	
    
}
?>
