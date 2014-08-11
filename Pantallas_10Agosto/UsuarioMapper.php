<?php
class UsuarioMapper extends MapperBD{
    
    function __construct(){
        parent::__construct(); 
         
        $this->selectStmt = $this->PDO->prepare(
			"SELECT * FROM tbl_usuarios INNER JOIN tbl_rol_usuario USING(id_usuario) WHERE email = :email and clave = :password"); 
     
    }
	
		public function buscarporemail($login){
		$this->selectStmt->execute(array(
		'email'=>$login->getemail(),
		'password'=>$login->getpassword()));
		if($row= $this->selectStmt->fetch()){
		return true;
		}else{
		return false;
	}
	}
		
		public function getUsuario($login){
		$this->selectStmt->execute(array(
		'email'=>$login->getemail(),
		'password'=>$login->getpassword()));
		if($obj = $this->selectStmt->fetch(PDO::FETCH_OBJ))
		return $obj;
		else return null;
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