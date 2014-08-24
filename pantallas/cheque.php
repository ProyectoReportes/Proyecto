<?php 

session_start();
require('CargadorClases.php');

if(!isset($_SESSION["user_name"]))
{
	header("Location:index.php");
	exit;
}

if(isset($_GET["tipo"]) || isset($_POST["tipo"])){
    if(isset($_GET["tipo"]))
    {
        if($_GET["tipo"]==="entrega"){
            $numCheque = $_GET["chknum"]; 
            $estado = $_GET["est"];
            $filaid = $_GET["filaid"];
            $cheques = new ChequeMapper();
            $cheques->entregarCheque($numCheque, $estado);
            echo  $cheques->imprimeFila($numCheque,$filaid);
        }elseif($_GET["tipo"]==="calculaDisp"){
            $cheques = new ChequeMapper();
            $fila=mssql_fetch_row($cheques->getDisponible());
            echo "Monto Disponible:<br><input type='text' class='form-control col-md-6' value='".$fila[0]."'></input>";
        }elseif($_GET["tipo"]==="cambiamonto"){
            $monto = $_GET["monto"]; 
            $desc = $_GET["desc"];
            $cheques = new ChequeMapper();
            $cheques->insertaMonto($monto, $desc);
            echo $cheques->insertaMonto($monto, $desc);
        }
    }
}else{
    $reporte = new ChequeMapper();

    $result = $reporte->mostrarCheque("","","","","","");

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
                   <div class="import_button"><a href="#" class="btn btn-primary" 
                                          role="button" onclick="guardaReporte(this);">
                           <span class="glyphicon glyphicon-export"></span> Exportar a Excel</a></div>
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
                    <a  class="btn btn-success" role="button" onclick="consultaReporte();">Aplicar Filtros</a>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-6">
                <fieldset><legend>Monto de Cuentas: </legend>
                    <?php $reporte2=new ChequeMapper();$monto=mssql_fetch_row($reporte2->getMontoActual()); ?>
                    <p><a href='#' onclick='habilitaCambioMonto();return false;'>¿Ver / Cambiar Monto?</a></p>
                    <p><label class="control-label col-xs-1" for="monto" 
                              id='lblmonto'>Monto:</label>
                        
                        <input type="number" class="form-control" name="monto" placeholder="Monto" 
                               id="monto" value="<?php echo $monto[0];?>">
                    </p>
                    <p><label class="control-label col-xs-1" for="descmonto" id='lbldescmonto'>Descripcion:</label>
                        <textarea class="form-control" name="descmonto" placeholder="Descripcion del Cambio del Monto"
                                  maxlength="200" id='descmonto'
                                   cols="25" rows="1"><?php echo $monto[2];?></textarea>
                    </p>
                    <p>Fecha:
                        <input type="datetime" class="form-control" name="fechamonto"
                               id="fechamonto" value="<?php echo $monto[1];?>" readonly>
                    </p>
                    <div class='hidden' id='resultadomonto' onclick="className='hidden';"></div>
                    <p>
                        <a  class="hidden" role="button" id='botonmonto' onclick="cambiarMonto();">Cambiar</a>
                    </p>
                </fieldset>
            </div>

            <div class="col-md-6">
                <fieldset><legend>Calcular Disponibilidad:</legend>
                    <p>
                        <input type="button"  class="btn btn-success" value="Calcular Disponibilidad" onclick="calculaDisp();"/> 
                    </p>
                    <p>
                        <p id="textdisp" name="textdisp"></p>
                    </p>
                </fieldset>
            </div>
        </div>

    </div>

    <div id="datos" class="table-responsive">
        
        
    </div>
    
<?php
    require('Site_footer.php');
}
?>   

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
    var cambioMonto=false;
    
    consultaReporte();
    
    function guardaReporte(enlace){
        var numchk = document.getElementById("numCheque").value;
        var provee = document.getElementById("provee").value;
        var banco = document.getElementById("banco").value;
        var conc = document.getElementById("conciliado").value;
        var rete = document.getElementById("retenido").value;
        var entr = document.getElementById("entregado").value;
        
        var cadena = "guardar_excel.php?reporte=cheques" + 
                    "&chknum=" + encodeURIComponent(numchk)+
                    "&prov=" + encodeURIComponent(provee) +
                    "&banco=" + encodeURIComponent(banco) +
                    "&conc=" + encodeURIComponent(conc) +
                    "&rete=" + encodeURIComponent(rete) +
                    "&entr=" + encodeURIComponent(entr);

        enlace.href=cadena;
        enlace.click;               
    }
    
    function consultaReporte(){
        var numchk = document.getElementById("numCheque").value;
        var provee = document.getElementById("provee").value;
        var banco = document.getElementById("banco").value;
        var conc = document.getElementById("conciliado").value;
        var rete = document.getElementById("retenido").value;
        var entr = document.getElementById("entregado").value;
        
        var cadena = "cheques_tabla.php?" + 
                    "chknum=" + encodeURIComponent(numchk) +
                    "&prov=" + encodeURIComponent(provee) +
                    "&banco=" + encodeURIComponent(banco) +
                    "&conc=" + encodeURIComponent(conc) +
                    "&rete=" + encodeURIComponent(rete) +
                    "&entr=" + encodeURIComponent(entr);
        consulta(cadena);
    }
    
    function entregarCheque(chk,est,filaid){
        var cadena = "cheque.php?tipo=entrega" +
                    "&chknum=" + encodeURIComponent(chk)+
                    "&est=" + encodeURIComponent(est)+
                    "&filaid=" + encodeURIComponent(filaid);
        consulta2(cadena,filaid);
    }
    
    function calculaDisp(){
        var labelDisp = document.getElementById("textdisp");
        var cadena = "cheque.php?tipo=calculaDisp";
        consulta2(cadena,labelDisp.id);
    }
    
    function habilitaCambioMonto(){
        var boton = document.getElementById("botonmonto");
        var lblmonto = document.getElementById("lblmonto");
        var lbldescmonto = document.getElementById("lbldescmonto");
        
        if(cambioMonto){
            lblmonto.innerHTML="Monto:";
            lbldescmonto.innerHTML="Descripción:";
            boton.className="hidden";
        }else{
            lblmonto.innerHTML="Monto Nuevo:";
            lbldescmonto.innerHTML="Descripción Nueva:";
            boton.className="btn btn-success";
        }
        cambioMonto=!cambioMonto;  
    }
    
    function cambiarMonto(){
        var monto = document.getElementById("monto").value;
        var descmonto = document.getElementById("descmonto").value;
        var fechamonto = document.getElementById("fechamonto");
        
        document.getElementById("resultadomonto").className="";
        
        cadena="cheque.php?tipo=cambiamonto" +
            "&monto=" + encodeURIComponent(monto) + 
            "&desc=" + encodeURIComponent(descmonto);
        consulta2(cadena,'resultadomonto');
        
        var fecha = new Date();
        
        fechamonto.value= fecha.getYear() + "-" + (fecha.getMonth() + 1) + "-" +
                fecha.getDate();
        fechamonto.value = fecha.toString();
        
        habilitaCambioMonto();
    }
</script>