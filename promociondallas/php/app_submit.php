<?php
	
		include_once("app_conexion.php");
		$conexion = conectarse();
		//$seconds = ceil($_POST['tiempo'] / 1000);
		
		
		
		function formatMilliseconds($milliseconds) {
		    $seconds = floor($milliseconds / 1000);
		    $minutes = floor($seconds / 60);
		    $hours = floor($minutes / 60);
		    $milliseconds = $milliseconds % 1000;
		    $seconds = $seconds % 60;
		    $minutes = $minutes % 60;

		    $format = '%u:%02u:%02u';
		    $time = sprintf($format, $hours, $minutes, $seconds, $milliseconds);
		    return rtrim($time, '0');
		}
		
		$sqlW="SELECT sum(correcto) as co, sum(puntos) as pu FROM promo_participante_respuestas p where id_pp='".desencriptar($_COOKIE["promoNE_pp"])."'";
		$resultW = mysqli_query($conexion,$sqlW);
		if ($rowW = mysqli_fetch_assoc($resultW)) 
		{	$co=$rowW['co'];
			$pu=$rowW['pu'];
		}
		else
		{
			$co=0;
			$pu=0;
		}

		$sqlY="update promo_participante_participacion
			set fin=NOW(), tiempo='".formatMilliseconds($_POST['tiempo'])."', puntos='".$pu."'
			where id_part='".desencriptar($_COOKIE["promoNE_part"])."';";
		if($resultY = mysqli_query($conexion, $sqlY))
		{	envia_mail(desencriptar($_COOKIE['promoNE-email']),1,0,0);
			envia_mail(desencriptar($_COOKIE['promoNE-email']),2,$co,formatMilliseconds($_POST['tiempo']));
			echo $co;
		}
		else
			echo "no";
				
		mysqli_close($conexion);

?>