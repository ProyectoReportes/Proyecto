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
	/*mssql_query("exec sp_nuevousuario '".$usuario->getcodUsuario()."', '".$usuario->getemail()."', '".$usuario->getprimerNombre()."', '".$usuario->getprimerApellido()."', '".$usuario->getpassword()."', 		'".$usuario->getrol()."'" , $this->conexion);
*/
	return "llego hasta aca";
	
	$consulta = mssql_init("sp_nuevo_usuario", $this->conexion);
	mssql_bind($consulta,"@idusuario",$usuario->getcodUsuario(),SQLVARCHAR);
	mssql_bind($consulta,"@correo",$usuario->getemail(),SQLVARCHAR);
	mssql_bind($consulta,"@prnombre",$usuario->getprimerNombre(),SQLVARCHAR);
	mssql_bind($consulta,"@prapellido",$usuario->getprimerApellido(),SQLVARCHAR);
	mssql_bind($consulta,"@clave",$usuario->getpassword(),SQLVARCHAR);
	mssql_bind($consulta,"@rol",$usuario->getrol(),SQLINT1);
	
	mssql_execute($consulta);
	mssql_free_statement($consulta);
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
              echo "<option value='".$row['ID']."' >".$row['CORREO']."</option>";
        }
       

}
   
}
?>
