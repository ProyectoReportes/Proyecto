<?php
class usuario{
    private $email;
    private $password;
    private $codUsuario;
    private $primerNombre;
    private $segundoNombre;
    private $primerApellido;
    private $segundoApellido;
    private $rol;


    function __construct($id, $e, $pN, $pA, $p, $r){
	$this->codUsuario = $id;       
	$this->email = $e;
	$this->primerNombre = $pN;
	$this->primerApellido = $pA;
	$this->password= $p;
	$this->rol = $r;
    }
    
    function getemail(){
        return $this->email;
    }
    
    function getpassword(){
        return $this->password;
    }

function getcodUsuario(){
        return $this->codUsuario;
    }
    
    function getprimerNombre(){
        return $this->primerNombre;
    }

function getsegundoNombre(){
        return $this->segundoNombre;
    }
    
    function getprimerApellido(){
        return $this->primerApellido;
    }

function getsegundoApellido(){
        return $this->segundoApellido;
    }
    
    function getrol(){
        return $this->rol;
    }

}
?>
