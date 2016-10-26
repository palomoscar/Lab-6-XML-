
<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		  
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="formulario.html">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
		<br></br>
		<p><a href= "InsertarPregunta.php" target="_blank">Ingresa otra pregunta</a></p>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<center>
	
	session_start();
			
			$preguntas = simplexml_load_file("preguntas.xml");
			
	
	?>
	
	<table id = "tablapreguntas">
	
	<?php $cont_preguntas = count($preguntas);
	
		if($cont_preguntas != 0){
		?>
			<tr>
				<th id="th0">Tema</td>
				<th id="th1">Pregunta</td>
				<th id="th2">Complejidad</td>
			</tr>
		<?php  
			foreach($preguntas as $pregunta){	
			?>
				<tr>
					<td id="td2"><?php echo utf8_decode("$pregunta[subject]"); ?></td>
					<td id="td1"><?php echo $pregunta->itemBody->p; ?></td>
					<td id="td2"><?php echo utf8_decode("$pregunta[complexity]"); ?></td>		
				</tr>
		<?php 
			}
		}else
			echo "La tabla de preguntas se encuentra vacia";
	?>
			
		}
		echo '</table>';
		
		echo "<br></br>";
		
		echo "<center>";
		
		
		
		mysqli_close( $mysqli );
	
?>
	<br></br><br></br>
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>