<?php
	include_once 'config.php';
	
	$cellDefaultVal = array(
							1 => "O",
							2 => "S",
							3 => "L",
							4 => "C",
							5 => "E",
							6 => "L",
							7 => "A",
							8 => "I",
							9 => "T",
							10 => "A",
							11 => "N",
							12 => "T",
							13 => "M",
							14 => "Y",
							15 => "S",
							16 => "E"							
							);

	
	// print_r($_SESSION['dataFile_records']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Ruzzle - Word Game</title>
	
	<!-- Bootstrap -->
	<!--<link href="public/css/bootstrap.css" rel="stylesheet">-->
	<link href="public/css/style.css" rel="stylesheet">
	<style type="text/css">
		body { background:#3399FF;}
		.table1 td {  width:100px; height:100px; padding:10px; border:7px solid #3399FF; margin:10px; border-radius:20px;  background:#FFFFFF}
		.table1 td div { margin-top:10px;}
		.table1 td input { width:100%;}
		
		.table2 td { width:100px; height:100px; padding:10px; border:7px solid #3399FF; margin:10px; border-radius:20px;   background:#FFFFFF; position:relative;}
		.red { background:red}
		.orange { background:orange}
		.blue { background:blue;}
		.green { background: #00CC00}
		
		.table2 td.redBorder { border-color:red;}
		.table2 td.orangeBorder { border-color:orange;}
		.table2 td.blueBorder { border-color:blue;}
		.table2 td.greenBorder { border-color:#00CC00;}
		
		.setPosRel { position:relative; color:#000000; display:block; clear:both;}
		.PointNumber { position:absolute; top:10px; right:10px; font-weight:bold; font-size:15px;}
		.Special { position:absolute; top:-12px; left:-12px; border-radius:20px; border:3px solid #FFFFFF;  color:#FFFFFF; padding:4px; font-size:14px; font-weight:bold;}
		.number { font-size:55px; text-transform:uppercase}
	</style>
	
	<script src="public/js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="public/js/bootstrap.js" type="text/javascript"></script>
	<script src="public/js/script.js" type="text/javascript"></script>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- wrapper start -->
	<div class="container ">
		<!-- back panel -->
		<input type="hidden" id="ajaxCounter" value="0">
		<div id="backpanel" style="margin-bottom:50px; margin:0px auto; display:block">
			<!-- <form method="post" action="" id="ruzzleForm"> -->

			
			<table class="table1" border="0" cellspacing="10" cellpadding="10" align="center">
				<?php
					$html = "";
					$cellCounter = 1;
					for($i=1; $i<=4;$i++){
						$html .="<tr>";
						for($j=1;$j<=4;$j++){
							$html .="<td><span style='font-size:12px;'>Enter Character</span> ";
							// $html .='<input name="char_'.$cellCounter.'" id="char_'.$cellCounter.'" type="text"  class="form-control" value="'.$cellDefaultVal[$cellCounter].'" maxlength="1">';				
							$html .='<input name="char_'.$cellCounter.'" id="char_'.$cellCounter.'" type="text"  class="form-control" value="" maxlength="1">';				
							$html .='<div align="center">';
							$html .='<select name="base_'.$cellCounter.'" id="base_'.$cellCounter.'" >';
							for($t=1; $t<=10; $t++){								
								$html.='<option value="'.$t.'" >'.$t.'</option>';
							}
							$html .='</select>';


							$html .='<select name="charSpl_'.$cellCounter.'" id="charSpl_'.$cellCounter.'">
										<option value="">none</option>
										<option value="DW">DW</option>
										<option value="TW">TW</option>
										<option value="DL">DL</option>
										<option value="TL">TL</option>
									</select>';
							$html .='</div></td>';									

						
						$cellCounter++;
						}
					}
					echo $html;
				?>
				
			</table>
			<div style="" align="center">
				<input id="showGame"  type="button" value="Show Grid" style="font-size:18px; color:#000000; padding:10px 15px; ">
			</div>

			
		</div>



		

		<!-- front panel -->
		


		<div id="frontpanel" style="margin:0px auto; display:none" >
			<table class="table2" border="0" cellspacing="10" cellpadding="10" align="center">

				<?php
					$opt = "";
					$pCounter = 1;
					for($o=1; $o<=4; $o++){
						$opt .='<tr>';
						for($k=1; $k<=4; $k++){							
							$opt .='<td align="center" valign="middle" id="td_'.$pCounter.'">						
											<div class="PointNumber" id="show_base_'.$pCounter.'"></div>
											<div class="Special "  style="display:none" id="show_spl_'.$pCounter.'" ></div>
											<strong class="number" id="show_number_'.$pCounter.'"></strong>
									</td>';
							$pCounter++;
						}
					}

					echo $opt;
				?>
				
					
					
			</table>

			<div style="font-size:15px; color:#FFFFFF; " align="center">
				<a id="showSetting" href="javascript:void(0);" style="font-size:20px; color:#FFFFFF; " ><< Back to Setting</a> 
				<a id="showWorld" href="javascript:void(0);" style="font-size:20px; color:#000; margin-left:20px; ">Show all word</a> 
				<a id="downloadCSV" href="download.php" style="font-size:20px; color:#000; margin-left:20px; display:none; ">Download All Words</a> 
			</div>
		</div>



		<div id="ruzzle_word" style="margin: 10px auto; width:200px;  text-align: left; color: #fff; font-size:20px; display:none; ">
			<h4>Total word : <span id="totalWordCount"></span></h4>			
		</div>
		<div id="loader" style="margin: 10px auto;  text-align: center; color: #fff; display:none;   ">
			<img src="public/images/loading-wheel.gif" height="100" width="100">
		</div>
			


	</div>
	<!-- wrapper close -->
</body>
</html>