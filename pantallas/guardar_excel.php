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
          case 'presupuesto_original':
                  $result = $reporte->reportePresupuestoOriginal();
                  break;
            case 'detalle_transacciones':
                  $result = $reporte->reporteDetalleTransacciones();
                  break;
            default:
                  break;
}
      
      $i = 2;

      $objPHPExcel = new PHPExcel();

      $objPHPExcel->
            getProperties()
                  ->setCreator("Edson Bonilla, Emil Ordoñez, Erick Zelaya, Osly Salinas, Sindy Garcia")
                  ->setTitle("Exportar Excel con PHP")
                  ->setSubject("Documento de reporte")
                  ->setDescription("Documento generado con PHPExcel")
                  ->setCategory("reportes");

      $registro = mssql_fetch_assoc($result);
      $contadorColumnas = 0;
      foreach ($registro as $key => $value) 
      {
            $contadorColumnas++;
      }
      mssql_data_seek($result, 0);
      
      $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$columnas[$contadorColumnas - 1]."1");
      $objPHPExcel->getActiveSheet()->setCellValue('A1', $nombre_reporte);

      while ($row = mssql_fetch_assoc($result))
      {     $indice = 0;
            if($i == 2)
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
      mssql_data_seek($result, 0);

    $estiloTituloReporte = array(
    'font' => array(
            'name'      => 'Verdana',
            'bold'      => true,
            'italic'    => false,
            'strike'    => false,
            'size' =>14,
            'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'      => PHPExcel_Style_Fill::FILL_SOLID,
      'color'     => array(
      'rgb' => '00BFFF')
      ),
    'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);


$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
        'type'         => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
      'rotation'   => 90,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);

$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
            'name'  => 'Bitstream Charter',
            'color' => array(
                'rgb' => '000000'
        )
    )
));


 $estiloCelda = array(
    'font' => array(
            'name'      => 'Bitstream Charter',
            'color'     => array(
            'rgb' => 'FF0000'
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);


      for($i = 'A'; $i <= $columnas[$contadorColumnas - 1]; $i++)
      {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
      }


      $objPHPExcel->getActiveSheet()->setTitle('Usuarios');
      $objPHPExcel->getActiveSheet()->getStyle('A1:'.$columnas[$contadorColumnas - 1]."1")->applyFromArray($estiloTituloReporte);
      $objPHPExcel->getActiveSheet()->getStyle('A2:'.$columnas[$contadorColumnas - 1]."2")->applyFromArray($estiloTituloColumnas);
      $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:".$columnas[$contadorColumnas - 1].($contadorColumnas - 1));
      
      $i = 3;
      while ($row = mssql_fetch_assoc($result)) 
      {
        $indice = 0;
        foreach ($row as $key => $value) {
            
        
        if($key == "% UTILIZADO"){
                         $fecha=getdate();
                          if(is_numeric($value)){
                            if($value > ($fecha['mon']/12)){
                              //CAMBIAR ESTILO A FONDO ROJO, LETRA BLANCO
                              $objPHPExcel->getActiveSheet()->getStyle($columnas[$indice].$i.":".$columnas[$indice].$i)->applyFromArray($estiloCelda);                       
                              
                            }
                          }
                        }
                        $indice++;        
              }
              $i++;
      }
      
      $objPHPExcel->setActiveSheetIndex(0);


      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename='.$nombre_reporte.'.odt');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');      
}

exit;

?>
