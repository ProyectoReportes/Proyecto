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
    
    function reporteCuentasPresExec($cargo,$depto,$codpres,$est,$fcIn,$fcFn,$faIn,$faFn)
    {
        $consulta = mssql_init("sp_reporte_empl_cuentas_presupuestarias", $this->conexion);
        mssql_bind($consulta,"@cargo",$cargo,SQLVARCHAR);
        mssql_bind($consulta,"@depto",$depto,SQLVARCHAR);
        mssql_bind($consulta,"@codpres",$codpres,SQLVARCHAR);
        mssql_bind($consulta,"@est",$est,SQLVARCHAR);
        mssql_bind($consulta,"@facrdIn",$faIn,SQLFLT8);
        mssql_bind($consulta,"@facrdFn",$faFn,SQLFLT8);
        mssql_bind($consulta,"@fcontrIn",$fcIn,SQLFLT8);
        mssql_bind($consulta,"@fcontrFn",$fcFn,SQLFLT8);
        $result=mssql_execute($consulta);
        mssql_free_statement($consulta);
	return $result;
    }

    function actualizarCheque()
    {
    	$result = mssql_query("exec sp_chk_actualizar", $this->conexion);
    }
    function entregarCheque($noCheque, $estado)
    {

    	$consulta = mssql_init("sp_chk_entregar", $this->conexion);
        mssql_bind($consulta,"@num",$noCheque,SQLVARCHAR);
        mssql_bind($consulta,"@entr",$estado,SQLVARCHAR);	

        mssql_execute($consulta);

    }
    function mostrarCheque()
    {
    	$result = mssql_query("exec sp_chk_mostrar", $this->conexion);
    	return $result;
    }

        
}
?>
