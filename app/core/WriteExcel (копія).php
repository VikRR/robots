<?php

namespace robots\app\core;


class WriteExcel
{
    private static $php_excel;

    public static function write($data)
    {

        //$php_excel = new \PHPExcel();
        //
        //self::$php_excel = $php_excel;
        //
        //$php_excel->getProperties()->setTitle('Test');
        //
        //$php_excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        //$php_excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        //$php_excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        //$php_excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        //$php_excel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        //
        //$php_excel->setActiveSheetIndex(0)
        //    ->setCellValue('A1', '№')
        //    ->setCellValue('B1', 'Название проверки')
        //    ->setCellValue('C1', 'Статус')
        //    ->setCellValue('E1', 'Текущее состояние');

        //$php_excel->getActiveSheet()->setCellValue('A1', '№');
        //$php_excel->getActiveSheet()->setCellValue('B1', 'Название проверки');
        //$php_excel->getActiveSheet()->setCellValue('C1', 'Статус');
        //$php_excel->getActiveSheet()->setCellValue('E1', 'Текущее состояние');


        //$php_excel->getActiveSheet()->mergeCells('A3:4');
        //$php_excel->getActiveSheet()->setCellValue('A3', '1');
        //
        //$php_excel->getActiveSheet()->mergeCells('B3:4');
        //$php_excel->getActiveSheet()->setCellValue('B3', 'Проверка наличия файла robots.txt');
        //
        //$php_excel->getActiveSheet()->mergeCells('C3:4');
        //$php_excel->getActiveSheet()->setCellValue('C3', $data['status']);
        //
        //$php_excel->getActiveSheet()->setCellValue('D3', 'Состояние');
        //$php_excel->getActiveSheet()->setCellValue('D4', 'Зекомендации');
        //
        //$recom_ok = 'Доработки не требуется';
        //if ($data['status'] == 'ok') {
        //    $cond = 'Файл robots.txt присутствует';
        //    $recom = $recom_ok;
        //} else {
        //    $cond = 'Файл robots.txt отсутствует';
        //    $recom = 'Создать файл robots.txt и разместить его на сайте';
        //}
        //
        //$php_excel->getActiveSheet()->setCellValue('E3', $cond);
        //$php_excel->getActiveSheet()->setCellValue('E4', $recom);


    }

