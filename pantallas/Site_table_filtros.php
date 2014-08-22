<?php

echo<<<"EL"


<div class="table-responsive">
    <table id="tabla" class="table table-striped">
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
	   echo " <td>{$valor}</td>\n ";
		} 
	   echo " </tr>\n ";
    } 
       echo<<<"ELO"
        </tbody>
    </table>
</div>

ELO;

?>
