<?php
	session_start();
	// include_once 'config.php';
// 	header("Content-type: text/");
// header("Content-Disposition: attachment; filename=file.csv");
// header("Pragma: no-cache");
// header("Expires: 0");
// print_r($_SESSION['final_opt']);

 header("Content-type: text/plain");
 header("Content-Disposition: attachment; filename=savethis.txt");
 
 // echo '<pre>';
 // var_dump($_SESSION);
foreach($_SESSION['final_opt'] as $key => $val){

	// print_r($val);
	echo $key."\n";
	// echo 

}
?>