<?php
		    if(!isset($_SESSION['user_name'])){
			
	echo<<<"EOT"
			
	 <div class="login"> 
      <form class="form-signin" role="form" id="login" name="login" action="index.php" method="post">
        <input type="email" class="form-control"  name="email" id="email" placeholder="Email" required>
        <input type="password" class="form-control"  name="password" id="password" placeholder="Password" required>
        <button class="btn btn-primary btn-block" type="submit">Ingresar</button>  
      </form>
</div>

EOT;

		}		
			if(isset($_SESSION['user_name'])){
	echo<<<"EL"
           <div class="welcome">   
	   <ul class="nav nav-pills">
	   <li><a class="btn btn-default disabled" href="#">Conectado como {$_SESSION["user_name"]} </a></li>
	   <li class="active"><a href="index.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
	   </ul>
	   </div>
			
EL;

}

?>
