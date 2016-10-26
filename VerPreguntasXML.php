<!DOCTYPE html>
<html lang="es">
<head>
	<center>
	<title>Ver preguntas</title>
	<meta charset="UTF-8">
	</center>
</head>

<body>
	<h1 id="encabezado1">Preguntas actualmente insertadas</h1>
	<?php 
			session_start();
			
			$preguntas = simplexml_load_file("preguntas.xml");
			
	
	?>
	
	<table id = "tablapreguntas">
	
	<?php $cont_preguntas = count($preguntas);
	
		if($cont_preguntas != 0){
		?>
			<tr>
				<td>Tema</td>
				<td>Pregunta</td>
				<td>Complejidad</td>
			</tr>
		<?php  
			foreach($preguntas as $pregunta){	 //probamos la funcion que nos ha dicho silvia decode
			?>
				<tr>
					<td><?php echo utf8_decode("$pregunta[subject]"); ?></td>
					
					<td><?php echo $pregunta->itemBody->p; ?></td>
					
					<td><?php echo utf8_decode("$pregunta[complexity]"); ?></td>		
				</tr>
		<?php 
			}
		}else
			
			echo "No se han formulado preguntas aun, se el primero";
		
			echo "<p> <a href='InsertarPregunta.php'> ¡Inserta tu pregunta! </a>";
			
			//FALTA DARLE EL FRMATO USADO HASTA AHORA-->PENDIENTE
	?>
		</tr>
	</table>		
</body> 