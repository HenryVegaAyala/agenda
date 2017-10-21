<?php

namespace app\commands;

use app\helpers\Utils;
use app\models\Cliente;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use yii\console\Controller;

class CommandController extends Controller
{
    public static function actionExport($empresa)
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

        $styleBody = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 9,
                'name' => 'Arial',
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_JUSTIFY,
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


        foreach (range('A', 'K') as $char) {
            $objPHPExcel->setActiveSheetIndex(0)->getStyle($char . '1')->applyFromArray($styleHeader);
            $objPHPExcel->getActiveSheet()->getStyle('A1:' . $char . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A1:' . $char . '1')->getFill()->getStartColor()->setRGB('fff200');
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);
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

        $i = 2;
        foreach (Cliente::listaClientes($empresa) as $listaCliente) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $listaCliente['nombres'])
                ->setCellValue('B' . $i, $listaCliente['apellidos'])
                ->setCellValue('C' . $i, $listaCliente['email_corp'])
                ->setCellValue('D' . $i, $listaCliente['dni'])
                ->setCellValue('E' . $i, $listaCliente['area'])
                ->setCellValue('F' . $i, $listaCliente['categoria'])
                ->setCellValue('G' . $i, $listaCliente['puesto'])
                ->setCellValue('H' . $i, $listaCliente['genero'])
                ->setCellValue('I' . $i, $listaCliente['fecha_nacimiento'])
                ->setCellValue('J' . $i, $listaCliente['fecha_ingreso'])
                ->setCellValue('K' . $i, $listaCliente['estado_civil']);

            $objPHPExcel->setActiveSheetIndex(0)->getStyle('A' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('C' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('E' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('F' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('G' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('H' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('I' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('J' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('K' . $i)->applyFromArray($styleBody);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Lista de Clientes');
        $objPHPExcel->setActiveSheetIndex(0);

        $xlsName = 'Colaboradores.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $xlsName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('reporte/' . $xlsName);
    }

    public static function actionAnalista($empresa)
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

        $styleBody = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 9,
                'name' => 'Arial',
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_JUSTIFY,
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


        foreach (range('A', 'K') as $char) {
            $objPHPExcel->setActiveSheetIndex(0)->getStyle($char . '1')->applyFromArray($styleHeader);
            $objPHPExcel->getActiveSheet()->getStyle('A1:' . $char . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A1:' . $char . '1')->getFill()->getStartColor()->setRGB('fff200');
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);
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

        $i = 2;
        foreach (Cliente::listaAnalistas($empresa) as $listaCliente) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $listaCliente['nombres'])
                ->setCellValue('B' . $i, $listaCliente['apellidos'])
                ->setCellValue('C' . $i, $listaCliente['email_corp'])
                ->setCellValue('D' . $i, $listaCliente['dni'])
                ->setCellValue('E' . $i, $listaCliente['area'])
                ->setCellValue('F' . $i, $listaCliente['categoria'])
                ->setCellValue('G' . $i, $listaCliente['puesto'])
                ->setCellValue('H' . $i, $listaCliente['genero'])
                ->setCellValue('I' . $i, $listaCliente['fecha_nacimiento'])
                ->setCellValue('J' . $i, $listaCliente['fecha_ingreso'])
                ->setCellValue('K' . $i, $listaCliente['estado_civil']);

            $objPHPExcel->setActiveSheetIndex(0)->getStyle('A' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('C' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('E' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('F' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('G' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('H' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('I' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('J' . $i)->applyFromArray($styleBody);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('K' . $i)->applyFromArray($styleBody);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Lista de Clientes');
        $objPHPExcel->setActiveSheetIndex(0);

        $xlsName = 'Analistas.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $xlsName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('reporte/' . $xlsName);
    }
}