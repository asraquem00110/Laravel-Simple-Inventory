<?php

namespace App\Traits;

trait CustomMethods {

	public static function getDateRange($startDate,$endDate,$format = "Y-m-d"){
		$datesArray = [];
		$total_days = round(abs(strtotime($endDate) - strtotime($startDate)) / 86400, 0) + 1;
		if($total_days < 0) { return false;}
		for($day = 0; $day < $total_days; $day++){
			$datesArray[] = date($format,strtotime("{$startDate} + {$day} days"));
		}

		return $datesArray;

	}

	public static function convertToObject(array $array){
			$data = new stdClass;
			foreach($array as $key => $value){
				if(is_array($value)){
					$value = convertToObject($value);
				}

				$data->$key = $value;
			}

			return $data;

	}

	public static function fillzeroes($required="6",$string="",$position=0){
		$newvalue = "";
		$fillzero = $required - strlen($string);
		$zeroes = "";
		for($x=0;$x<$fillzero;$x++){
			$zeroes = $zeroes."0";
		}

		if($position == 0){
			$newvalue = $zeroes.$string;
		}else{
			$newvalue = $string.$zeroes;
		}

		return $newvalue;
	}

}