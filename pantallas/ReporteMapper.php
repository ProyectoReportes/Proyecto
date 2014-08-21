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
}
?>
