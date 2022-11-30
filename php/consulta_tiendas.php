<?php 
	@session_start(); 
	include("app_conexion.php");
	$conexion = conectarse();

	
	$html = "";
	$html .= "<option value='' >¿Dónde lo Compraste?</option>\n";
	$sql0 = "SELECT id_tienda, tienda, mp, baja FROM promo_tiendas i where baja='0' order by mp desc, tienda;"; 
	$result0 = mysqli_query($conexion,$sql0);
	while ($row0 = mysqli_fetch_row($result0))
	{  	  	$html .= "<option value='".$row0[0]."'";
			$html .= ">".$row0[1]."</option>\n";
		
		
	}

	echo $html;
?>