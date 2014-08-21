<?php 
require('CargadorClases.php');
if(!isset($_SESSION["user_name"]))
{
	header("Location:index.php");
	exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Osly Salinas">
    <link rel="icon" href="mp_ico.ico">
    <title>Sistema de Reportes MP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">  
</head>

<body>
      <div class="login"> 
      <form class="form-signin" role="form">
        <input type="email" class="form-control" placeholder="Email" required>
        <input type="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-primary btn-block" type="submit">Ingresar</button>  
      </form>
</div>
  
  <h1 class="logo"><a href="index.html"></a></h1>
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
       <!-- <a href="#" class="navbar-brand">Inventario</a> -->
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Inicio</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Parametros <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="#">Regiones</a></li>
                    <li><a href="#">Oficinas</a></li>
                    <li><a href="#">Departamentos</a></li>    
                    <li class="divider"></li>
                    <li><a href="#">Otros</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Reportes <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="reportes_presupuesto.html">Presupuesto</a></li>
                    <li><a href="reportes_cheques.html">Cheques</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Otros</a></li>
                </ul>
            </li>
  
            <li><a href="http://www.mp.hn/">Acerca de Ministerio Publico</a></li>
        </ul>
     
    </div>
</nav>

</div>
<form action="reportes_presupuesto.html">
<div><div style="width:20%;"><a href="guardar_excell.php">Exportar a excell</a></div></div>
<div class="table-responsive">
    <table id="tabla" class="table table-striped"  >
        <thead>
        <tr>
            <th>Codigo</th>
            <th>No. Identidad</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cargo</th>
            <th>Codigo Departamento</th>
            <th>Departamento</th>
            <th>Referencia</th>
            <th>Banco</th>
            <th>Cheque</th>
            <th>Planilla</th>
            <th>Codigo Ingreso</th>
            <th>Valor Ingreso</th> 
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>

        </tr>
        <tr>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>

        </tr>
        <tr>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>
            <td>Hola</td>

        </tr>
        </tbody>
    </table>

</div>
</form>

 <!-- Site footer -->
      <div class="footer">
        <h5><strong>Grupo CESA Hondura S. A.</strong> &copy; 2014 Todos los derechos reservados</h5>
      </div> 
    <br>
    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
</body>
</html>
