<?php 
	session_start();
	require('CargadorClases.php');

	if(!isset($_SESSION["user_name"]))
	{
		header("Location:index.php");
		exit;
	}
	if(isset($_POST["cheque"]))
	{
		$numCheque = $_POST["cheque"]; 
		$estado = $_POST["estado"];
		$reporte = new ReporteMapper();
		$reporte->entregarCheque($numCheque, $estado);
		echo  "accion completada";
	}



?>