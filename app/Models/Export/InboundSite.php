<?php

namespace App\Models\Export;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use Auth;

Class InboundSite {

	private static $border = [
			'borders'=> [
				'allborders' => [
					'style'=> PHPExcel_Style_Border::BORDER_THIN,
				],
			],
	];

	private static $warning = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => 'FFA500'],
    		],
	];

	private static $danger = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => '800000'],
    		],
    		'font'  => [
            	'color' => ['rgb' => 'FFFFFF'],
            	//'underline' => 'single',
         	],
	];

	private static $site = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => 'F2F2F2'],
    		],
	];

	private static $siteheader = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => 'D7F8D7'],
    		],
	];

	private static $letterArray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];


	public function __construct(){

	}

	public function execute($viewModel,$field,$supplier){
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=Inbound_Reports_Per_Sites_'.$field->datefrom.'_TO_'.$field->dateto.'.xlsx');
		header('Cache-Control: max-age=0');

		$objPHPExcel = new PHPExcel;


		foreach(range('A', 'K') as $columnID) {
 	$objPHPExcel->getActiveSheet()->calculateColumnWidths();

		// Set setAutoSize(false) so that the widths are not recalculated
		foreach(range('A', 'K') as $columnID) {
		    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(false);
		}
  		// $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
	


		$objPHPExcel->getActiveSheet()->getStyle("A1:L4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()->mergeCells('A2:L2');
		// $objPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$objPHPExcel->getActiveSheet()->SetCellValue("A2",$viewModel->getCompanySetting()[0]->value);
		$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:L3');
		$objPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A4:L4');
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","Inbound Report Per Site From: ".date_format(date_create($field->datefrom),'M d, Y')." To: ".date_format(date_create($field->dateto),'M d, Y'));


		$row = 6;

		 foreach($supplier as $site){
		 		$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':L'.$row);
		 		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$site->name);
		 		$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray(self::$site);
		 		$row++;
		 		if(count($viewModel->getInbound_PerSite($site->id,$field->datefrom,$field->dateto))>0){
		 				$objPHPExcel->getActiveSheet()->getStyle('B'.$row.':L'.$row)->applyFromArray(self::$siteheader);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"Date");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,"IB RefNo");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,"Item");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,"ProductCode");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"Barcode");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,"Serial");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,"Specs/Description");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,"Qty");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,"Unit");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,"Created By");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,"Approved By");

		 				$row++;

		 				foreach($viewModel->getInbound_PerSite($site->id,$field->datefrom,$field->dateto) as $inbound){
		 					foreach($inbound->temp as $ibitem){
		 							$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,date_format(date_create($inbound->unloadDate),'M d, Y'));
					 				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$inbound->refNo);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$ibitem->item->description);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$ibitem->item->productCode);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$ibitem->itemlist->barcode);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$ibitem->itemlist->serialNumber);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$ibitem->itemlist->description);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$ibitem->quantity);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$ibitem->item->unitMeasurement);
					 				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$inbound->user->name." ".date_format(date_create($inbound->created_at),"M d, Y h:i a"));
					 				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$inbound->approvedBy." ".date_format(date_create($inbound->ApprovedDateTime),"M d, Y h:i a"));


		 						$row++;
		 					}
		 					
		 				}


		 		}

		 		$row++;
		 }

		$row++;
		$row++;
		$row++;
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"PREPARED BY:");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,Auth::User()->name);
		$row++;
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"DATE & TIME:");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,date('M d, Y h:i a',time()));

		foreach(self::$letterArray as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		// Write the Excel file to filename some_excel_file.xlsx in the current directory


	 	$objWriter->save('php://output');
	}

}