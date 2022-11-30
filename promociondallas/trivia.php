<?php 
	include_once("php/app_conexion.php");
	include_once("php/app_questions.php");	
	$qestions = getQuestions();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Roboto:300,400,500,700&amp;display=swap" rel="stylesheet" type="text/css" />

		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
		<link rel="stylesheet" href="css/animate.css" type="text/css" />
		<link rel="stylesheet" href="css/custom.css" type="text/css" />
		<link rel="stylesheet" href="css/components/radio-checkbox.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>New Era Cap Mexico</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
	</head>
	<div id="preloader" class="h-100">
		<div id="status">&nbsp;</div>
	</div>
	<body class="stretched side-push-panel">
		<div class="body-overlay"></div>
		

		<div id="wrapper" class="clearfix">

			<section id="page-title" class="page-title-pattern">
				<div class="container clearfix">
					<br><br><br><br>
					
				</div>
			</section>

			<section class="bg-gris" id="content">
				<div class="content-wrap bg-gris py-0">
					<div class="page-section p-lg-5 p-3 pb-3 bg-white">
						<div class="center">
							<img src="images/logo-quiz.png" width="300">
						</div>
						<div class="container center pt-4 " id="pregs">
							<form method='post' id='quiz_form'>
							<?php 
								
								$cont=0;
								foreach ($qestions as $key => $qestion) 
								{  $cont++; 
							?>
								<div id="question_<?php echo $cont;?>" class='questions center '>
									<h2 class="question"><?php echo ($cont);?>. <?php echo ($qestion[2]);?></h2>
									<div class='center row justify-content-center'>
										<div class="question-container col-lg-7 order-<?php echo rand(0,9); ?>">
											<button type="button" class="button text-white btn-lg w-100 my-2" id="res1_<?php echo $qestion[0];?>" data-que="<?php echo $cont;?>" data-sam="<?php echo $qestion[0];?>" data-res="1" >
												<?php echo (trim($qestion[3]));?>
											</button>
										</div>
										<div class="question-container col-lg-7 order-<?php echo rand(0,9); ?>">
											<button type="button" class="button text-white btn-lg w-100 my-2" id="res2_<?php echo $qestion[0];?>" data-que="<?php echo $cont;?>" data-sam="<?php echo $qestion[0];?>" data-res="2" >
												<?php echo (trim($qestion[4]));?>
											</button>
										</div>
										<div class="question-container col-lg-7 order-<?php echo rand(0,9); ?>">
											<button type="button" class="button text-white btn-lg w-100 my-2" id="res3_<?php echo $qestion[0];?>" data-que="<?php echo $cont;?>" data-sam="<?php echo $qestion[0];?>" data-res="3" >
												<?php echo (trim($qestion[5]));?>
											</button>
										</div>
									</div>
									
								</div>
							<?php  }?>
							</form>
						</div>
						
						<div class="container" id="win1">
							<div class="row center justify-content-center">
								<div class="col-lg-8 col-12 center p-0">
									<div class="pb-3"><img src="images/icono-goal.png" class="img-fluid" width="60" ></div>
									<h2 class="resultado m-0 p-0 pb-4">¡GRACIAS POR PARTICIPAR!</h2>
									<div class="resultado-text">Este es tu marcador:</div>
									<div class="resultado-text"><span id="co" class="resp" ><?php echo @$_COOKIE['promoNE_co']; ?></span> respuestas correctas en <span id="clock" class="resp">00:00:00</span></div>
									
									<div class="resultado-text pt-4">Tu registro ha sido exitoso. Revisa tu correo electrónico para descargar<br><b>tu cupón de 10% de descuento en newera.mx</b></div>
									<h3 class="py-2 m-0">¡Sigue participando!</h3>
									<div class="resultado-text">Mientras más compras registres, más oportunidades tienes de que tu pasión y New Era te lleven con los Vaqueros.</div>
									<div class="resultado-small pt-4">Dudas y aclaraciones: neweratellevaadallas@makken.com.mx </div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</section>

			<?php include_once('footer.php'); ?>
            
		</div>

		<div id="gotoTop" class="icon-angle-up"></div>

		<script src="js/jquery.js"> </script>
		<script src="js/plugins.min.js"> </script>
		<script src="js/functions.js"> </script>
		<script src='js/watch.js'></script>
		<script>
		$.fn.serializeObject = function()
		{
		    var o = {};
		    var a = this.serializeArray();
		    $.each(a, function() {
		        if (o[this.name] !== undefined) {
		            if (!o[this.name].push) {
		                o[this.name] = [o[this.name]];
		            }
		            o[this.name].push(this.value || '');
		        } else {
		            o[this.name] = this.value || '';
		        }
		    });
		    return o;
		};			

			$(document).ready(function()
			{	
				
          		 $(window).on('beforeunload', function(){
	                  return 'Are you sure you want to leave?';
	           		});
           
				if(getCookie('promoNE_pp')=="" || getCookie('promoNE_co'))
				{	setCookie('promoNE_pp', '', -100);
    				setCookie('promoNE_part', '', -100);
    				setCookie('promoNE_pu', '', -100);
	        		setCookie('promoNE_co', '', -100);
					$(location).attr('href','index.php');
				}
				
				
				
			    
			    $('#clock').stopwatch().stopwatch('start');
			    $("#end1").hide();
			    $("#win1").hide();
			    $( ".questions" ).each(function(i){
			        hider=i+2;
			        $("#question_" + hider).hide();
			    });
			    
			    $('[id^=res]').click(function() {
					var res=$(this).data('res'); //orden respuesta
					var que=$(this).data('que'); //orden pregunta actual
					var sam=$(this).data('sam'); //id de pregunta
					
					var i = que; //pregunta actual
					var step = i + 1; // pregunta siguiente
			        var step1 = i + 2;
			        console.log(i);
			        
			       
				        $.post("php/app_consulta.php",{'res':res, 'que': que, 'sam':sam},function(data)
				        { 	
							if(data!="no")
							{	 
								if(i<5){
									$("#question_" + i).hide();
				            		$("#question_" + step).show();
								}
								else
								{	$("#question_" + i).hide();
									$('#clock').stopwatch('stop');
									//console.log('Tiempo: '+$('#clock').stopwatch('getTime'));
									
									console.log('Resultado: '+data);
				        			$('#co').html((data));
									$("#win1").show();
									
									
									$.post("php/app_submit.php",{'tiempo':$('#clock').stopwatch('getTime'), 'puntos':getCookie('promoNE_pu')},function(data2)
				        			{ 	
										setCookie('promoNE_pp', '', -100);
				        				setCookie('promoNE_part', '', -100);
				        				setCookie('promoNE_pu', '', -100);
				        				setCookie('promoNE_co', '', -100);
				        				
									});
										
								}

							}
							else
							{	$("#question_" + i).hide();
								$('#clock').stopwatch('stop');
								$("#clock").hide();
								$("#end1").show();
								setCookie('promoNE_pp', '', -100);
		        				setCookie('promoNE_part', '', -100);
		        				setCookie('promoNE_pu', '', -100);
				        		setCookie('promoNE_co', '', -100);
							}
						});
			        

				});
			    
			    
			    
			});
</script>
	</body>

</html>