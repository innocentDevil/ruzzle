<?php
	include_once 'config.php';


	if(isset($_POST['action'])){

		extract($_POST);
		switch ($action) {
			case 'setSession':
				
				for($i=1;$i<=16;$i++){
					$tmp_char = 'char_'.$i;
					$tmp_base = 'base_'.$i;
					$tmp_spl = 'charSpl_'.$i;
					if(isset($$tmp_char) && !empty($$tmp_char))
						$_SESSION['matrix'][$i] = $$tmp_char;
						$_SESSION['word_base_score'][$i] = (isset($$tmp_base) && !empty($$tmp_base)) ? $$tmp_base : 1;
						$_SESSION['word_spl_score'][$i] = (isset($$tmp_spl) && !empty($$tmp_spl)) ? $$tmp_spl : "";
				}

				print_r($_SESSION['matrix']);

				$_SESSION['tmp_val'] = $_SESSION['final_word_cell'] = $_SESSION['final_opt'] = $_SESSION['word_score'] = array();

			break;

			case 'getWord':

				
				// $_SESSION['word_cell'] = array();
				
					

				for($j=1;$j<=5;$j++){	
					getword($cellCnt, $j, $_SESSION['matrix'][$cellCnt]);
				}

				echo "done";

			break;

			case 'getWordWithScore':
				// print_r($_SESSION['tmp_val']);
				$dataFile = 'master';
				$dataFile_records = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

				$match = array_intersect($_SESSION['tmp_val'],$dataFile_records);
				$match_score = array();
				foreach($match as $tmpK => $tmpV){
					$tmpScore =  getScore($_SESSION['final_word_cell'][$tmpK]);
					$match_score[] = array("word" => $tmpK, "score" => $tmpScore);
					$_SESSION['final_opt'][$tmpK] = $tmpScore;

				}
				echo json_encode($_SESSION['final_opt']);
			break;
			
			
		}
	}

?>