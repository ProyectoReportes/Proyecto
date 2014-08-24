<?php 
session_start();
require('CargadorClases.php');

if(!isset($_SESSION["user_name"]))
{
  header("Location:index.php");
  exit;
}

if($_POST 
			&& isset($_POST['inputId']) && trim($_POST['inputId']) !== ''
                        && isset($_POST['correo']) && trim($_POST['correo']) !== ''
			&& isset($_POST['primerNombre']) && trim($_POST['primerNombre']) !== ''
			&& isset($_POST['primerApellido']) && trim($_POST['primerApellido']) !== ''
			&& isset($_POST['password']) && trim($_POST['password']) !== ''    
			&& isset($_POST['rol']) && trim($_POST['rol']) !== '' 
  ){
    
$user= new usuario($_POST['inputId'], $_POST['correo'], $_POST['primerNombre'], $_POST['primerApellido'], $_POST['password'], $_POST['rol']);

$userMapper= new UsuarioMapper();
 
$mensaje = $userMapper->insertarUsuario($user);


  }elseif($_POST  //CAMBIAR CLAVE
                        && isset($_POST['usuarioCorreo']) && trim($_POST['usuarioCorreo']) !== ''
			&& isset($_POST['nuevaclave']) && trim($_POST['nuevaclave']) !== ''){
    //CAMBIAR CLAVE  
    
    $user= new usuario("", $_POST['usuarioCorreo'],"", "",$_POST['nuevaclave'], "");

    $userMapper= new UsuarioMapper();
 
    $mensaje = $userMapper->cambiarClaveUsuario($user);  
      
  }elseif($_POST && isset($_POST['usuario_eliminar']) && trim($_POST['usuario_eliminar']) !== ''){ //ELIMINAR
    //ELIMINAR
    
    $user= new usuario("", $_POST['usuario_eliminar'],"", "","", "");

    $userMapper= new UsuarioMapper();
 
    $mensaje = $userMapper->eliminarUsuario($user);
  }

  if(isset($mensaje))
  {
    require("modal.php");
  ?>
      <script type="text/javascript">cambiarTextoMensaje("<?php echo $mensaje ?>"); </script>
  <?php 

  }

require('Site_header.php');

require('Site_login.php');

require('Site_body.php');

?>

<div class="page-header">
    <h2>Usuarios</h2>    
</div>        
<br>
<div class="row">
<div class="col-xs-6">
    <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Creacion de Usuario</h3>
  </div>
  <div class="panel-body">
      <br>
                 <form class="form-horizontal" name="formulario" id="formulario" action="usuarios.php" method="POST">
     
    <div class="form-group">
        <label class="control-label col-xs-4" for="inputId">Codigo de Usuario:</label>
         <div class="col-xs-6">
            <input type="text" class="form-control" name="inputId" id="inputId" placeholder="Codigo del Usuario" required>
        </div>
    </div>
                     
      <div class="form-group">
        <label class="control-label col-xs-4" for="correo">Correo:</label>
         <div class="col-xs-6">
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electronico" required>
        </div>
    </div>         
                     
    <div class="form-group">
        <label class="control-label col-xs-4" for="primerNombre">Primer Nombre:</label>
         <div class="col-xs-6">
            <input type="text" class="form-control" name="primerNombre" id="primerNombre" placeholder="Primer Nombre" required>
        </div>
    </div>                
    
                     
    <div class="form-group">
        <label class="control-label col-xs-4" for="primerApellido">Primer Apellido:</label>
         <div class="col-xs-6">
            <input type="text" class="form-control" name="primerApellido" id="primerApellido" placeholder="Primer Apellido" required>
        </div>
    </div>                
    
       
                     
       <div class="form-group">
        <label class="control-label col-xs-4" for="password">Password:</label>
         <div class="col-xs-6">
            <input type="password" class="form-control" name="password" id="password" placeholder="***********" required>
        </div>
    </div> 
             
   

   <div class="form-group">
        <label class="control-label col-xs-4" for="rol">Rol:</label>
        <div class="col-xs-6">
            <select class="form-control" name="rol" id="rol">
               <?php
               $usuarioMapp = new UsuarioMapper();
               $usuarioMapp->cargarRoles();
               ?>
            </select>
        </div>
</div>
		
 
    <div class="form-group">
        <div class="col-xs-offset-8 col-xs-2">
            <input type="submit" id="submitUsuario" class="btn btn-primary" value="Enviar">		
	</div>
    </div>
   </form>
      
      
  </div>
</div>
    </div>
<div class="col-xs-6">
   <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Eliminar Usuario</h3>
  </div>
  <div class="panel-body">
   
      <br>
       <form class="form-horizontal" name="eliminar" id="eliminar" action="usuarios.php" method="POST">
           
        <div class="form-group">
        <label class="control-label col-xs-4" for="rol">Usuarios:</label>
        <div class="col-xs-6">
            <select class="form-control" name="usuario_eliminar" id="usuario_eliminar">
                <?php
                 $usuarioMapp->cargarUsuarios();
                ?>
                
            </select>
        </div>
        </div>
           
           <div class="form-group">
        <div class="col-xs-offset-8 col-xs-2">
            <input type="submit" id="eliminarUsuario" class="btn btn-primary" value="Eliminar">		
	</div>
    </div>
           
           
       </form>
       <br>
       <br>
      <br>
       <form class="form-horizontal" name="cambiarclave" id="cambiarclave" action="usuarios.php" method="POST">
        <div class="form-group">
        <label class="control-label col-xs-4" for="rol">Usuarios:</label>
        <div class="col-xs-6">
            <select class="form-control" name="usuarioCorreo" id="usuarioCorreo">
                <?php
                 $usuarioMapp->cargarUsuarios();
                ?>
                
            </select>
        </div>
        </div>
           
        <div class="form-group">
        <label class="control-label col-xs-4" for="inputId">Nuevo Password:</label>
         <div class="col-xs-6">
             <input type="password" class="form-control" name="nuevaclave" id="nuevaclave" placeholder="******" required>
        </div>
    </div>
           
           <div class="form-group">
        <label class="control-label col-xs-4" for="inputId">Confirmar Password:</label>
         <div class="col-xs-6">
             <input type="password" class="form-control" name="confirmclave" id="confirmclave" placeholder="******" required>
        </div>
    </div>
           
           <div class="form-group">
        <div class="col-xs-offset-7 col-xs-2">
            <input type="submit" id="cambiarclavesubmit" class="btn btn-primary" value="Cambiar Password" onclick="return validaClaves();">		
	</div>
    </div>
           
           
       </form>
      
  </div>
</div>
</div>
</div>
            
        
    
<?php

require('Site_footer.php');

?>   

<script type="text/javascript">
    function validaClaves(){
        var cl1 = document.getElementById("nuevaclave").value;
        var cl2 = document.getElementById("confirmclave").value;
        
        var soniguales=(cl1===cl2);
        
        if(!soniguales){
            alert("Las contraseñas deben ser iguales");
        }
        
        return soniguales;
    }
    
</script>