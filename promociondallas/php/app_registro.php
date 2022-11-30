<?php
	
	include_once("app_conexion.php");
	$conexion = conectarse();
	
	$sql0 = "SELECT * FROM promo_participante i where ticket='".$_POST["promo-ticket"]."';"; 
	$result0 = mysqli_query($conexion,$sql0);
	if($row0 = mysqli_fetch_row($result0))
	{
		echo "existe";	
	}
	else
	{
	
		$sql = "insert into promo_participante (nombre, celular, mail, estado, ticket,id_tienda, acepto, freg) 
				values('".$_POST['promo-name']."',
						'".$_POST['promo-phone']."',
						'".$_POST['promo-email']."',
						'".$_POST["promo-city"]."',
						'".$_POST["promo-ticket"]."',
						'".$_POST["id_tienda"]."',
						'".$_POST["promo-terminos"]."', 
						NOW()
						);";
		if($result = mysqli_query($conexion, $sql))
		{	
			$id_part = mysqli_insert_id($conexion);
			
			setcookie("promoNE-name", encriptar($_POST['promo-name']), time() + (86400 * 15), "/"); // 86400 = 1 day
			setcookie("promoNE-phone", encriptar($_POST['promo-phone']), time() + (86400 * 15), "/"); // 86400 = 1 day
			setcookie("promoNE-email", encriptar($_POST['promo-email']), time() + (86400 * 15), "/"); // 86400 = 1 day
			setcookie("promoNE-city", encriptar($_POST['promo-city']), time() + (86400 * 15), "/"); // 86400 = 1 day
			setcookie("promoNE_part", encriptar($id_part), time() + (86400 * 1), "/"); // 86400 = 1 day
			
			
			
			$sql1="insert into promo_participante_participacion (id_part, fecha, inicio, codigo) 
			values ('".$id_part ."',NOW(), NOW(), '');";
			if($result1 = mysqli_query($conexion, $sql1))
			{
				$id_pp = mysqli_insert_id($conexion);
				setcookie("promoNE_pp", encriptar($id_pp), time() + (86400 * 1), "/"); // 86400 = 1 day
				envia_mail($_POST['promo-email'],1,0,0);
				echo "start";
			}
			else
			{ 
				echo "no";
			}
			
			
			
		}
		else
			echo "no";	
			
			
	}
	
	mysqli_close($conexion);
	
?>