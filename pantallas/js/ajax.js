function consulta(cadena)
    { 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
         document.getElementById("datos").innerHTML=xmlhttp.responseText;
         console.log(xmlhttp.responseText);
        }
      }
    xmlhttp.open("GET",cadena,true);
    xmlhttp.send();
    }


function entregarCheque(element)
{

  var id = $(element).attr('value');
  var tr = $("#tabla .registro");
  var fila;
  $.each(tr, function( index, value ) {
    if($(value).attr('value') == id)
    {
      fila = value;
      
    }
  });

  console.log($(fila).children()[9]);
  
  if($(element).hasClass("btn-success"))
  {
    $.ajax({
      type: "POST",
      url: "entregar_cheque.php",
      data: {cheque : id, estado : 1},
      success: function(response)
      {
        $(element).html("Revertir entrega");
        $(element).removeClass("btn-success");
        $(element).addClass("btn-warning");
        $(fila).children()[9].html("NO");
      }
  });  
  }
  else
  {
    $.ajax({
      type: "POST",
      url: "entregar_cheque.php",
      data: {cheque : id, estado : 0},
      success: function(response)
      {
        $(element).html("Entregar");
        $(element).removeClass("btn-warning");
        $(element).addClass("btn-success");
        $(fila).children()[9].html("SI");
      }
  });
  }
  

}