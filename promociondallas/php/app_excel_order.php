<?php
	
		include_once("app_conexion.php");
		$conexion = conectarse();
		
		
		
		$sql = "SELECT p.id_part, p.nombre, p.celular, p.mail, p.estado, p.ticket, r.tienda, p.acepto, p.freg,
				pp.id_pp, pp.id_part, pp.fecha, pp.inicio, pp.fin, pp.tiempo, pp.codigo, pp.puntos
				FROM promo_participante p
				  left join promo_tiendas r on p.id_tienda=r.id_tienda
				  left join promo_participante_participacion pp on p.id_part=pp.id_part
          left join promo_participante_respuestas s on pp.id_pp=s.id_pp
			where p.freg BETWEEN '".$_GET['i']."' AND '".$_GET['f']."'
      		group by p.id_part
      		order by pp.puntos desc, pp.fecha;";
	     $resultado = $conexion->query($sql);
	     if($resultado->num_rows > 0 )
		 {
			     	
			     	
	     	date_default_timezone_set('America/Mexico_City');

			if (PHP_SAPI == 'cli')
				die('Este archivo solo se puede ver desde un navegador web');

			/* Se agrega la libreria PHPExcel */
			require_once 'PHPExcel/PHPExcel.php';

			// Se crea el objeto PHPExcel
			$objPHPExcel = new PHPExcel();
			
			$objPHPExcel->getProperties()->setCreator("New Era te Lleva a Dallas") //Autor
							 ->setLastModifiedBy("New Era te Lleva a Dallas") //Ultimo usuario que lo modificó
							 ->setTitle("New Era te Lleva a Dallas")
							 ->setSubject("New Era te Lleva a Dallas")
							 ->setDescription("Listado de Participantes")
							 ->setKeywords("Participantes")
							 ->setCategory("Participantes");
			$tituloReporte1 = "Promoción New Era";
			$tituloReporte = "New Era te Lleva a Dallas";
			$titulosColumnas = array('No.',
									 'Nombre',
									 'Celular',
									 'Email',
									 'Estado',
									 'Tienda',
									 'Ticket',
									 'Acepta Bases y Aviso',
									 'Fecha Registro',
									 'Codigo Enviado',
									 'Tiempo',
									 'Pregunta 1',
									 'Respuesta P1',
									 'Puntos P1',
									 'Pregunta 2',
									 'Respuesta P2',
									 'Puntos P2',
									 'Pregunta 3',
									 'Respuesta P3',
									 'Puntos P3',
									 'Pregunta 4',
									 'Respuesta P4',
									 'Puntos P4',
									 'Pregunta 5',
									 'Respuesta P5',
									 'Puntos P5',
									 'Puntos Totales');
			$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A1:AA1');
			$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A2:AA2');
			$objPHPExcel->setActiveSheetIndex(0) ->mergeCells('A3:AA3');
			
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte1)	
					->setCellValue('A2',$tituloReporte)
					->setCellValue('A3','Listado de Participantes ('.$_GET['i'].' - '.$_GET['f'].')')
        		    ->setCellValue('A4',  $titulosColumnas[0])
		            ->setCellValue('B4',  $titulosColumnas[1])
        		    ->setCellValue('C4',  $titulosColumnas[2])
            		->setCellValue('D4',  $titulosColumnas[3])
            		->setCellValue('E4',  $titulosColumnas[4])
            		->setCellValue('F4',  $titulosColumnas[5])
					
            		->setCellValue('G4',  $titulosColumnas[6])
            		->setCellValue('H4',  $titulosColumnas[7])
            		->setCellValue('I4',  $titulosColumnas[8])
            		->setCellValue('J4',  $titulosColumnas[9])
            		->setCellValue('K4',  $titulosColumnas[10])
            		->setCellValue('L4',  $titulosColumnas[11])
            		->setCellValue('M4',  $titulosColumnas[12])
					
            		->setCellValue('N4',  $titulosColumnas[13])
            		->setCellValue('O4',  $titulosColumnas[14])
            		->setCellValue('P4',  $titulosColumnas[15])
            		->setCellValue('Q4',  $titulosColumnas[16])
            		->setCellValue('R4',  $titulosColumnas[17])
            		->setCellValue('S4',  $titulosColumnas[18])
            		->setCellValue('T4',  $titulosColumnas[19])
            		->setCellValue('U4',  $titulosColumnas[20])
            		->setCellValue('V4',  $titulosColumnas[21])
            		->setCellValue('W4',  $titulosColumnas[22])
            		->setCellValue('X4',  $titulosColumnas[23])
            		->setCellValue('Y4',  $titulosColumnas[24])
            		->setCellValue('Z4',  $titulosColumnas[25])
            		->setCellValue('AA4',  $titulosColumnas[26])
					;
					
				$i=5;
				$cont=1;	
				
				while ($row = $resultado->fetch_array()) 
				{
					
                 	if($row['acepto']==1) $row['acepto']='Si'; else $row['acepto']='No';
                 		
                 	$sql2='SELECT p.np, pr.pregunta, pr.res, p.res as resparticipante, p.puntos FROM promo_participante_respuestas p, promo_preguntas pr where p.id_preg=pr.id_preg and p.np="1" and p.id_pp="'.$row['id_pp'].'";';
					$resultado2 = $conexion->query($sql2);
					$row2 = $resultado2->fetch_array();
					
					$sql3='SELECT p.np, pr.pregunta, pr.res, p.res as resparticipante, p.puntos FROM promo_participante_respuestas p, promo_preguntas pr where p.id_preg=pr.id_preg and p.np="2" and p.id_pp="'.$row['id_pp'].'";';
					$resultado3 = $conexion->query($sql3);
					$row3 = $resultado3->fetch_array();
					
					$sql4='SELECT p.np, pr.pregunta, pr.res, p.res as resparticipante, p.puntos FROM promo_participante_respuestas p, promo_preguntas pr where p.id_preg=pr.id_preg and p.np="3" and p.id_pp="'.$row['id_pp'].'";';
					$resultado4 = $conexion->query($sql4);
					$row4 = $resultado4->fetch_array();
					
					$sql5='SELECT p.np, pr.pregunta, pr.res, p.res as resparticipante, p.puntos FROM promo_participante_respuestas p, promo_preguntas pr where p.id_preg=pr.id_preg and p.np="4" and p.id_pp="'.$row['id_pp'].'";';
					$resultado5 = $conexion->query($sql5);
					$row5 = $resultado5->fetch_array();
					
					$sql6='SELECT p.np, pr.pregunta, pr.res, p.res as resparticipante, p.puntos FROM promo_participante_respuestas p, promo_preguntas pr where p.id_preg=pr.id_preg and p.np="5" and p.id_pp="'.$row['id_pp'].'";';
					$resultado6 = $conexion->query($sql6);
					$row6 = $resultado6->fetch_array();
						
			     	$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $cont)
		            ->setCellValue('B'.$i,  ($row['nombre']))
        		    ->setCellValue('C'.$i,  ($row['celular']))
            		->setCellValue('D'.$i, ($row['mail']))
            		->setCellValue('E'.$i, ($row['estado']))
            		->setCellValue('F'.$i, ($row['tienda']))
            		->setCellValue('G'.$i, ($row['ticket']))
            		->setCellValue('H'.$i, ($row['acepto']))
            		->setCellValue('I'.$i, ($row['freg']))
            		->setCellValue('J'.$i, ($row['codigo']))
            		
            		->setCellValue('K'.$i, ($row['tiempo']))
            		->setCellValue('L'.$i, ($row2['pregunta'].' - Res: '.$row2['res']))
            		->setCellValue('M'.$i, ($row2['resparticipante']))
            		->setCellValue('N'.$i, ($row2['puntos']))
            		->setCellValue('O'.$i, ($row3['pregunta'].' - Res: '.$row3['res']))
            		->setCellValue('P'.$i, ($row3['resparticipante']))
            		->setCellValue('Q'.$i, ($row3['puntos']))
            		->setCellValue('R'.$i, ($row4['pregunta'].' - Res: '.$row4['res']))
            		->setCellValue('S'.$i, ($row4['resparticipante']))
            		->setCellValue('T'.$i, ($row4['puntos']))
            		->setCellValue('U'.$i, ($row5['pregunta'].' - Res: '.$row5['res']))
            		->setCellValue('V'.$i, ($row5['resparticipante']))
            		->setCellValue('W'.$i, ($row5['puntos']))
            		->setCellValue('X'.$i, ($row6['pregunta'].' - Res: '.$row6['res']))
            		->setCellValue('Y'.$i, ($row6['resparticipante']))
            		->setCellValue('Z'.$i, ($row6['puntos']))
            		->setCellValue('AA'.$i, ($row['puntos']))
					;
					$i++;
					$cont++;
				} 
					
		$estiloTituloReporte1 = array(        	'font' => array(	        	'name'      => 'Arial',    	        'bold'      => true,        	    'italic'    => false,                'strike'    => false,               	'size' =>20,	            	'color'     => array(    	            	'rgb' => '000000'        	       	)            ),
	        'fill' => array(			),
            'borders' => array(               	'allborders' => array(                	'style' => PHPExcel_Style_Border::BORDER_NONE                                   	)            ), 
            'alignment' =>  array(        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,        			'rotation'   => 0,        			'wrap'          => TRUE    		)        );

		$estiloTituloReporte = array(
        	'font' => array(	        	'name'      => 'Verdana',    	        'bold'      => true,        	    'italic'    => false,                'strike'    => false,               	'size' =>16,	            	'color'     => array(    	            	'rgb' => '000000'        	       	)            ),
	        'fill' => array(							),
            'borders' => array(               	'allborders' => array(                	'style' => PHPExcel_Style_Border::BORDER_NONE                                   	)            ), 
            'alignment' =>  array(        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,        			'rotation'   => 0,        			'wrap'          => TRUE    		)        );

		$estiloTituloColumnas = array(            'font' => array(                'name'      => 'Arial',                'bold'      => true,                                          'color'     => array(                    'rgb' => 'ffffff'                )            ),
            'fill' 	=> array(				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,				'rotation'   => 90,        		'startcolor' => array(            		'rgb' => '5f5f5f'        		),        		
			'endcolor'   => array(            		'rgb' => '5f5f5f'        		)			),
            'borders' => array(            	'top'     => array(                    'style' => PHPExcel_Style_Border::BORDER_THIN ,                                    ),
			                'bottom'     => array(                    'style' => PHPExcel_Style_Border::BORDER_THIN ,                    'color' => array(                        'rgb' => 'ffffff'                    )                )            ),
			'alignment' =>  array(        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,        			'wrap'          => TRUE    		));

		$estiloTituloColumnas1 = array(            'font' => array(                'name'      => 'Arial',                'bold'      => true,                                          'color'     => array(                    'rgb' => 'ffffff'                )            ),
            'fill' 	=> array(				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,				'rotation'   => 90,        		'startcolor' => array(            		'rgb' => '0F3BAA'        		),
        		'endcolor'   => array(            		'rgb' => '0F3BAA'        		)			),
            'borders' => array(            	'top'     => array(                    'style' => PHPExcel_Style_Border::BORDER_THIN ,                                    ),
                'bottom'     => array(                    'style' => PHPExcel_Style_Border::BORDER_THIN ,                    'color' => array(                        'rgb' => 'de1f3a'                    )                ),
                'left'     => array(                    'style' => PHPExcel_Style_Border::BORDER_THIN ,                    'color' => array(                        'rgb' => 'de1f3a'                    )                ),
                'right'     => array(                    'style' => PHPExcel_Style_Border::BORDER_THIN ,                    'color' => array(                        'rgb' => 'de1f3a'                    )                )            ),
			'alignment' =>  array(        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,        			'wrap'          => TRUE    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(			array(           		'font' => array(               	'name'      => 'Arial',                              	'color'     => array(                   	'rgb' => '000000'               	)           	),
           	'fill' 	=> array(				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,				'color'		=> array('rgb' => 'fdfdfd')			),
           	'borders' => array(               	'left'     => array					(                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,	                'color' => array					(                        'rgb' => 'e5e5e5'                    )               		),
               	'bottom'     => array					(                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,	                'color' => array					(                        'rgb' => 'e5e5e5'                    )               		),                            	'top'     => array
					(                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,	                'color' => array					(                        'rgb' => 'e5e5e5'                    )               		),                         	'right'     => array					(                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,	                'color' => array					(                        'rgb' => 'e5e5e5'                    )               		)         					                        	)        ));		 
					
		$objPHPExcel->setActiveSheetIndex(0);			
		$objPHPExcel->getActiveSheet(0)->getStyle('A1:AA1')->applyFromArray($estiloTituloReporte1);
		$objPHPExcel->getActiveSheet(0)->getStyle('A2:AA2')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet(0)->getStyle('A4:AA4')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet(0)->getStyle('A3:AA3')->applyFromArray($estiloTituloColumnas1);		
		$objPHPExcel->getActiveSheet(0)->setSharedStyle($estiloInformacion, "A5:AA".($i-1));
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		for($i = 'A'; $i <= 'AA'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->setTitle('New Era te Lleva a Dallas');
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,5);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="New Era te Lleva a Dallas  '.$_GET['i'].' - '.$_GET['f'].'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		 
	}
	else{
		print_r('No hay resultados para mostrar');
	}
		mysqli_close($conexion);

?>