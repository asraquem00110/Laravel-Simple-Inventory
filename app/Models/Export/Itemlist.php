<?php

namespace App\Models\Export;

use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use App\Models\Item\getItemData;
use App\Models\ItemList\Itemlist as ItemlistModel;
use App\Models\Setting\getCompany;
use Auth;

Class Itemlist {
	private $company;
	private $items = NULL;
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

	private static $letterArray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];

	public function __construct(getItemData $items,getCompany $company){
		$this->items = $items;
		$this->company = $company;
	}

	public function execute(){
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=ItemList_Summary_'.date('M_d_Y').'.xlsx');
		header('Cache-Control: max-age=0');

		$objPHPExcel = new PHPExcel;
		$items = $this->items->execute();


		foreach(range('A', 'N') as $columnID) {
 	$objPHPExcel->getActiveSheet()->calculateColumnWidths();

		// Set setAutoSize(false) so that the widths are not recalculated
		foreach(range('A', 'N') as $columnID) {
		    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(false);
		}
  		// $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
	
		
		$objPHPExcel->getActiveSheet()->getStyle("A1:N9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()->SetCellValue('L1',"ANNEX A");
		$objPHPExcel->getActiveSheet()->getStyle("L1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("L1")->getFont()->setSize(18);


		$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');
		// $objPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$objPHPExcel->getActiveSheet()->SetCellValue("A2",$this->company->execute()[0]->value);
		$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:N3');
		$objPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A4:N4');
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","as of ".date('M d, Y'));
	
		$objPHPExcel->getActiveSheet()->mergeCells('A6:B9');
		$objPHPExcel->getActiveSheet()->SetCellValue("A6","PRODUCT CODE");


		$objPHPExcel->getActiveSheet()->mergeCells('C6:C9');
		$objPHPExcel->getActiveSheet()->SetCellValue("C6","ITEM DESCRIPTION");



		$objPHPExcel->getActiveSheet()->mergeCells('D6:F6');
		$objPHPExcel->getActiveSheet()->SetCellValue("D6","LOCATION (Note 1)");
	

		$objPHPExcel->getActiveSheet()->mergeCells('D7:D9');
		$objPHPExcel->getActiveSheet()->SetCellValue("D7","ADDRESS");


		$objPHPExcel->getActiveSheet()->mergeCells('E7:E9');
		$objPHPExcel->getActiveSheet()->SetCellValue("E7","CODE");



		$objPHPExcel->getActiveSheet()->mergeCells('F7:F9');
		$objPHPExcel->getActiveSheet()->SetCellValue("F7","REMARKS");



		$objPHPExcel->getActiveSheet()->mergeCells('G6:G8');
		$objPHPExcel->getActiveSheet()->SetCellValue("G6","INVENTORY VALUATION METHOD");
		;

		$objPHPExcel->getActiveSheet()->SetCellValue("G9","(Note 2)");

		$objPHPExcel->getActiveSheet()->mergeCells('H6:I9');
		$objPHPExcel->getActiveSheet()->SetCellValue("H6","UNIT PRICE");

		$objPHPExcel->getActiveSheet()->mergeCells('J6:J9');
		$objPHPExcel->getActiveSheet()->SetCellValue("J6","QUANTITY IN STOCKS");

		$objPHPExcel->getActiveSheet()->mergeCells('K6:K7');
		$objPHPExcel->getActiveSheet()->SetCellValue("K6","UNIT OF MEASUREMENT");

		$objPHPExcel->getActiveSheet()->SetCellValue("K8","(In weight or volume)");
		$objPHPExcel->getActiveSheet()->SetCellValue("K9","e.g., kilos, grams, liters, etc.)");


		$objPHPExcel->getActiveSheet()->mergeCells('L6:L9');
		$objPHPExcel->getActiveSheet()->SetCellValue("L6","TOTAL WEIGHT / VOLUME");

		$objPHPExcel->getActiveSheet()->mergeCells('M6:N9');
		$objPHPExcel->getActiveSheet()->SetCellValue("M6","TOTAL COST");


		$line = 10;

		foreach($items as $item){
			$list = $item->itemList;
			$quantity = ItemlistModel::getTotal($list);

			$status = 3;

			if($quantity <= $item->warning && $quantity >= $item->danger){
                $status = 0; 
            }elseif($quantity <= $item->danger && $quantity > 0){
                $status = 1; 
            }elseif($quantity <= 0){
                $status = 2; 
            }

            if($status == 1){
            	  $objPHPExcel->getActiveSheet()->getStyle('C'.$line)->applyFromArray(self::$warning);
            	  $objPHPExcel->getActiveSheet()->getStyle('J'.$line)->applyFromArray(self::$warning);
            }else if($status == 2){
            	  $objPHPExcel->getActiveSheet()->getStyle('C'.$line)->applyFromArray(self::$danger);
            	  $objPHPExcel->getActiveSheet()->getStyle('J'.$line)->applyFromArray(self::$danger);
            }




			$objPHPExcel->getActiveSheet()->mergeCells('A'.$line.':B'.$line.'');
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,$item->productCode);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,$item->description);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$line,"PASIG");
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$line,"Standard");
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$line,"₱");
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$line,$quantity);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$line,$item->unitMeasurement);
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$line,"₱");
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$line," ");
			$line++;
		}

	
		
		$objPHPExcel->getActiveSheet()->getStyle("A6:N".($line-1)."")->applyFromArray(self::$border);

		// foreach(self::$letterArray as $columnID) {
		// 	$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
		// 	->setAutoSize(true);
		// }

		$line++;
		$line++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$line.':B'.$line.'');
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,"PREPARED BY:");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,Auth::User()->name);
		$line++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$line.':B'.$line.'');
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,"DATE & TIME:");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,date('M d, Y h:i a',time()));



		$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);	
		$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
	

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		// Write the Excel file to filename some_excel_file.xlsx in the current directory


	 	$objWriter->save('php://output');

	}

}