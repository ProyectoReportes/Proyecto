<?php

echo<<<"EOT"

<body>
<h1 class="logo"><a href="index.php"></a></h1>
  <h1 class="text-muted">Sistema de Reportes</h1>
  <br>
    
  <nav role="navigation" class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Inicio</a></li>

EOT;






if(isset($_SESSION['user_name'])){
    echo<<<"ELL"
    
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Reportes <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="reporte_cuenta_presupuestaria.php">Empleados Cuenta Presupuestaria</a></li>
                    <li><a href="reporte_ingreso_empleados.php">Ingresos de Empleados</a></li>
                    <li><a href="reporte_deduccion_empleados.php">Deducciones de Empleados</a></li>
                    <li><a href="reporte_presupuestario_programa.php">Presupuestario por Programa</a></li>
                    <li><a href="reporte_presupuestario_grupo.php">Presupuestario por Grupo</a></li>
                    <li><a href="reporte_presupuestario_subgrupo.php">Presupuestario por Sub-Grupo</a></li>
                    <li class="divider"></li>
                    <li><a href="reporte_presupuesto_original.php">Presupuesto Original</a></li>
                    <li><a href="reporte_detalle_transacciones.php">Detalle de Transacciones</a></li>
                </ul>
            </li>
                  
ELL;

}

 if(isset($_SESSION['user_name'])){
	    if($_SESSION["user_rol"]=="1"){
		echo<<<"EOT"
            <li><a href="usuarios.php">Usuarios</a></li>
EOT;

	    }
	    }
      
      if(!isset($_SESSION['user_name'])){
      
  echo<<<"EOT"
            <li><a href="http://www.mp.hn/">Acerca de Ministerio Publico</a></li>

EOT;


    }


    echo<<<"ELL"

    </ul>
       </div>
     </nav>

ELL;

?>            
