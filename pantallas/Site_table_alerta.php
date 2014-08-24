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
	   echo " <tr class='registro'>\n ";
		  foreach ($row as $indice => $valor) {  
	   echo " <td". alertas($indice,$valor) .">{$valor}</td>\n ";
		} 
	   echo " </tr>\n ";
    } 
       echo<<<"ELO"
        </tbody>
    </table>
</div>
<center><div id="selector" ></div></center>

ELO;


?>


<link rel="stylesheet" href="css/paginacion.css"> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/simplePagination.js"></script>

<script>
  
      var items = $("#tabla .registro");

        var numItems = items.length;
        var itemsxPage = 30;
        
        if(numItems > 0)
        {
        // only show the first 2 (or "first per_page") items initially
          items.slice(itemsxPage).hide();

          $("#selector").pagination({
            items: numItems,
            itemsOnPage: itemsxPage,
            cssStyle: 'light-theme',
            onPageClick: function(pageNumber) { // this is where the magic happens
                // someone changed page, lets hide/show trs appropriately
                var showFrom = itemsxPage * (pageNumber - 1);
                var showTo = showFrom + itemsxPage;

                items.hide().slice(showFrom, showTo).show();
                     // first hide everything, then show for the new page
            } 
          });
         
        }
         else{ $("#tabla").html("No se encontraron resultados");}
   
  </script>
