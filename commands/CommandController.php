<?php

namespace app\commands;

use app\helpers\Utils;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use yii\console\Controller;

class CommandController extends Controller
{
    public static function actionExport()
    {
        Utils::fileReporte();

        $styleHeader = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
                'size' => 10,
                'name' => 'Arial',
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
        ];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
            ->setCreator("Henry Pablo Vega Ayala")
            ->setLastModifiedBy("Henry Pablo Vega Ayala")
            ->setTitle("Office 2007 XLSX Document")
            ->setSubject("Office 2007 XLSX Document")
            ->setDescription("Documento para Office 2007 XLSX, generado usando clases de PHP.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Archivo de Resultados");

        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:K1')->applyFromArray($styleHeader);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NOMBRES')
            ->setCellValue('B1', 'APELLIDOS')
            ->setCellValue('C1', 'EMAIL CORPORATIVO')
            ->setCellValue('D1', 'DNI')
            ->setCellValue('E1', 'AREA')
            ->setCellValue('F1', 'CATEGORIA')
            ->setCellValue('G1', 'PUESTO')
            ->setCellValue('H1', 'GENERO')
            ->setCellValue('I1', 'FECHA DE NACIMIENTO')
            ->setCellValue('J1', 'FECHA DE INGRESO')
            ->setCellValue('K1', 'ESTADO CIVIL');

        $objPHPExcel->getActiveSheet()->setTitle('Lista de Colaboradores');
        $objPHPExcel->setActiveSheetIndex(0);

        $xlsName = 'Colaboradores.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $xlsName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('reporte/' . $xlsName);
    }
}