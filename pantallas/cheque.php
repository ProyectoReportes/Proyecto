<?php 

session_start();
require('CargadorClases.php');

if(!isset($_SESSION["user_name"]))
{
	header("Location:index.php");
	exit;
}


$reporte = new ReporteMapper();

$result = $reporte->mostrarCheque();

require('Site_header.php');

require('Site_login.php');

require('Site_body.php');

?>
<style type="text/css">
	.btn, .form-control
	{
		display: inline-block;
		vertical-align: top;
	}
</style>
<div class="page-header">     
        <div class="row">
            <div class="col-xs-6">
                <h2>Control de cheques</h2>
            </div>
             <div class="col-xs-offset-4 col-xs-2">
               <div class="import_button"><a href="guardar_excel.php?reporte=presupuestario_programa" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-export"></span> Exportar a Excel</a></div>

            </div>
        </div>
    </div>

     <div class="form-group">

         <div class="col-xs-3">
            <input type="text" class="form-control" name="inputId" placeholder="Monto" id="inputId">
			<textarea class="form-control" name="inputId" placeholder="Descripcion" ></textarea>
        </div>
        <div></div>

    </div>
     <div class="form-group">
        
         <div class="col-xs-2">
            <a  class="btn btn-success" role="button">Cambiar</a>
			            
        </div>
    </div>

         <div class="form-group">
        <label class="control-label col-xs-1" for="inputId">Disponible:</label>
         <div class="col-xs-2">
            <input type="text" class="form-control"  placeholder="Disponible" required>
        </div>
    </div>
                  <div class="form-group">

         <div class="col-xs-3">
			<input type="button"  class="btn btn-success" value="Calcular" /> 
        </div>
         </div>



<?php

require('Site_table.php');

require('Site_footer.php');

?>   


