<?php

class CargadorClases {

    static public function cargarClase($nombre) {
        require("$nombre.php");
	
    }
    
}

spl_autoload_register(__NAMESPACE__ .'\CargadorClases::cargarClase');

?>
