<?php

class ReporteMapper extends MapperBD{
    
    function __construct()
    {
        parent::__construct(); 
              
    }
	function reporteIngresoEmpleados()
	{
		$result = mssql_query("exec sp_reporte_ingreso_empleados", $this->conexion);
		return $result;
	}

	function reporteDeduccionEmpleados()
	{
		$result = mssql_query("exec sp_reporte_deducciones_empleados", $this->conexion);
		return $result;
	}

    
	function reportePresupuestarioPrograma()
	{
		$result = mssql_query("exec sp_reporte_presupuesto_programa", $this->conexion);
		return $result;
	}

	function reportePresupuestarioGrupo()
	{
		$result = mssql_query("exec sp_reporte_presupuesto_grupo", $this->conexion);
		return $result;
	}

	function reportePresupuestarioSubgrupo()
	{
		$result = mssql_query("exec sp_reporte_presupuesto_subgrupo", $this->conexion);
		return $result;
	} 
        
        function reportePresupuestoOriginal()
        {
            $result = mssql_query("exec sp_reporte_presupuesto_compara", $this->conexion);
		return $result;
        }
        
        function reporteDetalleTransacciones()
        {
            $result = mssql_query("exec sp_reporte_presupuesto_transacciones", $this->conexion);
		return $result;
        }

public function filtrarPorCargo($cargo)
     {	 $c = $cargo;
	 $result = mssql_query("exec sp_slCargo '".$c."'", $this->conexion);
		return $result;
     }

 public function filtrarPorDpto($dpto)
     {	 $d = $dpto;
	 $result = mssql_query("exec sp_slDpto '".$d."'", $this->conexion);
		return $result;

     }
public function filtrarPorEstado($est)
     {	 $e = $est;
	 $result = mssql_query("exec sp_slEstado '".$e."'", $this->conexion);
		return $result;
     }
public function filtrarPorCodPre($codP)
     {	 $c = $codP;
	 $result = mssql_query("exec sp_slCodPresupuestario '".$c."'", $this->conexion);
		return $result;

     }
public function filtrarPorAcuerdo($a_in, $a_fin)
     {	 $in = $a_in;
	 $fin= $a_fin;
	 $result = mssql_query("exec sp_slFAcuerdo '".$in."','".$fin."'", $this->conexion);
	 return $result;

     }
public function filtrarPorContrato($c_in, $c_fin)
     {	  $in = $c_in;
	  $fin= $c_fin;
	 $result = mssql_query("exec sp_slFContrato '".$in."','".$fin."'", $this->conexion);
		return $result;
     }
public function filtrarPorCargo_Dpto($carg, $dpto)
     {	  $c= $carg;
	  $d= $dpto;
	 $result = mssql_query("exec sp_slCargo_Dpto '".$c."','".$d."'", $this->conexion);
		return $result;
     }
public function filtrarPorAcrdo_Cntrct($ain, $afin, $cin, $cfin){
	$ci = $cin;
	$cf = $cfin;
	$ai = $ain;
	$af = $afin;
$result = mssql_query("exec sp_slAcuerdo_Contrato '".$ai."','".$af."','".$ci."','".$cf."'", $this->conexion);
return $result;
}
}
?>
