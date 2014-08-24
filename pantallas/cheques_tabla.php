<?php

    require_once('CargadorClases.php');

    $result = -1; 
    $reporte = new ChequeMapper();

    //VALIDACION DE GETS
    if(!isset($_GET['chknum'])){$chknum='';}else{$chknum=$_GET['chknum'];}
    if(!isset($_GET['prov'])){$prov='';}else{$prov=$_GET['prov'];}
    if(!isset($_GET['banco'])){$banco='';}else{$banco=$_GET['banco'];}
    if(!isset($_GET['conc'])){$conc=0;}else{$conc=$_GET['conc'];}
    if(!isset($_GET['rete'])){$rete=0;}else{$rete=$_GET['rete'];}
    if(!isset($_GET['entr'])){$entr='';}else{$entr=$_GET['entr'];}
    
    $result= $reporte->mostrarCheque($chknum,$prov,$banco,$conc,$rete,$entr);
    
    require('Site_table.php');
?>