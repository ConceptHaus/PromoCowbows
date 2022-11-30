<?php
		include_once("app_conexion.php");
		$conexion = conectarse();

		$sqlY="update promo_participante_participacion
			set inicio=NOW()
			where id_part='".desencriptar($_POST["par"])."';";
		if($resultY = mysqli_query($conexion, $sqlY))
		{	echo "Trivia Iniciada";
			
		}
		else
			echo "no".muestra_error($conexion);
				
		mysqli_close($conexion);
	
?>