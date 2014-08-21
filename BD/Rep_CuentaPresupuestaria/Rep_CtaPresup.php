<?php
require('CargadorClases.php');

$result = -1; 
$reporte = new Rep_CtaPresupMapper(); //objeto de la Rep_CtaPresupMapper para llamar las funciones

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
<table cellspacing="10" cellpadding="10" id="tbl_Reporte">
		<tr>
			<th>Codigo</th>
			<th>Nro_Id</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Sexo</th>
			<th>F_Nac</th>
			<th>Cod_Dpto</th>
			<th>Dpto</th>
			<th>Cargo</th>
			<th>Sueldo</th>
			<th>F_Contrato</th>
			<th>Acuerdo</th>
			<th>Impuesto</th>
			<th>Tipo_Planilla</th>
			<th>Cod_Presup</th>
			<th>Estado</th>
		</tr>
	</table>
<?php
while($fila = mssql_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $fila["cempno"];?></td>
			<td><?php echo $fila["cfedid"];?></td>
			<td><?php echo $fila["cfname"];?></td>
			<td><?php echo $fila["clname"];?></td>
			<td><?php echo $fila["csex"];?></td>
			<td><?php echo $fila["dbirth"];?></td>
			<td><?php echo $fila["cdeptno"];?></td>
			<td><?php echo $fila["cdeptname"];?></td>
			<td><?php echo $fila["cDesc"];?></td>
			<td><?php echo $fila["nmonthpay"];?></td>
			<td><?php echo $fila["dcntrct"];?></td>
			<td><?php echo $fila["dhire"];?></td>
			<td><?php echo $fila["ctaxstate"];?></td>
			<td><?php echo $fila["cpaytype"];?></td>
			<td><?php echo $fila["cwageacc"];?></td>
			<td><?php echo $fila["cstate"];?></td>
		</tr>

<?php } mssql_free_result($result);?>
		
