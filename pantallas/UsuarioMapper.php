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


	public function insertarUsuario($usuario)
	{

	try{
	$consulta = mssql_init("sp_nuevousuario", $this->conexion);
	mssql_bind($consulta,"@idusuario",$usuario->getcodUsuario(),SQLVARCHAR);
	mssql_bind($consulta,"@correo",$usuario->getemail(),SQLVARCHAR);
	mssql_bind($consulta,"@prnombre",$usuario->getprimerNombre(),SQLVARCHAR);
	mssql_bind($consulta,"@prapellido",$usuario->getprimerApellido(),SQLVARCHAR);
	mssql_bind($consulta,"@clave",$usuario->getpassword(),SQLVARCHAR);
	mssql_bind($consulta,"@rol",$usuario->getrol(),SQLINT1);
	
	mssql_execute($consulta);
	mssql_free_statement($consulta);
        return "Proceso de Insercion: Correcto";
        }catch(Exception $ex){
            
            return "Proceso de Insercion: Incorrecto";
            
        }
        
	}

        public function eliminarUsuario($usuario)
	{

	try{
	$consulta = mssql_init("sp_eliminausuario", $this->conexion);
	mssql_bind($consulta,"@correo",$usuario->getemail(),SQLVARCHAR);
	
	mssql_execute($consulta);
	mssql_free_statement($consulta);
        return "Proceso de Eliminacion: Correcto";
        }catch(Exception $ex){
            
            return "Proceso de Eliminacion: Incorrecto";
            
        }
        
	}
        
        public function cambiarClaveUsuario($usuario)
	{

	try{
	$consulta = mssql_init("sp_reiniciaclave", $this->conexion);
	mssql_bind($consulta,"@correo",$usuario->getemail(),SQLVARCHAR);
	mssql_bind($consulta,"@clave",$usuario->getpassword(),SQLVARCHAR);
        
	mssql_execute($consulta);
	mssql_free_statement($consulta);
            return "Proceso de Actualizacion de Clave: Correcto";
        }catch(Exception $ex){
            
            return "Proceso de Actualizacion de Clave: Incorrecto";
            
        }
        
	}
        
  	 public function cargarRoles() {
         
		$result = mssql_query("exec sp_getroles", $this->conexion);
         
              echo " <option value= '' selected disabled>Rol</option>";
        while ($row = mssql_fetch_assoc($result)) {
              echo "<option value='".$row['ROL']."' >".$row['DESC']."</option>";
        }
        echo "</select>";
	}

	
	public function cargarUsuarios() {

		$result = mssql_query("exec sp_getusuarios", $this->conexion);

		    echo " <option value= '' selected disabled>Usuarios</option>";
        while ($row = mssql_fetch_assoc($result)) {
              echo "<option value='".$row['CORREO']."' >".$row['CORREO']."</option>";
        }
       

}
   
}
?>
