<?php

namespace App\Models\Export;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use Auth;

Class DeliveryRef {

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

	public function execute($viewModel,$field,$diitems){
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=Outbound_Reports_Daily_'.$field->datefrom.'_TO_'.$field->dateto.'.xlsx');
		header('Cache-Control: max-age=0');

		$dijPHPExcel = new PHPExcel;


		foreach(range('A', 'K') as $columnID) {
 	$dijPHPExcel->getActiveSheet()->calculateColumnWidths();

		// Set setAutoSize(false) so that the widths are not recalculated
		foreach(range('A', 'K') as $columnID) {
		    $dijPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(false);
		}
  		// $dijPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
	


		$dijPHPExcel->getActiveSheet()->getStyle("A1:I4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$dijPHPExcel->getActiveSheet()->mergeCells('A2:I2');
		// $dijPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$dijPHPExcel->getActiveSheet()->SetCellValue("A2",$viewModel->getCompanySetting()[0]->value);
		$dijPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$dijPHPExcel->getActiveSheet()->mergeCells('A3:I3');
		$dijPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$dijPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$dijPHPExcel->getActiveSheet()->mergeCells('A4:I4');
		$dijPHPExcel->getActiveSheet()->SetCellValue("A4","Outbound Report Daily From: ".date_format(date_create($field->datefrom),'M d, Y')." To: ".date_format(date_create($field->dateto),'M d, Y'));


		$row = 6;

		foreach($viewModel->getDateRange($field->datefrom,$field->dateto) as $date){
			if(count($viewModel->getDeliveryData($date))>0){
			$dijPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
			$dijPHPExcel->getActiveSheet()->SetCellValue('A'.$row,date_format(date_create($date),'M d, Y'));
			$dijPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray(self::$date);

			foreach($viewModel->getDeliveryData($date) as $di){
				$row++;
				$dijPHPExcel->getActiveSheet()->SetCellValue("A".$row,$di->refNo);
				$dijPHPExcel->getActiveSheet()->SetCellValue("B".$row,$di->client->name);
				$dijPHPExcel->getActiveSheet()->getStyle('A'.$row.":I".$row)->applyFromArray(self::$refno);
				$row++;
				$dijPHPExcel->getActiveSheet()->getStyle('A'.$row.":I".$row)->applyFromArray(self::$siteheader);
				$dijPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"Product");
				$dijPHPExcel->getActiveSheet()->SetCellValue('B'.$row,"Barcode");
				$dijPHPExcel->getActiveSheet()->SetCellValue('C'.$row,"Serial");
				$dijPHPExcel->getActiveSheet()->SetCellValue('D'.$row,"Specs/Description");
				$dijPHPExcel->getActiveSheet()->SetCellValue('E'.$row,"Qty");
				$dijPHPExcel->getActiveSheet()->SetCellValue('F'.$row,"Unit");
				$dijPHPExcel->getActiveSheet()->SetCellValue('G'.$row,"Remarks");
				$dijPHPExcel->getActiveSheet()->SetCellValue('H'.$row,"Created By");
				$dijPHPExcel->getActiveSheet()->SetCellValue('I'.$row,"Approved By");
			
				foreach($di->dispatchitem as $diitem){
					$row++;
					$dijPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$diitem->item->description);
					if($diitem->itemlist_id != NULL){
					$dijPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$diitem->itemlist->barcode);
					$dijPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$diitem->itemlist->serialNumber);
					$dijPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$diitem->itemlist->description);
					}

					$dijPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$diitem->qty);
					$dijPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$diitem->uom);
					$dijPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$diitem->remarks);
					$dijPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$diitem->dispatch->user->name." ".date_format(date_create($diitem->dispatch->created_at),"M d, Y h:i a"));
					$dijPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$diitem->dispatch->approvedby." ".date_format(date_create($diitem->dispatch->ApprovedDateTime),"M d, Y h:i a"));
					
				}


			}

			$row+=2;
			}
		}
		

		$row++;
		$row++;
		$row++;
		$dijPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"PREPARED BY:");
		$dijPHPExcel->getActiveSheet()->SetCellValue('B'.$row,Auth::User()->name);
		$row++;
		$dijPHPExcel->getActiveSheet()->SetCellValue('A'.$row,"DATE & TIME:");
		$dijPHPExcel->getActiveSheet()->SetCellValue('B'.$row,date('M d, Y h:i a',time()));

		foreach(self::$letterArray as $columnID) {
			$dijPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
		}

		$dijWriter = new PHPExcel_Writer_Excel2007($dijPHPExcel); 
		// Write the Excel file to filename some_excel_file.xlsx in the current directory


	 	$dijWriter->save('php://output');
	}

}