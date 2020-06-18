<?php

namespace App\Models\Export;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use Auth;


Class ReturnSite {
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

	public function execute($viewModel,$field,$sites){
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=Return_Reports_Per_Sites_'.$field->datefrom.'_TO_'.$field->dateto.'.xlsx');
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
	


		$objPHPExcel->getActiveSheet()->getStyle("A1:K4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()->mergeCells('A2:K2');
		// $objPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$objPHPExcel->getActiveSheet()->SetCellValue("A2",$viewModel->getCompanySetting()[0]->value);
		$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:K3');
		$objPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A4:K4');
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","Return Report Per Site From: ".date_format(date_create($field->datefrom),'M d, Y')." To: ".date_format(date_create($field->dateto),'M d, Y'));


		$row = 6;

		 foreach($sites as $site){
		 		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':K'.$row);
		 		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$site->name);
		 		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray(self::$site);
		 		$row++;
		 		if(count($viewModel->getReturn_PerSite($site->id,$field->datefrom,$field->dateto))>0){
		 			$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':K'.$row)->applyFromArray(self::$siteheader);
		 			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"Date");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"RE RefNo");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,"Item");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,"ProductCode");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,"Barcode");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"Serial");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,"Specs/Description");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,"Qty");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,"Unit");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,"Created By");
		 			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,"Approved By");
		 			$row++;
		 			foreach($viewModel->getReturn_PerSite($site->id,$field->datefrom,$field->dateto) as $returndata){
		 				foreach($returndata->returnitem as $reitem){
		 					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,date_format(date_create($returndata->datereturn),'M d, Y'));
				 			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$returndata->refNo);
				 			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$reitem->item->description);
				 			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$reitem->item->productCode);

				 			if($reitem->itemlist->freeStorage == 0){
				 				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$reitem->itemlist->barcode);
				 			}
				 			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$reitem->itemlist->serialNumber);
				 			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$reitem->itemlist->description);
				 			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$reitem->qty);
				 			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$reitem->item->unitMeasurement);
				 			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$returndata->user->name." ".date_format(date_create($returndata->created_at),"M d, Y h:i a"));
				 			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$returndata->approvedby." ".date_format(date_create($returndata->ApprovedDateTime),"M d, Y h:i a"));
		 					$row++;

		 				}

		 			}

		 		}

		 		$row++;
		 }

		$row++;
		$row++;
		$row++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"PREPARED BY:");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,Auth::User()->name);
		$row++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"DATE & TIME:");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,date('M d, Y h:i a',time()));

		foreach(self::$letterArray as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		// Write the Excel file to filename some_excel_file.xlsx in the current directory


	 	$objWriter->save('php://output');
	}
}