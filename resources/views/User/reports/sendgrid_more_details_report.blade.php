<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
    $spreadsheet = new Spreadsheet();
		// Set document properties
		$spreadsheet->getProperties()->setCreator("Updated List")
									 ->setLastModifiedBy("Updated List")
									 ->setTitle("Updated List")
									 ->setSubject("Registeration-report")
									 ->setDescription("Updated List")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Report");

$er = $spreadsheet->getActiveSheet(0);

	$er->setCellValue('A1', 'Sl no')
	    ->setCellValue('B1', 'Email ID')
	    ->setCellValue('C1', 'Message ID')
	    ->setCellValue('D1', 'Message status')
	    ->setCellValue('E1', 'Click status')
	    ->setCellValue('F1', 'Subject')
	    ->setCellValue('G1', 'Template ID')
	    ->setCellValue('H1', 'Process date');
		           $er->getStyle('A1:H1')
                                ->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB('93c939');
		              $styleArray = array(
                        'font'  => array(
                            'color' => array('rgb' => 'ffffff'),
                            'size'  => 10
                        ));
                    $er->getStyle('A1:H1')->applyFromArray($styleArray);
			  $i=2;
		  $j=1;
		foreach($details_list_report as $key => $list)  
		{
			
		$er->setCellValue('A'.$i, $j)
	 		->setCellValue('B'.$i,$list->email)
	 		->setCellValue('C'.$i,$list->msg_id)
	 		->setCellValue('D'.$i,$list->msg_status)
	 		->setCellValue('E'.$i,$list->clk_status ? $list->clk_status : "NA")
	 		->setCellValue('F'.$i,$list->subject ? $list->subject : "NA" )
	 		->setCellValue('G'.$i,$list->temp_id)
	 		->setCellValue('H'.$i,$list->proc_date);
	 		
		 	$i++;
		 	$j++;
		 	// sleep(20);
         }
         $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
];  
$er->getStyle('A1:H'.$i)->applyFromArray($styleArray);
		// $er->getStyle('A1:AF'.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// Rename worksheet
		 $style = array('font' => array('size' => 10));

		$spreadsheet->getActiveSheet()->getStyle('A1:H'.$i)->applyFromArray($style);
		$spreadsheet->getActiveSheet()->setTitle("Sendgrid each mail Details");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		// $spreadsheet->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=Updated List-'.date('Y-m-d').'.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
        header('Set-Cookie: fileDownload=true; path=/');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		// $objWriter = PHPExcel_IOFactory::createWriter($spreadsheet, 'Excel5');
        // $objWriter->save('php://output');
        $writer =  \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xls");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Updated-List-report'.date('d-m-y h:i:s').'.xls"');
        $writer->save("php://output");
        ?>
