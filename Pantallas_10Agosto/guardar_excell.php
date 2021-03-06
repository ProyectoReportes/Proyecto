<?php

require_once ("Classes/PHPExcel.php");

$objPHPExcel = new PHPExcel();


$objPHPExcel->
	getProperties()
		->setCreator("TEDnologia.com")
		->setLastModifiedBy("TEDnologia.com")
		->setTitle("Exportar Excel con PHP")
		->setSubject("Documento de prueba")
		->setDescription("Documento generado con PHPExcel")
		->setKeywords("usuarios phpexcel")
		->setCategory("reportes");


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Codigo')
            ->setCellValue('B1', 'No. Identidad')
            ->setCellValue('C1', 'Nombres')
            ->setCellValue('D1', 'Apellidos')
            ->setCellValue('E1', 'Cargo')
            ->setCellValue('F1', 'Codigo De Departamento')
            ->setCellValue('G1', 'Departamento')
            ->setCellValue('H1', 'Referencia')
            ->setCellValue('I1', 'Banco')
            ->setCellValue('J1', 'Cheque')
            ->setCellValue('K1', 'Planilla')
            ->setCellValue('L1', 'Codigo Ingreso')
            ->setCellValue('M1', 'Valor Ingreso')

            ->setCellValue('A2', 'Hola')
            ->setCellValue('B2', 'Hola')
            ->setCellValue('C2', 'Hola')
            ->setCellValue('D2', 'Hola')
            ->setCellValue('E2', 'Hola')
            ->setCellValue('F2', 'Hola')
            ->setCellValue('G2', 'Departamento')
            ->setCellValue('H2', 'Referencia')
            ->setCellValue('I2', 'Banco')
            ->setCellValue('J2', 'Cheque')
            ->setCellValue('K2', 'Planilla')
            ->setCellValue('L2', 'Codigo Ingreso')
            ->setCellValue('M2', 'Valor Ingreso');



$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
$objPHPExcel->setActiveSheetIndex(0);


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.odt"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
