<?php
session_start();
$_SESSION['tmp_val'] = array();
define('MATRIX_REL', serialize(
						array(
							1 => array(2,5,6),
							2 => array(1,3,5,6,7),
							3 => array(2,4,6,7,8),
							4 => array(3,7,8),
							5 => array(1,2,6,9,10),
							6 => array(1,2,3,5,7,9,10,11),
							7 => array(2,3,4,6,8,10,11,12),
							8 => array(3,4,7,11,12),
							9 => array(5,6,10,13,14),
							10 => array(5,6,7,9,11,13,14,15),
							11 => array(6,7,8,10,12,14,15,16),
							12 => array(7,8,11,15,16),
							13 => array(9,10,14),
							14 => array(9,10,11,13,15),
							15 => array(10,11,12,14,16),
							16 => array(11,12,15)						
						)
					)
		);



$_SESSION['matrix'] = array(
							1=>"w", 
							2=> "p", 
							3=> "a", 
							4=> "r", 
							5=> "i", 
							6=> "w", 
							7=> "t", 
							8=> "u", 
							9=> "b", 
							10=> "v", 
							11=> "e", 
							12=> "s", 
							13=> "r", 
							14=> "e", 
							15=> "l", 
							16=> "r", 
							);

$result = array();
	

// for($i=1; $i<=16; $i++){


$i = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : 1;

for($j=1;$j<=5;$j++){	
	getword($i, $j, $_SESSION['matrix'][$i]);
}
// }

echo implode(',', $_SESSION['tmp_val']).',';

function getword($cellCnt, $charCount, $startChar){

	
	$opt = array();
	$matrix_rel = unserialize(MATRIX_REL);


	// print_r($matrix_rel);


	// echo "cellCnt======".$cellCnt.", charCount=====".$charCount.", startChar=====".$startChar.'<br>';

	

	if($charCount==1){
		

		foreach($matrix_rel[$cellCnt] as $key => $value){
			$tmp_word = $startChar.$_SESSION['matrix'][$value];
			$_SESSION['tmp_val'][$tmp_word] = $tmp_word; 						
		}

	}else{

		for($p=$charCount; $p>=1; $p--){
			
			foreach($matrix_rel[$cellCnt] as $key => $value){
				$tmp_word = $startChar.$_SESSION['matrix'][$value];
				$tmp_charCount = $charCount - 1;
				
				getword($value,$tmp_charCount, $tmp_word);
			}
		
		}

	}

	

	// return $opt;
	
	// echo "==================================================================<br>";
}

?>