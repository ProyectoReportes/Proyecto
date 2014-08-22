<?php

    require_once('CargadorClases.php');

    $result = -1; 
    $reporte = new ReporteMapper(); //objeto de la Rep_CtaPresupMapper para llamar las funciones

 
    if(isset($_GET['c']) && isset($_GET['d']) && isset($_GET['cp']) && isset($_GET['e']) 
        && isset($_GET['fci']) && isset($_GET['fcf']) && isset($_GET['fai']) && isset($_GET['faf']))
    {

        $cargo=$_GET['c'];
        $depto=$_GET['d'];
        $codpres=$_GET['cp'];
        $est=$_GET['e'];
        $fcIn=$_GET['fci'];
        $fcFn=$_GET['fcf'];
        $faIn=$_GET['fai'];
        $faFn=$_GET['faf'];
        $result = $reporte->reporteCuentasPresExec($cargo,$depto,$codpres,$est,$fcIn,$fcFn,$faIn,$faFn);

        
    }
    
    require('Site_table.php');
?>


		
