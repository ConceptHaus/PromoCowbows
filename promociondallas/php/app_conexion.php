<?php 
	function conectarse() 
	{	
		$ser="localhost"; 		
		$user="forge";		
		$pass="mygoCjnqbPDZpOoKSXGL";		
		$db="promo_cowbows";
				
		$conexion = mysqli_connect($ser ,$user ,$pass) or die("Error de Conexión. Intente más tarde.");
		$db = mysqli_select_db( $conexion, $db ) or die ( "Error. No hay conexión con la Base de Datos" );
		
		@mysqli_query($conexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

		return $conexion; 
		
	}
	
	function muestra_error($con)
	{
	    return mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
	} 
	
	function encriptar($texto){
			$clave  = 'promoNE_crypt_thisIsACryptScriptNE2022#$%';
			$method = 'aes-256-cbc';
			$iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw");
			$challenge = openssl_encrypt ($texto, $method, $clave, false, $iv);
			return str_replace('=', ')', $challenge);
	};
	 
	 
	 function desencriptar($texto){
			$clave  = 'promoNE_crypt_thisIsACryptScriptNE2022#$%';
			$method = 'aes-256-cbc';
			$iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw");
			$encrypted_data = base64_decode($texto);
			$texto= str_replace(')', '=', $texto);
		 return openssl_decrypt($texto, $method, $clave, false, $iv);			
	}
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	function envia_mail($para,$tipo,$pt,$time) {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= "From: New Era te lleva a Dallas <neweratellevaadallas@makken.com.mx> \r\n";
		$headers .= "BCC:neweratellevaadallas@makken.com.mx \r\n";
		
		$codigo='DALLASXNEWERA10-LKJQ3487OIKJw';
		if($tipo==1)
		{
			$asunto1=utf8_decode("¡Gracias por Registrarte!");
			$cuerpo1=utf8_decode('<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="x-apple-disable-message-reformatting"><title></title><!--[if mso]><noscript><xml><o:officedocumentsettings><o:pixelsperinch>96</o:pixelsperinch></o:officedocumentsettings></xml></noscript><![endif]--><style>div,h1,p,table,td{font-family:Tahoma}body{margin:auto!important;padding:0;width:95%;background-color:#fff}#table_main{width:100%;border-collapse:collapse;border-spacing:0}#table_sec{width:602px;border-collapse:collapse;border-spacing:0;text-align:left}div{font-family:Tahoma;font-size:1.3rem}p{font-family:Tahoma;font-size:.6rem}.promo{color:#0f3baa;font-size:2.5rem;font-weight:700}.cupon{padding:20px 0 0}.code{color:#0f3baa;font-weight:700;font-size:1.3rem}#footer b{font-family:Tahoma;font-style:normal;font-weight:700;font-size:18px;line-height:normal;text-align:center;letter-spacing:.03em;margin:none;color:#3c3935}#footer div{text-align:center;line-height:9px}#footer a{font-family:Tahoma;font-style:normal;font-weight:400;font-size:11px;line-height:normal;text-align:center;letter-spacing:.03em;color:#3c3935;text-decoration:none}@media only screen and (max-width:480px){#table_sec{width:100%}}</style></head><body><table id="table_main" role="presentation"><tr><td align="center"><table role="presentation" id="table_sec"><tr><td align="center"><img src="http://promocion-cowboys.makkensites.com/images/mailheader.png" alt="" width="100%" style="height:auto;display:block"></td></tr><tr><td style="padding:15px 20px"><table role="presentation" width="100%"><tr><td align="center"><img src="http://promocion-cowboys.makkensites.com/images/newera.png" height="80" style="padding-bottom:10px"><div>Te regalamos</div><div class="promo">10% DE DESCUENTO</div><div>para tu próxima compra en newera.mx</div><div class="cupon"><strong>CUPÓN:</strong></div><div class="code">'.$codigo.'</div><p>No aplica con otras promociones ni descuentos. Vigencia del 30 noviembre de 2022 al 6 de febrero de 2023.</p></td></tr></table></td></tr><tr><td align="center" style="background-color:#d9d9d9;padding:15px"><table role="footer" id="footer"><tr><td width="30%"><img src="http://promocion-cowboys.makkensites.com/images/newera.png" width="120"></td><td width="35%"><div><b>NEW ERA</b></div><div><a href="https://www.instagram.com/neweramx/" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-IG.png" height="10"> @neweramx</a></div><div><a href="https://www.facebook.com/neweracapmexico" target="_blank"><img src="http://promocion-cowboys.makkensites.com/newera/images/icono-FB.png" height="10"> /neweracapmexico</a></div><div><a href="https://twitter.com/NewEraMx" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-TW.png" height="10"> @neweramx</a></div></td><td width="35%"><div><b>SOMOS COWBOYS</b></div><div><a href="https://www.instagram.com/somoscowboys/" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-IG.png" height="10"> @somoscowboys</a></div><div><a href="https://www.facebook.com/SomosCowboys" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-FB.png" height="10"> /SomosCowboys</a></div><div><a href="https://twitter.com/SomosCowboys" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-TW.png" height="10"> @SomosCowboys</a></div></td></tr></table></td></tr></table></td></tr></table></body></html>');
		}
		else
		{
			$asunto1=utf8_decode("¡Gracias por Participar!");
			$cuerpo1=utf8_decode('<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="x-apple-disable-message-reformatting"><title></title><!--[if mso]><noscript><xml><o:officedocumentsettings><o:pixelsperinch>96</o:pixelsperinch></o:officedocumentsettings></xml></noscript><![endif]--><style>div,h1,p,table,td{font-family:Tahoma}body{margin:auto!important;padding:0;width:95%;background-color:#fff}#table_main{width:100%;border-collapse:collapse;border-spacing:0}#table_sec{width:602px;border-collapse:collapse;border-spacing:0;text-align:left}div{font-family:Tahoma;font-size:1.3rem}p{font-family:Tahoma;font-size:.6rem}span{color:#0f3baa;font-size:1.2rem;font-weight:700;font-size:1.2rem}.promo{color:#0f3baa;font-size:2rem;font-weight:700}.cupon{padding:20px 0 0}.code{color:#0f3baa;font-weight:700;font-size:1.3rem}#footer b{font-family:Tahoma;font-style:normal;font-weight:700;font-size:18px;line-height:normal;text-align:center;letter-spacing:.03em;margin:none;color:#3c3935}#footer div{text-align:center;line-height:9px}#footer a{font-family:Tahoma;font-style:normal;font-weight:400;font-size:11px;line-height:normal;text-align:center;letter-spacing:.03em;color:#3c3935;text-decoration:none}@media only screen and (max-width:480px){#table_sec{width:100%}}</style></head><body><table id="table_main" role="presentation"><tr><td align="center"><table role="presentation" id="table_sec"><tr><td align="center"><img src="http://promocion-cowboys.makkensites.com/images/mailheader.png" alt="" width="100%" style="height:auto;display:block"></td></tr><tr><td style="padding:15px 20px"><table role="presentation" width="100%"><tr><td align="center"><img src="http://promocion-cowboys.makkensites.com/images/newera.png" height="80" style="padding-bottom:10px"><div class="promo">¡GRACIAS POR PARTICIPAR!</div><div>Este es tu marcador:</div><div> <span>'.$pt.'</span> respuestas correctas en <span>'.$time.'</span></div><div class="cupon"><strong>SIGUE INTENTÁNDOLO</strong></div><div>Mientras más compras registres, más oportunidades tienes de que tu pasión y New Era te lleven con los Vaqueros.</div><p>Dudas y aclaraciones: neweratellevaadallas@makken.com.mx</p></td></tr></table></td></tr><tr><td align="center" style="background-color:#d9d9d9;padding:15px"><table role="footer" id="footer"><tr><td width="30%"><img src="http://promocion-cowboys.makkensites.com/images/newera.png" width="120"></td><td width="35%"><div><b>NEW ERA</b></div><div><a href="https://www.instagram.com/neweramx/" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-IG.png" height="10"> @neweramx</a></div><div><a href="https://www.facebook.com/neweracapmexico" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-FB.png" height="10"> /neweracapmexico</a></div><div><a href="https://twitter.com/NewEraMx" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-TW.png" height="10"> @neweramx</a></div></td><td width="35%"><div><b>SOMOS COWBOYS</b></div><div><a href="https://www.instagram.com/somoscowboys/" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-IG.png" height="10"> @somoscowboys</a></div><div><a href="https://www.facebook.com/SomosCowboys" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-FB.png" height="10"> /SomosCowboys</a></div><div><a href="https://twitter.com/SomosCowboys" target="_blank"><img src="http://promocion-cowboys.makkensites.com/images/icono-TW.png" height="10"> @SomosCowboys</a></div></td></tr></table></td></tr></table></td></tr></table></body></html>');
		}
		
		
		
		$cuerpo=$cuerpo1;
		$asunto=$asunto1;
		
		
			if (!class_exists('PHPMailer\PHPMailer\Exception'))
			{
				require 'PHPMailer/src/Exception.php';
				require 'PHPMailer/src/PHPMailer.php';
				require 'PHPMailer/src/SMTP.php';
			}
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";

			$mail->SMTPDebug  = 0;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = "smtp.office365.com";
			$mail->Username = 'neweratellevaadallas@makken.com.mx';
			$mail->Password = 'Makken22';
			$mail->setFrom('neweratellevaadallas@makken.com.mx', 'New Era te lleva a Dallas');

			$mail->IsHTML(true);
			$mail->AddAddress($para,'');

			$mail->Subject = $asunto;
			$content = $cuerpo;
			$content = mb_convert_encoding($content, 'HTML-ENTITIES', "ISO-8859-1");
			$mail->MsgHTML($content); 

			if ($mail->send()) 
				return 1;
			else return 0;
	}
?>