    public static function start($data)
    {

        //arr_($data);exit;

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
                    'type' => \PHPExcel_STYLE_FILL::FILL_SOLID,
                    'color'=>array(
                        'rgb' => 'ed4d72'
                    )
                )
            );

            $style_fill_green = array(
                'fill' => array(
                    'type' => \PHPExcel_STYLE_FILL::FILL_SOLID,
                    'color'=>array(
                        'rgb' => '38b14f'
                    )
                )
            );


        $php_excel->setActiveSheetIndex(0)
            ->setCellValue('A1', '№')
            ->setCellValue('B1', 'Название проверки')
            ->setCellValue('C1', 'Статус')
            ->setCellValue('E1', 'Текущее состояние');

        $a_sheets->mergeCells('A2:A3');
        $a_sheets->mergeCells('B2:B3');
        $a_sheets->mergeCells('C2:C3');

        //$a_sheets->setCellValue('A2', '1');
        //$a_sheets->setCellValue('B2', $data['verification']['file']);
        $a_sheets->setCellValue('C2', $data['status_exist_robots']);
        //$a_sheets->setCellValue('D2', $data['verification']['stat']);
        //$a_sheets->setCellValue('D3', $data['verification']['recom']);
        $a_sheets->setCellValue('E2', $data['exist_robots_status']);
        $a_sheets->setCellValue('E3', $data['exist_robots_recom']);

        if($data['status_exist_robots'] == 'OK'){
            $a_sheets->getStyle('C2:C3')->applyFromArray($style_fill_green);

            $a_sheets->mergeCells('A5:A6');
            $a_sheets->mergeCells('B5:B6');
            $a_sheets->mergeCells('C5:C6');

            $a_sheets->mergeCells('A8:A9');
            $a_sheets->mergeCells('B8:B9');
            $a_sheets->mergeCells('C8:C9');

            $a_sheets->mergeCells('A11:A12');
            $a_sheets->mergeCells('B11:B12');
            $a_sheets->mergeCells('C11:C12');

            $a_sheets->mergeCells('A14:A15');
            $a_sheets->mergeCells('B14:B15');
            $a_sheets->mergeCells('C14:C15');

            $a_sheets->mergeCells('A17:A18');
            $a_sheets->mergeCells('B17:B18');
            $a_sheets->mergeCells('C17:C18');

            $a_sheets->setCellValue('A2', '1');
            $a_sheets->setCellValue('A5', '2');
            $a_sheets->setCellValue('A8', '3');
            $a_sheets->setCellValue('A11', '4');
            $a_sheets->setCellValue('A14', '5');
            $a_sheets->setCellValue('A17', '6');

            $a_sheets->setCellValue('B2', $data['verification']['file']);
            $a_sheets->setCellValue('B5', $data['verification']['host']);
            $a_sheets->setCellValue('B8', $data['verification']['host_count']);
            $a_sheets->setCellValue('B11', $data['verification']['file_size']);
            $a_sheets->setCellValue('B14', $data['verification']['sitemap']);
            $a_sheets->setCellValue('B17', $data['verification']['code']);

            $a_sheets->setCellValue('D2', $data['verification']['stat']);
            $a_sheets->setCellValue('D3', $data['verification']['recom']);
            $a_sheets->setCellValue('D5', $data['verification']['stat']);
            $a_sheets->setCellValue('D6', $data['verification']['recom']);
            $a_sheets->setCellValue('D8', $data['verification']['stat']);
            $a_sheets->setCellValue('D9', $data['verification']['recom']);
            $a_sheets->setCellValue('D11', $data['verification']['stat']);
            $a_sheets->setCellValue('D12', $data['verification']['recom']);
            $a_sheets->setCellValue('D14', $data['verification']['stat']);
            $a_sheets->setCellValue('D15', $data['verification']['recom']);
            $a_sheets->setCellValue('D17', $data['verification']['stat']);
            $a_sheets->setCellValue('D18', $data['verification']['recom']);


        }else{
            $a_sheets->getStyle('C2:C3')->applyFromArray($style_fill_red);
        }

        if ($data['exist_robots']) {

            //$a_sheets->mergeCells('A5:A6');
            //$a_sheets->mergeCells('B5:B6');
            //$a_sheets->mergeCells('C5:C6');
            //
            //$a_sheets->mergeCells('A8:A9');
            //$a_sheets->mergeCells('B8:B9');
            //$a_sheets->mergeCells('C8:C9');
            //
            //$a_sheets->mergeCells('A11:A12');
            //$a_sheets->mergeCells('B11:B12');
            //$a_sheets->mergeCells('C11:C12');
            //
            //$a_sheets->mergeCells('A14:A15');
            //$a_sheets->mergeCells('B14:B15');
            //$a_sheets->mergeCells('C14:C15');
            //
            //$a_sheets->mergeCells('A17:A18');
            //$a_sheets->mergeCells('B17:B18');
            //$a_sheets->mergeCells('C17:C18');
            //
            //$a_sheets->setCellValue('A2', '1');
            //$a_sheets->setCellValue('A5', '2');
            //$a_sheets->setCellValue('A8', '3');
            //$a_sheets->setCellValue('A11', '4');
            //$a_sheets->setCellValue('A14', '5');
            //$a_sheets->setCellValue('A17', '6');
            //
            //$a_sheets->setCellValue('B2', $data['verification']['file']);
            //$a_sheets->setCellValue('B5', $data['verification']['host']);
            //$a_sheets->setCellValue('B8', $data['verification']['host_count']);
            //$a_sheets->setCellValue('B11', $data['verification']['file_size']);
            //$a_sheets->setCellValue('B14', $data['verification']['sitemap']);
            //$a_sheets->setCellValue('B17', $data['verification']['code']);
            //
            //$a_sheets->setCellValue('D2', $data['verification']['stat']);
            //$a_sheets->setCellValue('D3', $data['verification']['recom']);
            //$a_sheets->setCellValue('D5', $data['verification']['stat']);
            //$a_sheets->setCellValue('D6', $data['verification']['recom']);
            //$a_sheets->setCellValue('D8', $data['verification']['stat']);
            //$a_sheets->setCellValue('D9', $data['verification']['recom']);
            //$a_sheets->setCellValue('D11', $data['verification']['stat']);
            //$a_sheets->setCellValue('D12', $data['verification']['recom']);
            //$a_sheets->setCellValue('D14', $data['verification']['stat']);
            //$a_sheets->setCellValue('D15', $data['verification']['recom']);
            //$a_sheets->setCellValue('D17', $data['verification']['stat']);
            //$a_sheets->setCellValue('D18', $data['verification']['recom']);


            if($data['status_host'] == 'OK'){
                $a_sheets->getStyle('C5:C6')->applyFromArray($style_fill_green);




            }else{
                $a_sheets->getStyle('C5:C6')->applyFromArray($style_fill_red);
            }

            //$a_sheets->setCellValue('A5', '2');
            //$a_sheets->setCellValue('B5', $data['verification']['host']);
            $a_sheets->setCellValue('C5', $data['status_host']);
            //$a_sheets->setCellValue('D5', $data['verification']['stat']);
            //$a_sheets->setCellValue('D6', $data['verification']['recom']);
            $a_sheets->setCellValue('E5', $data['host_status']);
            $a_sheets->setCellValue('E6', $data['host_recom']);//!!!!

            //$a_sheets->mergeCells('A8:A9');
            //$a_sheets->mergeCells('B8:B9');
            //$a_sheets->mergeCells('C8:C9');

            //if($data['status_host_count'] == 'OK'){
            //    $a_sheets->getStyle('C8:C9')->applyFromArray($style_fill_green);
            //}else{
            //    $a_sheets->getStyle('C8:C9')->applyFromArray($style_fill_red);
            //}
            //
            //$a_sheets->setCellValue('A8', '3');
            //$a_sheets->setCellValue('B8', $data['verification']['host_count']);
            //$a_sheets->setCellValue('C8', $data['status_host_count']);
            //$a_sheets->setCellValue('D8', $data['verification']['stat']);
            //$a_sheets->setCellValue('D9', $data['verification']['recom']);
            //$a_sheets->setCellValue('E8', $data['host_count_status']);
            //$a_sheets->setCellValue('E9', $data['host_count_recom']);//!!!!
            //
            //$a_sheets->mergeCells('A11:A12');
            //$a_sheets->mergeCells('B11:B12');
            //$a_sheets->mergeCells('C11:C12');

            if($data['status_file_size'] == 'OK'){
                $a_sheets->getStyle('C11:C12')->applyFromArray($style_fill_green);
            }else{
                $a_sheets->getStyle('C11:C12')->applyFromArray($style_fill_red);
            }

            //$a_sheets->setCellValue('A11', '4');
            //$a_sheets->setCellValue('B11', $data['verification']['file_size']);
            $a_sheets->setCellValue('C11', $data['status_file_size']);
            //$a_sheets->setCellValue('D11', $data['verification']['stat']);
            //$a_sheets->setCellValue('D12', $data['verification']['recom']);
            $a_sheets->setCellValue('E11', $data['file_size_status']);
            $a_sheets->setCellValue('E12', $data['file_size_recom']);//!!!!

            //$a_sheets->mergeCells('A14:A15');
            //$a_sheets->mergeCells('B14:B15');
            //$a_sheets->mergeCells('C14:C15');

            if($data['status_sitemap'] == 'OK'){
                $a_sheets->getStyle('C14:C15')->applyFromArray($style_fill_green);
            }else{
                $a_sheets->getStyle('C14:C15')->applyFromArray($style_fill_red);
            }

            //$a_sheets->setCellValue('A14', '5');
            //$a_sheets->setCellValue('B14', $data['verification']['sitemap']);
            $a_sheets->setCellValue('C14', $data['status_sitemap']);
            //$a_sheets->setCellValue('D14', $data['verification']['stat']);
            //$a_sheets->setCellValue('D15', $data['verification']['recom']);
            $a_sheets->setCellValue('E14', $data['sitemap_status']);
            $a_sheets->setCellValue('E15', $data['sitemap_recom']);//!!!!

            //$a_sheets->mergeCells('A17:A18');
            //$a_sheets->mergeCells('B17:B18');
            //$a_sheets->mergeCells('C17:C18');

            if($data['status_code'] == 'OK'){
                $a_sheets->getStyle('C17:C18')->applyFromArray($style_fill_green);
            }else{
                $a_sheets->getStyle('C17:C18')->applyFromArray($style_fill_red);
            }

            //$a_sheets->setCellValue('A17', '6');
            //$a_sheets->setCellValue('B17', $data['verification']['code']);
            $a_sheets->setCellValue('C17', $data['status_code']);
            //$a_sheets->setCellValue('D17', $data['verification']['stat']);
            //$a_sheets->setCellValue('D18', $data['verification']['recom']);
            $a_sheets->setCellValue('E17', $data['robots_code_status']);
            $a_sheets->setCellValue('E18', $data['robots_code_recom']);//!!!!
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