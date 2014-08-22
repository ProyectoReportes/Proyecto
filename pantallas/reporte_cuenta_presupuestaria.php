<?php 
session_start();
require('CargadorClases.php');

if(!isset($_SESSION["user_name"]))
{
	header("Location:index.php");
	exit;
}

require('Site_header.php');

require('Site_login.php');

require('Site_body.php');

?>

    <div class="page-header">
     
        <div class="row">
            <div class="col-xs-6">
                <h2>Reporte de Empleados con Cuenta Presupuestaria:</h2>
            </div> 
            
        </div>
    </div>
    <div>
        
	<fieldset>
		<legend>Filtros</legend>
		<label>Cargo:&nbsp<input type="text" name="carg" id="carg" class="textb" value="" ></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Departamento:&nbsp<input type="text" name="depto" id="depto" class="textb" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Codigo Presupuestario:&nbsp<input type="text" name="cod_pre" id="cod_pre" class="textb" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Estado:&nbsp<input type="text" name="est" id="est" class="textb" value=""></label><br/><br/>
		<label>Fecha de Acuerdo</label><br>
		<label>Desde:&nbsp<input type="date" name="ac_in" id="ac_in" class="textb1" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Hasta:&nbsp<input type="date" name="ac_fin" id="ac_fin" class="textb1" value=""></label><br/><br/>
		<label>Fecha de Contrato</label><br>
		<label>Desde:&nbsp<input type="date" name="cont_in" id="cont_in" class="textb1" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Hasta:&nbsp<input type="date" name="cont_fin" id="cont_fin" class="textb1" value=""></label><br/>
                <input type="submit" id="bt_Generar" value="Generar Reporte" onclick="consultaReporte();"/>
                <br>
                <div class="col-xs-offset-4 col-xs-2">
                    <div class="import_button"><a href="#" class="btn btn-primary" 
                                                  role="button" onclick="guardaReporte(this);">
                            <span class="glyphicon glyphicon-export">
                            </span> Exportar a Excel</a>
                        <br>
                    </div>
                </div>
	</fieldset>
        
    </div>
    <div id="datos" class="table-responsive">
    
    </div>
<?php    

require('Site_footer.php');

?>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
    
    function guardaReporte(enlace){
        var cargo = document.getElementById("carg").value;
        var depto = document.getElementById("depto").value;
        var codpre = document.getElementById("cod_pre").value;
        var est = document.getElementById("est").value;
        var fcin = document.getElementById("cont_in").value;
        var fcfn = document.getElementById("cont_fin").value;
        var fain = document.getElementById("ac_in").value;
        var fafn = document.getElementById("ac_fin").value;
        
        var cadena = "guardar_excel.php?reporte=cuentas_presupuesto" + 
                    "&c=" + encodeURIComponent(cargo)+
                    "&d=" + encodeURIComponent(depto) +
                    "&cp=" + encodeURIComponent(codpre) +
                    "&e=" + encodeURIComponent(est) +
                    "&fci=" + encodeURIComponent(fcin) +
                    "&fcf=" + encodeURIComponent(fcfn) +
                    "&fai=" + encodeURIComponent(fain) +
                    "&faf=" + encodeURIComponent(fafn);

        enlace.href=cadena;
        enlace.click;               
    }
    
    function consultaReporte(){
        var cargo = document.getElementById("carg").value;
        var depto = document.getElementById("depto").value;
        var codpre = document.getElementById("cod_pre").value;
        var est = document.getElementById("est").value;
        var fcin = document.getElementById("cont_in").value;
        var fcfn = document.getElementById("cont_fin").value;
        var fain = document.getElementById("ac_in").value;
        var fafn = document.getElementById("ac_fin").value;
        
        var cadena = "cuenta_presupuestaria.php?" + 
                    "c=" + encodeURIComponent(cargo)+
                    "&d=" + encodeURIComponent(depto) +
                    "&cp=" + encodeURIComponent(codpre) +
                    "&e=" + encodeURIComponent(est) +
                    "&fci=" + encodeURIComponent(fcin) +
                    "&fcf=" + encodeURIComponent(fcfn) +
                    "&fai=" + encodeURIComponent(fain) +
                    "&faf=" + encodeURIComponent(fafn);
        consulta(cadena);
    }
    
</script>
