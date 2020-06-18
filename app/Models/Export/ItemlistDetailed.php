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

Class ItemlistDetailed {
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
		header('Content-Disposition: attachment;filename=ItemList_Detailed_'.date('M_d_Y').'.xlsx');
		header('Cache-Control: max-age=0');

		$objPHPExcel = new PHPExcel;
		$items = $this->items->execute();

		$objPHPExcel->getActiveSheet()->getStyle("A2:G4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



		$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
		// $objPHPExcel->getActiveSheet()->SetCellValue("A2","JEHAN CORPORATION");
		$objPHPExcel->getActiveSheet()->SetCellValue("A2",$this->company->execute()[0]->value);
		$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
		$objPHPExcel->getActiveSheet()->SetCellValue("A3","MERCHANDISE INVENTORY");
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
		$objPHPExcel->getActiveSheet()->SetCellValue("A4","as of ".date('M d, Y'));

		$objPHPExcel->getActiveSheet()->SetCellValue('A6',"CODE");
		$objPHPExcel->getActiveSheet()->SetCellValue('B6',"PRODUCT");
		$objPHPExcel->getActiveSheet()->SetCellValue('C6',"QUANTITY");
		$objPHPExcel->getActiveSheet()->SetCellValue('D6',"UNIT");
		$objPHPExcel->getActiveSheet()->SetCellValue('E6',"BARCODE");
		$objPHPExcel->getActiveSheet()->SetCellValue('F6',"SERIAL");
		$objPHPExcel->getActiveSheet()->SetCellValue('G6',"DESCRIPTION/SPECS");

		$objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(['fill'=>['type'=>PHPExcel_Style_Fill::FILL_SOLID,'color'=>['rgb' => '080808 '],],'font'  => [
            	'color' => ['rgb' => 'FFFFFF'],
            	//'underline' => 'single',
         	],]);


		$line = 7;

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
            	  $objPHPExcel->getActiveSheet()->getStyle('A'.$line.":".'G'.$line)->applyFromArray(self::$warning);
            }else if($status == 2){
            	  $objPHPExcel->getActiveSheet()->getStyle('A'.$line.":".'G'.$line)->applyFromArray(self::$danger);
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,$item->productCode);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$line,$item->description);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,$quantity);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$line,$item->unitMeasurement);

			$objPHPExcel->getActiveSheet()->getStyle("A".$line.":"."G".$line)->applyFromArray(self::$border);

			foreach($item->itemlist as $itemlist){
				if($itemlist->qty > 0 && $itemlist->freeStorage == 0){
						$line++;
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,$itemlist->qty);
						$objPHPExcel->getActiveSheet()->SetCellValue('D'.$line,$item->unitMeasurement);
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.$line,$itemlist->barcode);
						$objPHPExcel->getActiveSheet()->SetCellValue('F'.$line,$itemlist->serialNumber);
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.$line,$itemlist->description);
				}


			}


            $line++;
        }


        $line++;
		$line++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,"PREPARED BY:");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$line,Auth::User()->name);
		$line++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,"DATE & TIME:");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$line,date('M d, Y h:i a',time()));


		foreach(self::$letterArray as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		// Write the Excel file to filename some_excel_file.xlsx in the current directory


	 	$objWriter->save('php://output');

	}




}