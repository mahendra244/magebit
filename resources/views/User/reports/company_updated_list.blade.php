<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
	    ->setCellValue('B1', 'Name')
	    ->setCellValue('C1', 'Email')
	    ->setCellValue('D1', 'Phone')
	    ->setCellValue('E1', 'Company')
	    ->setCellValue('F1', 'Designation')
	    ->setCellValue('G1', 'City Name')
	    ->setCellValue('H1', 'Industry')
	    ->setCellValue('I1', 'Event Type')
	    ->setCellValue('J1', 'Event Name')
	    ->setCellValue('K1', 'Event Date')
	    ->setCellValue('L1', 'Unique')
	    ->setCellValue('M1', 'Unique Num')
	    ->setCellValue('N1', 'UTM Source')
	    ->setCellValue('O1', 'UTM Medium')
	    ->setCellValue('P1', 'UTM Campaign')
	    ->setCellValue('Q1', 'Status')
	    ->setCellValue('R1', 'Register Date')
	    ->setCellValue('S1', 'Attended')
	    ->setCellValue('T1', 'Unique Code')
	    ->setCellValue('U1', 'Org Id')
	    ->setCellValue('V1', 'PE Id')
	    ->setCellValue('W1', 'company name');
		           $er->getStyle('A1:W1')
                                ->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB('93c939');
		              $styleArray = array(
                        'font'  => array(
                            'color' => array('rgb' => 'ffffff'),
                            'size'  => 10
                        ));
                    $er->getStyle('A1:W1')->applyFromArray($styleArray);
			  $i=2;
		  $j=1;
		foreach($data as $key => $lead)  
		{
			
		$er->setCellValue('A'.$i, $j)
	 		->setCellValue('B'.$i,$lead->name)
	 		->setCellValue('C'.$i,$lead->email)
	 		->setCellValue('D'.$i,$lead->phone)
	 		->setCellValue('E'.$i,$lead->company)
	 		->setCellValue('F'.$i,$lead->designation)
	 		->setCellValue('G'.$i,$lead->city_name)
	 		->setCellValue('H'.$i,$lead->industry)
	 		->setCellValue('I'.$i,$lead->event_type)
	 		->setCellValue('J'.$i,$lead->event_name)
	 		->setCellValue('K'.$i,$lead->event_date)
	 		->setCellValue('L'.$i,$lead->is_unique)
	 		->setCellValue('M'.$i,$lead->is_unique_num)
	 		->setCellValue('N'.$i,$lead->utm_source)
	 		->setCellValue('O'.$i,$lead->utm_medium)
	 		->setCellValue('P'.$i,$lead->utm_campaign)
	 		->setCellValue('Q'.$i,$lead->status)
	 		->setCellValue('R'.$i,$lead->register_date)
	 		->setCellValue('S'.$i,$lead->is_attended)
	 		->setCellValue('T'.$i,$lead->unique_code)
	 		->setCellValue('U'.$i,$lead->org_id ? $lead->org_id : "NA")
	 		->setCellValue('V'.$i,$lead->pe_id ? $lead->pe_id : "NA")
	 		->setCellValue('W'.$i,$lead->company_updated ? $lead->company_updated : "NA");
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
$er->getStyle('A1:W'.$i)->applyFromArray($styleArray);
		// $er->getStyle('A1:AF'.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// Rename worksheet
		 $style = array('font' => array('size' => 10));

		$spreadsheet->getActiveSheet()->getStyle('A1:W'.$i)->applyFromArray($style);
		$spreadsheet->getActiveSheet()->setTitle("Updated List");


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
