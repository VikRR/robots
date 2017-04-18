<?php

namespace robots\app\core;


class WriteExcel
{
    private static $php_excel;


    public static function start($data)
    {

        $php_excel = new \PHPExcel();

        self::$php_excel = $php_excel;

        $php_excel->getProperties()->setTitle('Test');

        $a_sheets = $php_excel->getActiveSheet();

        $a_sheets->getColumnDimension('A')->setWidth(5);
        $a_sheets->getColumnDimension('B')->setWidth(48);
        $a_sheets->getColumnDimension('C')->setAutoSize(true);
        $a_sheets->getColumnDimension('D')->setAutoSize(true);
        $a_sheets->getColumnDimension('E')->setWidth(70);


        $a_sheets->getStyle()->getFont()->setName('Arial');
        $a_sheets->getStyle()->getFont()->setSize(10);

        $style_first_line = array(
            'font' => array(
                'bold' => true,
            ),
        );

        $a_sheets->getStyle('A1:E1')->applyFromArray($style_first_line);

        $style_alig_vert = array(
            'alignment' => array(
                'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
            ),

        );

        $style_alig_horiz = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
            ),
        );

        for ($i = 1; $i <= 17; $i++) {
            $a_sheets->getStyle("A$i:E$i")->applyFromArray($style_alig_vert);
            $a_sheets->getStyle("A$i")->applyFromArray($style_alig_horiz);
            $a_sheets->getStyle("C$i")->applyFromArray($style_alig_horiz);
        }


        $style_fill_red = array(
            'fill' => array(
                'type'  => \PHPExcel_STYLE_FILL::FILL_SOLID,
                'color' => array(
                    'rgb' => 'ed4d72',
                ),
            ),
        );

        $style_fill_green = array(
            'fill' => array(
                'type'  => \PHPExcel_STYLE_FILL::FILL_SOLID,
                'color' => array(
                    'rgb' => '38b14f',
                ),
            ),
        );


        $php_excel->setActiveSheetIndex(0)
            ->setCellValue('A1', '№')
            ->setCellValue('B1', 'Название проверки')
            ->setCellValue('C1', 'Статус')
            ->setCellValue('E1', 'Текущее состояние');

        $a_sheets->mergeCells('A2:A3')
            ->mergeCells('B2:B3')
            ->mergeCells('C2:C3')
            ->setCellValue('A2', '1')
            ->setCellValue('B2', $data['verification']['file'])
            ->setCellValue('C2', $data['status_exist_robots'])
            ->setCellValue('D2', $data['verification']['stat'])
            ->setCellValue('D3', $data['verification']['recom'])
            ->setCellValue('E2', $data['exist_robots_status'])
            ->setCellValue('E3', $data['exist_robots_recom']);

        if ($data['status_exist_robots'] == 'OK') {
            $a_sheets->getStyle('C2:C3')->applyFromArray($style_fill_green);
        } else {
            $a_sheets->getStyle('C2:C3')->applyFromArray($style_fill_red);
        }

        if ($data['exist_robots']) {

            $a_sheets->mergeCells('A5:A6')
                ->mergeCells('B5:B6')
                ->mergeCells('C5:C6')
                ->mergeCells('A8:A9')
                ->mergeCells('B8:B9')
                ->mergeCells('C8:C9')
                ->mergeCells('A11:A12')
                ->mergeCells('B11:B12')
                ->mergeCells('C11:C12')
                ->mergeCells('A14:A15')
                ->mergeCells('B14:B15')
                ->mergeCells('C14:C15')
                ->mergeCells('A17:A18')
                ->mergeCells('B17:B18')
                ->mergeCells('C17:C18')
                ->setCellValue('A5', '2')
                ->setCellValue('A8', '3')
                ->setCellValue('B5', $data['verification']['host'])
                ->setCellValue('B8', $data['verification']['host_count']);


            $a_sheets->setCellValue('A8', '3')
                ->setCellValue('B8', $data['verification']['host_count'])
                ->setCellValue('D8', $data['verification']['stat'])
                ->setCellValue('D9', $data['verification']['recom']);

            if ($data['status_host'] == 'OK') {
                $a_sheets->getStyle('C5:C6')->applyFromArray($style_fill_green);
                if ($data['status_host_count'] == 'OK') {
                    $a_sheets->getStyle('C8:C9')->applyFromArray($style_fill_green);
                } else {
                    $a_sheets->getStyle('C8:C9')->applyFromArray($style_fill_red);
                }
                $a_sheets->setCellValue('C8', $data['status_host_count'])
                    ->setCellValue('E8', $data['host_count_status'])
                    ->setCellValue('E9', $data['host_count_recom']);//!!!!
            } else {
                $a_sheets->getStyle('C5:C6')->applyFromArray($style_fill_red);
                $a_sheets->getStyle('C8:C9')->applyFromArray($style_fill_red);

                $a_sheets->setCellValue('C8', 'Ошибка')
                    ->setCellValue('E8', 'Директории Host нет')
                    ->setCellValue('E9', 'Добавьте Host директорию и она должна быть указана только один раз');//!!!!

            }

            $a_sheets->setCellValue('A5', '2')
                ->setCellValue('B5', $data['verification']['host'])
                ->setCellValue('C5', $data['status_host'])
                ->setCellValue('D5', $data['verification']['stat'])
                ->setCellValue('D6', $data['verification']['recom'])
                ->setCellValue('E5', $data['host_status'])
                ->setCellValue('E6', $data['host_recom']);

            if ($data['status_file_size'] == 'OK') {
                $a_sheets->getStyle('C11:C12')->applyFromArray($style_fill_green);
            } else {
                $a_sheets->getStyle('C11:C12')->applyFromArray($style_fill_red);
            }

            $a_sheets->setCellValue('A11', '4')
                ->setCellValue('B11', $data['verification']['file_size'])
                ->setCellValue('C11', $data['status_file_size'])
                ->setCellValue('D11', $data['verification']['stat'])
                ->setCellValue('D12', $data['verification']['recom'])
                ->setCellValue('E11', $data['file_size_status'])
                ->setCellValue('E12', $data['file_size_recom']);//!!!!


            if ($data['status_sitemap'] == 'OK') {
                $a_sheets->getStyle('C14:C15')->applyFromArray($style_fill_green);
            } else {
                $a_sheets->getStyle('C14:C15')->applyFromArray($style_fill_red);
            }

            $a_sheets->setCellValue('A14', '5')
                ->setCellValue('B14', $data['verification']['sitemap'])
                ->setCellValue('C14', $data['status_sitemap'])
                ->setCellValue('D14', $data['verification']['stat'])
                ->setCellValue('D15', $data['verification']['recom'])
                ->setCellValue('E14', $data['sitemap_status'])
                ->setCellValue('E15', $data['sitemap_recom']);//!!!!


            if ($data['status_code'] == 'OK') {
                $a_sheets->getStyle('C17:C18')->applyFromArray($style_fill_green);
            } else {
                $a_sheets->getStyle('C17:C18')->applyFromArray($style_fill_red);
            }

            $a_sheets->setCellValue('A17', '6')
                ->setCellValue('B17', $data['verification']['code'])
                ->setCellValue('C17', $data['status_code'])
                ->setCellValue('D17', $data['verification']['stat'])
                ->setCellValue('D18', $data['verification']['recom'])
                ->setCellValue('E17', $data['robots_code_status'])
                ->setCellValue('E18', $data['robots_code_recom']);//!!!!
        }


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Test ' . $data['url'] . '.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer_obj = \PHPExcel_IOFactory::createWriter(self::$php_excel, 'Excel2007');
        $writer_obj->save('php://output');
    }


}