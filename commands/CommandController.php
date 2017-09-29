<?php

namespace app\commands;

use app\helpers\Utils;
use PHPExcel;
use PHPExcel_IOFactory;
use Yii;
use yii\console\Controller;

class CommandController extends Controller
{
    public static function actionExport()
    {
        Utils::fileReporte();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
            ->setCreator("Henry Pablo Vega Ayala")
            ->setLastModifiedBy("Henry Pablo Vega Ayala")
            ->setTitle("Office 2007 XLSX Document")
            ->setSubject("Office 2007 XLSX Document")
            ->setDescription("Documento para Office 2007 XLSX, generado usando clases de PHP.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Archivo de Resultados");

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NOMBRES')
            ->setCellValue('B1', 'APELLIDOS')
            ->setCellValue('C1', 'EMAIL')
            ->setCellValue('D1', 'DNI')
            ->setCellValue('E1', 'N° CELULAR')
            ->setCellValue('F1', 'AREA')
            ->setCellValue('G1', 'CARGO');

        $objPHPExcel->getActiveSheet()->setTitle('Lista de Clientes');
        $objPHPExcel->setActiveSheetIndex(0);

        $xlsName = 'Colaboradores.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $xlsName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('reporte/' . $xlsName);
        exit();
    }
}