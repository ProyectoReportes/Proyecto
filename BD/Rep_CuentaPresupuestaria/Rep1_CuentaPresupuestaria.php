<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <link rel="icon" href="mp_ico.ico">
    <title>Sistema de Reportes MP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">  
    <style type="text/css">
		th, th
			{
				border: 12px solid white;
				box-shadow: rgba(0,0,0,0.1) 0px 0px 10px;
				margin: 0px;
			}
			table
			{
				margin: 0 auto;
			}
		.textb{ 
		    background: white; 
		    border: 1px solid #DDD; 
		    border-radius: 5px; 
		    box-shadow: 0 0 5px #DDD inset; 
		    color: #666; 
		    outline: none; 
		    height:25px; 
		    width: 105px; 
		   }

		.textb1{ 
		    background: white; 
		    border: 1px solid #DDD; 
		    border-radius: 5px; 
		    box-shadow: 0 0 5px #DDD inset; 
		    color: #666; 
		    outline: none; 
		    height:25px; 
		    width: 140px; 
		   }
    </style>
</head>

<body>
  
  <h1 class="logo"><a href="index.html"></a></h1>
  <h1 class="text-muted">Sistema de Reportes</h1>
  <br>
  
  
  <nav role="navigation" class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
       <!-- <a href="#" class="navbar-brand">Inventario</a> -->
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Inicio</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Parametros <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="#">Regiones</a></li>
                    <li><a href="#">Oficinas</a></li>
                    <li><a href="#">Departamentos</a></li>    
                    <li class="divider"></li>
                    <li><a href="#">Otros</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Reportes <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="reportes_presupuesto.html">Presupuesto</a></li>
                    <li><a href="reportes_cheques.html">Cheques</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Otros</a></li>
                </ul>
            </li>
  
            <li><a href="http://www.mp.hn/">Acerca de Ministerio Publico</a></li>
        </ul>
     
    </div>
</nav>

<div class="page-header">
  <h2>Reportes de Cuentas Presupuestarias</h2>
</div>
<div>
	<fieldset>
		<legend>Filtros</legend>
		<label>Cargo:&nbsp<input type="text" name="txt_cargo" id="txt_cargo" class="textb" value="" ></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Departamento:&nbsp<input type="text" name="txt_dpto" id="txt_dpto" class="textb" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Codigo Presupuestario:&nbsp<input type="text" name="txt_codPre" id="txt_codPre" class="textb" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Estado:&nbsp<input type="text" name="txt_estado" id="txt_estado" class="textb" value=""></label><br/><br/>
		<label>Fecha de Acuerdo</label><br>
		<label>Desde:&nbsp<input type="date" name="d_fAcuerdo" id="fAcuerdoIn" class="textb1" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Hasta:&nbsp<input type="date" name="d_fContrado" id="fAcuerdoFin" class="textb1" value=""></label><br/><br/>
		<label>Fecha de Contrato</label><br>
		<label>Desde:&nbsp<input type="date" name="d_fContrado" id="fContratoIn" class="textb1" value=""></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<label>Hasta:&nbsp<input type="date" name="d_fContrado" id="fContratoFin" class="textb1" value=""></label><br/>
		<input type="submit" id="bt_Generar" value="Generar Reporte" onclick="GenerarReporte();"/>
	</fieldset>
</div>

<div>
	<table cellspacing="10" cellpadding="10" id="tbl_Reporte">
	</table>
</div>
 
<div class="footer">
    <h5><strong>Ingenieria del Software UNAH 2014</strong></h5>
</div> 
<br>
  
<script type="text/javascript">
	
 var xmlAjax;
    if(window.XMLHttpRequest) 
      {
        xmlAjax = new XMLHttpRequest();
      } 
      else 
      {
        xmlAjax = new ActiveXObject("Microsoft.XMLHTTP");
      }

  function GenerarReporte() 
  { 
        xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {//satisfactorio

            var tblRep = document.getElementById("tbl_Reporte");
          

            if(xmlAjax.responseText != "")
            {
              tblRep.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('tbl_Reporte').style.display = 'none'; 
              
            }
            
          }
          else 
          {//error
            alert("error");
          }
        }
      }
        var carg = document.getElementById("txt_cargo").value;
        var est = document.getElementById("txt_estado").value;
        var depto = document.getElementById("txt_dpto").value;
        var cod_pre = document.getElementById("txt_codPre").value;
        var ac_in = document.getElementById("fAcuerdoIn").value;
        var ac_fin = document.getElementById("fAcuerdoFin").value;
        var cont_in = document.getElementById("fContratoIn").value;
        var cont_fin = document.getElementById("fContratoFin").value;

        xmlAjax.open("GET","Rep_CtaPresup.php?carg=" + carg +"&est="+ est +"&depto="+ depto +"&cod_pre="+ cod_pre +"&ac_in="+ ac_in +"&ac_fin="+ ac_fin +"&cont_in="+ cont_in +"&cont_fin="+ cont_fin, true);
        xmlAjax.send();
    }
</script>   


<!-- Bootstrap core JavaScript
================================================== --><!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</body>
</html>
