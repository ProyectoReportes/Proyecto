<?php

echo<<<"EL"


<div class="table-responsive">
    <table id="tabla" class="table table-striped">
        <thead>
        <tr>

EL;
    
      $cabecera = mssql_fetch_assoc($result); 
		  
      foreach ($cabecera as $indice => $valor) 
      { 
         echo "<th>{$indice}</th>";
         if($indice == "ENTREGADO")
        {
          echo "<th>ESTADO</th>";
        }
     
      }
      
      $i=1;
      
      mssql_data_seek($result, 0); 

       echo "</tr> "; 
       echo "</thead> "; 
       echo "<tbody> ";
 

    while($row = mssql_fetch_assoc($result)) {

        ?> <tr class='registro'  id="<?php echo "fila".$i;?>" /> 
        <?php 

        foreach ($row as $indice => $valor) {  
            echo " <td>{$valor}</td>\n ";
            if($indice == "ENTREGADO")
            {   $num = $row["# CHEQUE"];
                if($row["CONCILIADO"] == "NO" && $row["RETENIDO"] == "NO" && $row["ENTREGADO"] == "NO")
                {

                    ?> <td><button type="button" 
                                onClick="entregarCheque('<?php echo $num; ?>',1,'<?php echo "fila".$i; ?>')" 
                                class="btn btn-success">Entregar</button></td> <?php
                }
                elseif ($row["CONCILIADO"] == "SI")
                {
                    echo "<td>Conciliado</td>";
                }
                elseif($row["RETENIDO"] == "SI")
                {
                    echo "<td>Retenido</td>"; 
                }
                elseif ($row["ENTREGADO"] == "SI") 
                {
                    
                    ?> <td><button type="button" 
                                onClick="entregarCheque('<?php echo $num; ?>',0,'<?php echo "fila".$i; ?>')"
                                class="btn btn-warning" >Revertir Entrega</button></td> <?php
                }

            }

        } 
        $i=$i + 1;
        echo " </tr>\n ";
    } 
       echo<<<"ELO"
        </tbody>
    </table>
</div>
<center><div id="selector" ></div></center>

ELO;

?>


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
    

