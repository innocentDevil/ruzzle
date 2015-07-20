<?php
	session_start();
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



	function getword($cellCnt, $charCount, $startChar, $explode_cell = array()){
		// echo '<pre>';
		// 		print_r($explode_cell);
		$opt = array();
		$matrix_rel = unserialize(MATRIX_REL);
		// $_SESSION['word_cell'][] = $cellCnt;
		if($charCount==1){
			foreach($matrix_rel[$cellCnt] as $key => $value){
				if(!in_array($value, $explode_cell)){

					$tmp_array = $explode_cell;
					$tmp_array[] = $cellCnt;
					$tmp_array[] = $value;
					$tmp_word = $startChar.$_SESSION['matrix'][$value];

					// $tmp_score = getScore($tmp_array);

					// if(in_array(strtolower($tmp_word),$_SESSION['tmp_val'])){
					// 	if($tmp_score > $_SESSION['word_score'][$tmp_word]){
					// 		$_SESSION['word_score'][$tmp_word] =  $tmp_score;
					// 	}

					// }else{
					// 	$_SESSION['word_score'][$tmp_word] =  $tmp_score;
					// }

					$_SESSION['tmp_val'][$tmp_word] = strtolower($tmp_word); 
					$_SESSION['final_word_cell'][$tmp_word] = $tmp_array;					
					// $explode_cell = array();				
					// echo '<br>';		
				}			
			}
		}else{
			for($p=$charCount; $p>=1; $p--){		

				$explode_cell[$cellCnt] = $cellCnt;
				
				foreach($matrix_rel[$cellCnt] as $key => $value){

					if(!in_array($value, $explode_cell)){
						
						// $explode_cell[$value] = $value;
						$tmp_word = $startChar.$_SESSION['matrix'][$value];
						$tmp_charCount = $charCount - 1;
						getword($value,$tmp_charCount, $tmp_word, $explode_cell);
						// 
					}
					
				}

				// $explode_cell = array() ;				
			}
		}
	}


	function getScore($param){
		// print_r($param);
		$baseCount = 0;
		$doubleCount = 0;
		$tripleCount = 0;
		$finalCount = 0;
		if(isset($param) && !empty($param)){
			foreach($param  as $key => $val){
				 $tmp = $_SESSION['word_base_score'][$val];
				 

				if($_SESSION['word_spl_score'][$val]=="TL")
					$tmp = $tmp * 3;


				if($_SESSION['word_spl_score'][$val]=="DL")
					$tmp = $tmp * 2;

				if($_SESSION['word_spl_score'][$val]=="TW")
					$tripleCount++;

				if($_SESSION['word_spl_score'][$val]=="DW")
					$doubleCount++;


				$baseCount = $baseCount + $tmp;

			}


			if(!empty($doubleCount) && !empty($tripleCount))
				$finalCount = $baseCount;
			

			
			for($i=1;$i<=$doubleCount;$i++){

				$finalCount = $finalCount + $baseCount * 2;
			}

			for($i=1;$i<=$tripleCount;$i++){

				$finalCount = $finalCount + $baseCount * 3;
			}

			if(empty($finalCount))
				$finalCount = $baseCount;

			return $finalCount;
		}

	}
?>