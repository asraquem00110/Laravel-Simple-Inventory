<?php

namespace App\Models\Export;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use Auth;

Class InboundRef {

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
		header('Content-Disposition: attachment;filename=Inbound_Reports_Daily_'.$field->datefrom.'_TO_'.$field->dateto.'.xlsx');
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
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","Inbound Report Daily From: ".date_format(date_create($field->datefrom),'M d, Y')." To: ".date_format(date_create($field->dateto),'M d, Y'));


		$row = 6;

		foreach($viewModel->getDateRange($field->datefrom,$field->dateto) as $date){
			if(count($viewModel->getInboundLogs($date))>0 || count($viewModel->getInboundsData($date)) > 0){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,date_format(date_create($date),'M d, Y'));
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray(self::$date);

			foreach($viewModel->getInboundsData($date) as $ib){
				$row++;
				$objPHPExcel->getActiveSheet()->SetCellValue("A".$row,$ib->refNo);
				$objPHPExcel->getActiveSheet()->SetCellValue("B".$row,$ib->client->name);
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
			
				foreach($ib->temp as $item){
					$row++;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$item->item->description);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$item->itemList->barcode);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$item->itemList->serialNumber);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$item->itemList->description);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$item->quantity);
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$item->item->unitMeasurement);
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$item->itemList->remarks);
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$ib->user->name." ".date_format(date_create($ib->created_at),"M d, Y h:i a"));
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$ib->approvedBy." ".date_format(date_create($ib->ApprovedDateTime),"M d, Y h:i a"));
					
				}


			}

			if(count($viewModel->getInboundLogs($date))>0){
				$row++;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"LOGS");
				$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray(self::$logs);
				$row++;
				$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":I".$row)->applyFromArray(self::$siteheader);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"Product");
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"Barcode");
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,"Serial");
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,"Specs/Description");
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,"Qty");
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"Unit");
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,"Remarks");
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,"Modified By");
				$row++;
				foreach($viewModel->getInboundLogs($date) as $log){
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$log->item->description);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$log->itemlist->barcode);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$log->itemlist->serialNumber);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$log->itemlist->description);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,($log->newvalue - $log->oldvalue));
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$log->item->unitMeasurement);
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$log->remarks);
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$log->modifiedby." ".date_format(date_create($log->created_at),"M d, Y h:i a"));
					$row++;
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