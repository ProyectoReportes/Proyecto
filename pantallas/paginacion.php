<html>

<head>
  <link rel="stylesheet" href="css/paginacion.css">
  <script type="text/javascript" src="js/jquery.js"></script> 
  <script src="js/paginacion.js"></script>
    <script>
  
    $(document).ready(function()
    {         
      var items = $("#contenido div");

        var numItems = items.length;
        var itemsxPage = 1;
        alert(itemsxPage);
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
         else{ $("#contenido").html("No se encontraron resultados");}
    });
  </script>


</head>
<body>

   <div id="contenido">
      <div>Hola</div>
      <div>Hola</div>
      <div>Hola</div>
      <div>Hola</div>
      <div>Hola</div>
      <div>Hola</div>
      <div>Hola</div>
   </div>

</body>
</html>



  <center><div id="selector"></div></center>