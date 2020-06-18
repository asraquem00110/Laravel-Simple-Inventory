<?php

namespace App\Models\Export;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use Auth;


Class ReturnRef {
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

	private static $date = [
			'fill' => [
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'color' => ['rgb' => '696969'],
    		],
    		'font'  => [
            	'color' => ['rgb' => 'FFFFFF'],
            	//'underline' => 'single',
         	],
	];

	private static $refno = [
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
		header('Content-Disposition: attachment;filename=Return_Reports_Daily_'.$field->datefrom.'_TO_'.$field->dateto.'.xlsx');
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
	


		$objPHPExcel->getActiveSheet()->getStyle("A1:I4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
		// $objPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$objPHPExcel->getActiveSheet()->SetCellValue("A2",$viewModel->getCompanySetting()[0]->value);
		$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
		$objPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","Return Report Daily From: ".date_format(date_create($field->datefrom),'M d, Y')." To: ".date_format(date_create($field->dateto),'M d, Y'));


		$row = 6;

		foreach($viewModel->getDateRange($field->datefrom,$field->dateto) as $date){
			if(count($viewModel->getReturnData($date))>0){
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,date_format(date_create($date),'M d, Y'));
				$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray(self::$date);

				foreach($viewModel->getReturnData($date) as $re){
					$row++;
					$objPHPExcel->getActiveSheet()->SetCellValue("A".$row,$re->refNo);
					$objPHPExcel->getActiveSheet()->SetCellValue("B".$row,$re->client->name);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":I".$row)->applyFromArray(self::$refno);
					$row++;
					$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":I".$row)->applyFromArray(self::$siteheader);
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"Product");
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"Barcode");
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,"Serial");
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,"Specs/Description");
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,"Qty");
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"Unit");
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,"Remarks");
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,"Created By");
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,"Approved By");

					foreach($re->returnitem as $item){
						$row++;
						$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$item->item->description);
						if($item->itemList->freeStorage == 0){
							$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$item->itemList->barcode);
						}
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$item->itemList->serialNumber);
						$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$item->itemList->description);
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$item->quantity);
						$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$item->item->unitMeasurement);
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$item->itemList->remarks);
						$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$re->user->name." ".date_format(date_create($re->created_at),"M d, Y h:i a"));
						$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$re->approvedby." ".date_format(date_create($re->ApprovedDateTime),"M d, Y h:i a"));

					}


				}


			$row+=2;
			}
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