<?php
require 'vendor/autoload.php';

/*
Didgits to words convertor
*/
class NumToWords 
{
	
	public function convert($arg)
	{
		$str = round($arg,2)
		$firsrS = explode(".", $str);
		$arr = str_split(strrev($firsrS[0]),3);
		$toTwenty = array('1' => 'одна ', '2' => 'дві ', '3' => 'три ','4' => 'чотири ','5' => "п'ять ",'6' => 'шість ','7' => 'сім ','8' => 'вісім ','9' => "дев'ять ",'10' => 'десять ','11' => 'одинадцять ','12' => 'дванадцять ','13' => 'тринадцять ','14' => 'чотирнадцять ','15' => "п'ятнадцять ",'16' => 'шістнадцять ','17' => 'сімнадцять ','18' => 'вісімнадцять ','19' => "дев'ятнадцять ");
		$tens = array('2' => 'двадцять ', '3' => 'тридцять ','4' => 'сорок ','5' => "п'ятдесят ",'6' => 'шістдесят ','7' => 'сімдесят ','8' => 'вісімдесят ','9' => "дев'яносто ");
		$hundred = array('1' => 'сто ', '2' => 'двісті ', '3' => 'триста ','4' => 'чотириста ','5' => "п'ятсот ",'6' => 'шістсот ','7' => 'сімсот ','8' => 'вісімсот ','9' => "дев'ятсот ");
		$upper = array('1' => 'один ', '2' => 'двa ');
		$uahName = 'грив';
		$coinName = 'копій';
		$thousName = 'тисяч';
		$mlnName = array('2' => 'мільйон', '3' => 'мільярд', '4' => 'трильйон', '5' => 'квадрильйон');
		$endings = array('0' => ' ', '1' => 'и ', '2' => 'ів ', '3' => 'ня ', '4' => 'ні ', '5' => 'ень ', '6' => 'ка ', '7' => 'ки ', '8' => 'ок ','9' => 'a ', '10' => 'і ');
		$startNum = count($arr)-1;
		$key = '';
		for ($y=$startNum; $y >= 0 ; $y--) {//start convert from biger to smaler
			
		$rev 	 						=	 strrev($arr[$y]);
		$lessThanHun 					= 	 $rev % 100;
		$nums 							= 	 $lessThanHun % 10;
		$teens							=	 floor($lessThanHun/10);
			if($rev!=0){// if whole block $arr[$y] == 0
				if($rev>=100)	{

					$numOfHundred 		= 	 floor($rev/100);
					$key    			=	 $key.$hundred[$numOfHundred];

				}

				if($lessThanHun >=20){

						$numOfTens		= 	 floor($lessThanHun/10);
						$key			=	 $key.$tens[$numOfTens];

					if($y>=2){
						if($nums==1 || $nums ==2){//gender sensivity

							$key 		=	 $key.$upper[$nums];

						}else{

							$key		=	 $key.$toTwenty[$nums];

						}
					}else{

							$key		=	 $key.$toTwenty[$nums];
					}


				}elseif ($lessThanHun < 20 && $lessThanHun!=0) {
					if($y>=2){
						if($lessThanHun==1 || $lessThanHun ==2){//gender sensivity

							$key 		=	 $key.$upper[$lessThanHun];

						}else{

							$key		= 	 $key.$toTwenty[$lessThanHun];

						}
					}else{

							$key		= 	 $key.$toTwenty[$lessThanHun];

						}		
				}
			
				if($y>=2){// name num > 1 mln
					if($teens!=1){
						if($nums==1){

							$key		= 	 $key.$mlnName[$y].$endings[0];
						}elseif($nums>1 && $nums<5){
							$key		= 	 $key.$mlnName[$y].$endings[1];
						}else{
							$key		= 	 $key.$mlnName[$y].$endings[2];
						}
					}else{
							$key 		= 	 $key.$mlnName[$y].$endings[2];
					}

				}if ($y==1) {// thuosend plural names
					if($teens!=1){
						if($nums==1){

						$key 			= 	 $key.$thousName.$endings[9];

						}elseif($nums>1 && $nums<5){

						$key 			= 	 $key.$thousName.$endings[10];

						}else{

						$key 			= 	 $key.$thousName.$endings[0];

						}
					}else{
						$key 			= 	 $key.$thousName.$endings[0];
					}
				}

			} // Here ends condition if block $arr[$y] == 0
		// adding currensy plural names
			if ($y==0) {
				if($teens!=1){
					if($nums==1){
						$key 			= 	 $key.$uahName.$endings[3];
					}elseif($nums>1 && $nums<5){
						$key 			= 	 $key.$uahName.$endings[4];
					}else{
						$key 			= 	 $key.$uahName.$endings[5];
					}
				}else{
						$key 			= 	 $key.$uahName.$endings[5];
				}

			}

				

		}

	// coins quantity 
		if(strlen($firsrS[1])==1){//one digit protection (0.5 == "fifty" not "five")
						$key			= 	 $key.", ".$tens[$firsrS[1]];
						$key 			= 	 $key.$coinName.$endings[8];// coins plural names
		}else{
			if($firsrS[1] >=20){

						$numOfTens		= 	 floor($firsrS[1]/10);
						$key			=	 $key.", ".$tens[$numOfTens];
						$nums 			= 	 $firsrS[1] % 10;
						$key			=	 $key.$toTwenty[$nums];
				
			}else{
						$withOutZero	=	 ($firsrS[1]/10)*10;
						$key			= 	 $key.", ".$toTwenty[$withOutZero];

			}
	
			if($firsrS[1]==1){// coins plural names
						$key 			= 	 $key.$coinName.$endings[6];
				}elseif($firsrS[1]>1 && $firsrS[1]<5){
						$key 			= 	 $key.$coinName.$endings[7];
				}else{
						$key 			= 	 $key.$coinName.$endings[8];
			}

		}
	}
}
