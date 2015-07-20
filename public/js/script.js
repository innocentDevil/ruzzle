// Jayesh javascript Document

$( document ).ready(function() {

	// console.log("on load");

	$('#showGame').click(function(){
		
		var boxColor = {
		    DW: "orange",
		    DL: "green",
		    TL: "blue",
		    TW: "red"
		};


		var dataField = "action=setSession";


		for(var i=1; i<=16; i++){
			$('#show_spl_'+i).removeClass('red blue green orange');
			$('#td_'+i).removeClass('redBorder blueBorder greenBorder orangeBorder');

			if($('#char_'+i).val()!=""){
				dataField+='&char_'+i+'='+$('#char_'+i).val();
				$('#show_number_'+i).html($('#char_'+i).val());
			}else{
				return false;
			}

			if($('#base_'+i).val()!=""){
				dataField+='&base_'+i+'='+$('#base_'+i).val();
				$('#show_base_'+i).html($('#base_'+i).val());
			}

			if($('#charSpl_'+i).val()!=""){
				$('#show_spl_'+i).html($('#charSpl_'+i).val());
				$('#show_spl_'+i).show();
				console.log(boxColor[$('#charSpl_'+i).val()]);
				$('#td_'+i).addClass(boxColor[$('#charSpl_'+i).val()]+'Border');
				$('#show_spl_'+i).addClass(boxColor[$('#charSpl_'+i).val()]);
				dataField+='&charSpl_'+i+'='+$('#charSpl_'+i).val();
				
			}
				
		}

		
		$('#backpanel').hide();
		$('#frontpanel').show();
		$('#showWorld').show();
		$.ajax({
			type: "POST",
			url: "ajax.php",
			data: dataField,
			dataType: 'json',
			success:function(response) {					
			
			}
		});

	});
	
	$('#showSetting').click(function(){
		$('#backpanel').show();
		$('#frontpanel').hide();	
		
		$('.test').remove();

		$('#ruzzle_word').hide();	
		$('#downloadCSV').hide();	
		$('#ajaxCounter').val(0);
	})


	$('#showWorld').click(function(){

		$('#showSetting').hide();
		$('#showWorld').hide();
		$('#loader').show();
		var dataField = "action=getWord";	
		var trCnt = 1;
		$('#ajaxCounter').val(0);
		for(var i=1; i<=16; i++){

			// setTimeout(function(){

				dataField +='&cellCnt='+i;
			
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: dataField,
					// async : false,
					// dataType: 'json',
					success:function(response) {
						$('#ajaxCounter').val(parseInt($('#ajaxCounter').val()) + 1);

						if(parseInt($('#ajaxCounter').val()) == 16){

							$.ajax({
								type: "POST",
								url: "ajax.php",
								data: "action=getWordWithScore",
								// async : false,
								dataType: 'json',
								success:function(response) {

									$.each(response,function(i,d){
										console.log(d);
										$('#ruzzle_word').append("<div class='test' data-percentage='"+d+"'><span>"+i+" : </span> <span class=''>"+d+"</span></div>");
										trCnt++;
									});	

									trCnt = trCnt - 1;
									$('#totalWordCount').html(trCnt);
									var $wrapper = $('#ruzzle_word');

									$wrapper.find('.test').sort(function (a, b) {
									    return +b.dataset.percentage -+a.dataset.percentage;
									})
									.appendTo( $wrapper );
									$('#loader').hide();
									$('#ruzzle_word').show();	
									$('#showWorld').hide();
									$('#downloadCSV').show();	
									$('#showSetting').show();
								}
							});

						}
						

						

						
					
					}
				});

				// i++;

			// },5000);
			
		}

		// $('#loader').hide();
	});

});