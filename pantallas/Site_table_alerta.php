<?php

function alertas($ind,$val){
	if($ind === '% UTILIZADO')
	{	$fecha = getdate();
		if(is_numeric((double)$val)){
			if($val > ((int)$fecha['mon']/12)){
				return " class='alerta' ";		
			}	
		}
	}
}

echo<<<"EL"


<div class="table-responsive">
    <table id="tabla" class="table">
        <thead>
        <tr>

EL;

	    $cabecera = mssql_fetch_assoc($result); 
		  foreach ($cabecera as $indice => $valor) { 
	   
       echo "	<th>{$indice}</th>\n ";
	   		} mssql_data_seek($result, 0); 

       echo " </tr> "; 
       echo " </thead> "; 
       echo " <tbody> ";
 

	while($row = mssql_fetch_assoc($result)) { 
	   echo " <tr>\n ";
		  foreach ($row as $indice => $valor) {  
	   echo " <td". alertas($indice,$valor) .">{$valor}</td>\n ";
		} 
	   echo " </tr>\n ";
    } 
       echo<<<"ELO"
        </tbody>
    </table>
</div>

ELO;



?>
