<?php
require('CargadorClases.php');


$result = -1; 
$reporte = new ReporteMapper(); //objeto de la Rep_CtaPresupMapper para llamar las funciones

if(isset($_GET["est"]) && isset($_GET["carg"]) && isset($_GET["depto"]) && isset($_GET["cod_pre"]) && isset($_GET["ac_in"]) && isset($_GET["ac_fin"]) && isset($_GET["cont_in"]) && isset($_GET["cont_fin"]))
{
	if($_GET["carg"] != "" && $_GET["est"] == "" && $_GET["depto"] == "" &&  $_GET["cod_pre"] == "" && 		   $_GET["ac_in"] == "" && $_GET["ac_fin"]=="" && $_GET["cont_in"]=="" && $_GET["cont_fin"]=="")
	{
		$cargo = $_GET["carg"];
		$result = $reporte->filtrarPorCargo($cargo); 
		
	}
        else if($_GET["est"] != "" && $_GET["carg"] == "" && $_GET["depto"] == "" &&  $_GET["cod_pre"] == "" 		&& $_GET["ac_in"] == "" && $_GET["ac_fin"]=="" && $_GET["cont_in"]=="" && $_GET["cont_fin"]=="")
	{
		$est = $_GET["est"];
		$result = $reporte->filtrarPorEstado($est); 
		
	}
	else if($_GET["est"] == "" && $_GET["carg"] == "" && $_GET["depto"] != "" &&  $_GET["cod_pre"] == "" 		&& $_GET["ac_in"] == "" && $_GET["ac_fin"]=="" && $_GET["cont_in"]=="" && $_GET["cont_fin"]=="")
	{
		$dpto = $_GET["depto"];
		$result = $reporte->filtrarPorDpto($dpto); 
		
	}
	else if($_GET["est"] == "" && $_GET["carg"] == "" && $_GET["depto"] == "" &&  $_GET["cod_pre"] != "" 		&& $_GET["ac_in"] == "" && $_GET["ac_fin"]=="" && $_GET["cont_in"]=="" && $_GET["cont_fin"]=="")
	{
		$cp = $_GET["cod_pre"];
		$result = $reporte->filtrarPorCodPre($cp); 
		
	}
	else if($_GET["ac_in"]!= "" && $_GET["ac_fin"]!= "" && $_GET["est"] == "" && $_GET["carg"] == "" 
        && $_GET["depto"] == "" &&  $_GET["cod_pre"] == "" && $_GET["cont_in"]=="" && $_GET["cont_fin"]=="")
	{
		$aIn = $_GET["ac_in"];
		$aFin = $_GET["ac_fin"];
		$result = $reporte->filtrarPorAcuerdo($aIn,$aFin); 
		
	}
	else if($_GET["cont_in"]!= "" && $_GET["cont_fin"]!= "" && $_GET["est"] == "" && $_GET["carg"] == "" 
        && $_GET["depto"] == "" &&  $_GET["cod_pre"] == "" && $_GET["ac_in"] == "" && $_GET["ac_fin"]=="")
	{
		$aIn = $_GET["cont_in"];
		$aFin = $_GET["cont_fin"];
		$result = $reporte->filtrarPorContrato($aIn,$aFin); 
		
	}
	else if($_GET["cont_in"]== "" && $_GET["cont_fin"]== "" && $_GET["est"] == "" && $_GET["carg"] != "" 
        && $_GET["depto"] != "" &&  $_GET["cod_pre"] == "" && $_GET["ac_in"] == "" && $_GET["ac_fin"]=="")
	{
		$crg = $_GET["carg"];
		$dpt = $_GET["depto"];
		$result = $reporte->filtrarPorCargo_Dpto($crg,$dpt); 
		
	}
	else if($_GET["cont_in"]!= "" && $_GET["cont_fin"]!= "" && $_GET["ac_in"] != "" && $_GET["ac_fin"]!= 		"" && $_GET["est"] == "" && $_GET["carg"] == "" && $_GET["depto"] == "" &&  $_GET["cod_pre"] == "" )
	{
		$ain = $_GET["ac_in"];
		$afin = $_GET["ac_fin"];
		$cin = $_GET["cont_in"];
		$cfin = $_GET["cont_fin"];
		$result = $reporte->filtrarPorAcrdo_Cntrct($ain,$afin,$cin,$cfin); 
		
	}
	
}
?>

<div class="page-header">
     
        <div class="row">
           
             <div class="col-xs-offset-10 col-xs-2">
               <div class="import_button"><a href="guardar_excel.php?reporte=cuenta_presupuestaria" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-export"></span> Exportar a Excel</a></div>
            </div>
        </div>
    </div>

<table class="table table-striped">

		<tr>
			<th>Codigo</th>
			<th>Id</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Sexo</th>
			<th>Fecha Nacimiento</th>
			<th>Codigo Depto</th>
			<th>Departamento</th>
			<th>Cargo</th>
			<th>Sueldo</th>
			<th>Fecha Contrato</th>
			<th>Fecha Acuerdo</th>
			<th>Impuesto</th>
			<th>Tipo Planilla</th>
			<th>Codigo Presupuesto</th>
			<th>Estado</th>
		</tr>
	
<?php
while($fila = mssql_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $fila["CODIGO"];?></td>
			<td><?php echo $fila["IDENTIDAD"];?></td>
			<td><?php echo $fila["NOMBRES"];?></td>
			<td><?php echo $fila["APELLIDOS"];?></td>
			<td><?php echo $fila["SEXO"];?></td>
			<td><?php echo $fila["NACIMIENTO"];?></td>
			<td><?php echo $fila["COD. DEPTO"];?></td>
			<td><?php echo $fila["DEPARTAMENTO"];?></td>
			<td><?php echo $fila["CARGO"];?></td>
			<td><?php echo $fila["SALARIO"];?></td>
			<td><?php echo $fila["F. CONTRATO"];?></td>
			<td><?php echo $fila["F. ACUERDO"];?></td>
			<td><?php echo $fila["ctaxstate"];?></td>
			<td><?php echo $fila["T. PLANILLA"];?></td>
			<td><?php echo $fila["COD. PRES"];?></td>
			<td><?php echo $fila["ESTADO"];?></td>
		</tr>

<?php } mssql_free_result($result);?>
</table>


		
