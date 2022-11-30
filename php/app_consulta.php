<?php
	
		include_once("app_conexion.php");
		$conexion = conectarse();
		
				
		$sqlX="SELECT res as valor FROM promo_preguntas c where id_preg='".$_POST['sam']."';";
		$resultX = mysqli_query($conexion,$sqlX);
		if ($rowX = mysqli_fetch_assoc($resultX)) 
		{
			if($_POST['res']==$rowX['valor']) //correcto
			{	
				$c=1;
				$p=2;
				
			}
			else //incorrecto
			{	
				$c=0;
				$p=0;
				
			}
			
			
			
			$sqlY="insert into promo_participante_respuestas(id_pp, np,id_preg, res, correcto, puntos, fecha)
			values ('".desencriptar($_COOKIE["promoNE_pp"])."','".$_POST['que']."','".$_POST['sam']."','".$_POST['res']."','".$c."','".$p."',NOW());";
			$resultY = mysqli_query($conexion, $sqlY);
			
			if($_POST['que']==5)
			{
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
				
				echo $co;
			}
			else
				echo "next";
		}
		else
			echo "no";
		
		mysqli_close($conexion);

?>