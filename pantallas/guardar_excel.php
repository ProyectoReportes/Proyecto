<?php

require_once ("Classes/PHPExcel.php");
require('CargadorClases.php');

if(isset($_GET['reporte']))
{
      $nombre_reporte = $_GET['reporte'];
      $columnas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V');
      $reporte = new ReporteMapper();
      switch ($nombre_reporte) 
      {
            case  'ingreso_empleados':
                  $result = $reporte->reporteIngresoEmpleados();            
                  break;
            case 'deduccion_empleados':
                  $result = $reporte->reporteDeduccionEmpleados();
                  break;
            case 'presupuestario_grupo':
                  $result = $reporte->reportePresupuestarioGrupo();
                  break;
            case 'presupuestario_subgrupo':
                  $result = $reporte->reportePresupuestarioSubgrupo();
                  break;
            case 'presupuestario_programa':
                  $result = $reporte->reportePresupuestarioPrograma();
                  break;
            default:
                  break;
      }
      
      $i = 1;

      $objPHPExcel = new PHPExcel();

      $objPHPExcel->
            getProperties()
                  ->setCreator("Edson Bonilla, Emil Ordoñez, Erick Zelaya, Osly Salinas, Sindy Garcia")
                  ->setTitle("Exportar Excel con PHP")
                  ->setSubject("Documento de reporte")
                  ->setDescription("Documento generado con PHPExcel")
                  ->setCategory("reportes");

      while ($row = mssql_fetch_assoc($result))
      {     $indice = 0;
            if($i == 1)
            {
                  foreach ($row as $key => $value) 
                  {
                        $objPHPExcel->getActiveSheet()->setCellValue($columnas[$indice].$i, $key);
                        $indice++;
                              
                  }
                  mssql_data_seek($result, 0);
            }
            else
            {
                  foreach ($row as $key => $value) 
                  {
                        $objPHPExcel->getActiveSheet()->setCellValue($columnas[$indice].$i, $value);
                        $indice++;
                  }     
            }
            $i++;
      }


      $objPHPExcel->getActiveSheet()->setTitle('Usuarios');
      $objPHPExcel->setActiveSheetIndex(0);


      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename='.$nombre_reporte.'.odt');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');      
}

exit;

?>
