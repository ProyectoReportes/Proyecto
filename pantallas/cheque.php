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

<div class="row">
    <div class="col-md-6">
        <div class="row">
        <fieldset><legend>Filtros:</legend>
            <div class="col-md-6">
                <p><label class="control-label col-md-3" for="numCheque">Cheque:</label>
                    <input type="text" class="form-control" name="numCheque" 
                           placeholder="Número de Cheque" id="numCheque" maxlength="10">
                </p>
                <p><label class="control-label col-md-3" for="provee">Proveedor:</label>
                    <input type="text" class="form-control" name="provee" 
                           placeholder="Proveedor" id="provee" maxlength="40">
                </p>
                <p><label class="control-label col-md-3" for="banco">Banco:</label>
                    <input type="text" class="form-control" name="banco" 
                           placeholder="# Banco" id="banco" maxlength="10">
                </p>
            </div>

            <div class="col-md-6">
                <p><label class="control-label col-md-3" for="conciliado">Conciliado:</label>
                    <select id="conciliado" name="conciliado" class="form-control">
                        <option value="0">No Conciliado</option>
                        <option value="1">Si Conciliado</option>
                    </select>
                </p>
                <p><label class="control-label col-md-3" for="retenido">Retenido:</label>
                    <select id="retenido" name="retenido" class="form-control">
                        <option value="0">No Retenido</option>
                        <option value="1">Si Retenido</option>
                    </select>
                </p>
                <p><label class="control-label col-md-3" for="entregado">Entregado:</label>
                    <select id="entregado" name="entregado" class="form-control">
                        <option value="0">No Entregado</option>
                        <option value="1">Si Entregado</option>
                    </select>
                </p>
            </div>
        </fieldset>
        </div>
        <div class="row row-centered">
            <div class="col-xs-6 col-centered">
                <a  class="btn btn-success" role="button">Aplicar Filtros</a>
            </div>
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-6">
            <fieldset><legend>Monto de Cuentas:</legend>
                <p><label class="control-label col-xs-1" for="inputId">Monto:</label>
                    <input type="number" class="form-control" name="inputId" placeholder="Monto" id="inputId">
                </p>
                <p><label class="control-label col-xs-1" for="inputId">Descripcion:</label>
                    <textarea class="form-control" name="inputId" placeholder="Descripcion del Cambio del Monto"
                              maxlength="200"
                               cols="25" rows="1"></textarea>
                </p>
                <p>
                    <a  class="btn btn-success" role="button">Cambiar</a>
                </p>
            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset><legend>Calcular Disponibilidad:</legend>
                <p>
                    <input type="button"  class="btn btn-success" value="Calcular Disponibilidad" /> 
                </p>
                <p>
                    <input type="text" class="form-control"  placeholder="Disponible" required disabled>
                </p>
            </fieldset>
        </div>
    </div>
    
</div>

<?php

require('Site_table.php');

require('Site_footer.php');

?>   


