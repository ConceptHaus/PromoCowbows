<?php

function getQuestions()
{	$s1i='2022-11-14'; $s1f='2022-11-20';   
	$s2i='2022-11-21'; $s2f='2022-11-27';   
	$s3i='2022-11-18'; $s3f='2022-12-04';    
    
    include_once("app_conexion.php");
	$conexion = conectarse();
	
	$sqlX="select * from promo_preguntas order by RAND()  LIMIT 5 ;";
	$resultX = mysqli_query($conexion,$sqlX);
	$qestion = mysqli_fetch_all($resultX);
		return $qestion;
	
}


?>