<?php

namespace App\Models\Export;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use Auth;


Class ReturnItem {

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

	private static $item = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => 'F2F2F2'],
    		],
	];

	private static $logs = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => 'F8F8E7'],
    		],
    			'font'  => [
            	'color' => ['rgb' => '343A40'],
            	//'underline' => 'single',
         	],
	];

	private static $total = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => 'FFE4E1'],
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

	public function execute($viewModel,$field,$items){
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=Return_Reports_Per_Items_'.$field->datefrom.'_TO_'.$field->dateto.'.xlsx');
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
	


		$objPHPExcel->getActiveSheet()->getStyle("A1:J4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
		// $objPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$objPHPExcel->getActiveSheet()->SetCellValue("A2",$viewModel->getCompanySetting()[0]->value);
		$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:J3');
		$objPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A4:J4');
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","Return Report Per Item From: ".date_format(date_create($field->datefrom),'M d, Y')." To: ".date_format(date_create($field->dateto),'M d, Y'));


		$row = 6;

		foreach($items as $item){
			$qty_total = 0;

			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':J'.$row);
		 	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$item->description." - ".$item->productCode);
		 	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray(self::$item);
		 	$row++;
		 	if(count($viewModel->getReturn_PerItem($item->id,$field->datefrom,$field->dateto)) > 0){

		 				$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray(self::$siteheader);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"Date");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"RE RefNo");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,"Site");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,"Barcode");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,"Serial");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"Specs/Description");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,"Qty");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,"Unit");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,"Created By");
		 				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,"Approved By");

		 				$row++;

		 				foreach($viewModel->getReturn_PerItem($item->id,$field->datefrom,$field->dateto) as $reitem){

		 				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,date_format(date_create($reitem->datereturn),'M d, Y'));
		 				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$reitem->return->refNo);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$reitem->return->client->name);

		 				if($reitem->itemlist->freeStorage == 0){
		 					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$reitem->itemlist->barcode);
		 				}

		 				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$reitem->itemlist->serialNumber);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$reitem->itemlist->description);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$reitem->qty);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$reitem->item->unitMeasurement);
		 				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$reitem->return->user->name." ".date_format(date_create($reitem->return->created_at),"M d, Y h:i a"));
		 				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$reitem->return->approvedby." ".date_format(date_create($reitem->return->ApprovedDateTime),"M d, Y h:i a"));

		 				$row++;
		 				$qty_total += $reitem->qty;

		 				}


		 	}


		 	$objPHPExcel->getActiveSheet()->getStyle('G'.$row.":H".$row)->applyFromArray(self::$total);
		 	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"TOTAL");
		 	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$qty_total);
		 	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$item->unitMeasurement);
		 	$row+=2;

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