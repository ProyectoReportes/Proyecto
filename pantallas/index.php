<?php
require('CargadorClases.php');

session_start();
if(isset($_GET['logout'])){
    // Destruir todas las variables de sesión.
    $_SESSION = array();
    
    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finalmente, destruir la sesión.
    session_destroy();
}

   if($_POST && isset($_POST['email']) && trim($_POST['email']) !== '' && isset($_POST['password']) && trim($_POST['password']) !== ''
  ){
	$login = new usuario($_POST['email'],$_POST['password']);
	$usuariomapper=new UsuarioMapper();

	
	$user = $usuariomapper->buscarporemail($login);
					
			if($user !== null){

			    $user_name = $user["NOMBRE"];
				
			    $user_rol = $user["ROL"];
			    
			    switch($user_rol){
				case 1:
				    $user_rol = "Administrador";
				    break;
				case 2:
				    $user_rol = "Tecnologias de Informacion";
				    break;
				case 3:
				    $user_rol = "Contabilidad";
				    break;
				default:
				    $user_rol = " ";
			    }
			    $_SESSION["user_name"]= "{$user_name}";
			    $_SESSION["user_rol"]= $user->id_rol;
			}
    
}
require('Site_header.php');

require('Site_login.php');

require('Site_body.php');
?>


<div class="row">
<div class="col-xs-4">
        <img src="img/Logo MPdeHonduras 01.jpg" class="img-thumbnail" alt="Thumbnail Image">
    </div>
<div class="col-xs-8">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="img/banner1.png" alt="Primera slide">
        </div>
        <div class="item">
          <img src="img/banner2.png" alt="Segunda slide">
        </div>
        <div class="item">
          <img src="img/banner3.jpg" alt="Tercera slide">
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>
       
 <br><br>
      
 </div>  
 <br><br>

 <div class="panel panel-default">
  <div class="panel-body">
    Es el organismo independiente de los tres poderes del Estado, creado mediante Decreto Legislativo No 228-93, vigente desde el 6 de enero de 1994, su obligación ineludible es la investigación de los delitos y el ejercicio de la acción penal pública, la vigilancia en el cumplimiento exacto de la condena, así como la sujeción estricta del órgano jurisdiccional a la Constitución Pública y las leyes, constituyéndose en el representante, defensor y protector de los intereses generales de la sociedad y en auxiliar de los tribunales.
	<br><br>
	El Ministerio Público, es un organismo constitucional, independiente, que está al servicio de la sociedad y de la Administración de Justicia, defiende la legalidad, los intereses generales de la sociedad, la independencia de los órganos juridiccionales y la recta administración de justicia, fortaleciendo el Estado democrático, social de derecho.
	<br><br>
	Ser una Institución organizada, moderna y eficiente, que brinde un servivio de alta calidad a la sociedad hondureña y contribuya a mejorar la administración de justicia; integrado por fiscales, medicos forenses, funcionarios y profesionales con una cultura humanista, comprometidos con la institución, de solidos valores morales y éticos, elevada mística de trabajo y compromiso para enfrentar nuevos retos, que inspiren la confianza de la sociedad, el respeto del Estado y el orgullo institucional.
   
      </div>
  </div>

<?php
require('Site_footer.php');
?>
