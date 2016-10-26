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
		   <style type="text/css">
			.boton{
					font-size:10px;
					font-weight:bold;
					color:white;
					background:#638cb5;
					border:0px;
					width:80px;
					height:25px;
			}
			</style>
			
  </head>
  
  
  <body>

  
  <?php
	
	session_start();
	
	if( !empty($_SESSION['user']) ){ //en caso de que tengamos algo ahi guardado todo va bien
	
	}
  
	?>
	
  
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="formulario.html">Registrarse</a></span>	
      		<span class="right"><a href="">Logout</a></span>
		<br></br>
		<p>
		<?php
		echo "Has iniciado sesion como: " ;
		if(empty($_SESSION['user'])){
			echo "ANONIMO";
		}else{
			echo $_SESSION['user'];
		}			
		echo "<br></br>";
		echo "<p> <a href='VerPreguntas.php'> VER PREGUNTAS </a>";
		
		?>
		</p>
		<br></br>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<form id = "form_pregunta" name = "form_pregunta" action = "InsertarPregunta.php" method="post" onsubmit= "comprobar()" >
	<legend><h3>A&ntildeade tu pregunta</h3></legend>
	<fieldset>
	<center>
	<table>
	
		<tr>
		<td>Pregunta : </td> <td> <TEXTAREA rows="3" cols="30" maxlength="50" id = "pregunta" name="pregunta" required ></TEXTAREA></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Respuesta: </td> <td> <input type="text" id = "respuesta" name="respuesta" required></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Tema : </td> <td> <input type="text" id = "tema" name="tema" required ></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Elige un grado de dificultad : </td> <td> 
		<select name="dificultad" id = "dificultad" size="1" required>
							<option value="0">Seleccione dificultad</option>
						  	<option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
		</select></td>
		</tr>
		<td></td><td> </td><td> </td>
		<tr>
		<td>                            </td><td><input type="submit" name="añadir"  class= "boton" value="Añadir"></td>
		</tr>
		</center>
		
	</table>
	</form>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>


<?php



//miraremos en la BD y si no esta ahi pues se insertara


	//En local
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "preguntas";
	
	
	//En hostinger
	/*$host = "mysql.hostinger.es";
	$user = "u204349316_oscar";
	$password = "gabriel3";
	$dbname = "u204349316_preg";
	*/
	
	$mysqli = mysqli_connect($host, $user, $password, $dbname);
	
	if ($mysqli->connect_errno)
	{
		echo "<center>";
		die ( 'Error al conectar con la Base de Datos' . mysqli_connect_error() . PHP_EOL);
		
	}
	
	$email = $_SESSION['user'];
	
	//comprobamos los datos introducidos por el usuario
	
	if(empty($_POST['pregunta'])){
		
		die( '' );
		
	}if(empty($_POST['respuesta'])){
			
		die('');
	
	}if(empty($_POST['tema'])){ //en el xml solo hay dos tips validos--> hacer criba PENDIENTEEEEE
			
		die('');
	
	}if(empty($_POST['dificultad']) || $_POST['dificultad'] == 0 ){
		
		echo "<center>";
			
		die('Selecciona un grado de dificultad para tu pregunta');
		
		echo "</center>";
		
	}if( empty($_SESSION['user'])){
				
		die("Por favor inicie sesion para poder insertar preguntas");
				
	}
	
			$pregunta = $_POST['pregunta'];
			$respuesta = $_POST['respuesta'];
			$tema = $_POST['tema'];
			$dificultad = $_POST['dificultad'];
	
			$sql = "INSERT INTO preguntas(Email, Pregunta, Respuesta, Dificultad, Tema) VALUES('$email','$pregunta','$respuesta',$dificultad,'$tema')";//ADAPTAR PARA INGRESAR EL TEMA
			
			$res = mysqli_query($mysqli ,$sql);
			
			if(!$res){//en caso de que falle la insercion
				
				$inserteMessage = "Error al insertar la pregunta en la BD";
				echo "<div id='tmessageError'>".$inserteMessage."</div>";
				
			}else{
							//METER LA PARTE DE XML-->RESPETAR FORMATO QUE NOS DAN EN CLASE!!
							

			$xml = simplexml_load_file("preguntas.xml");
			
			$newAssessmentItem = $xml->addChild("assessmentItem");	
			
			$newAssessmentItem->addAttribute("complexity",$dificultad);	
			
			$newAssessmentItem->addAttribute("subject",$tema);
		
			$itemBody = $newAssessmentItem->addChild("itemBody");
			
			$itemBody->addChild("p",$pregunta);
			
			$correctResponse = $newAssessmentItem->addChild("correctResponse");
			
			$correctResponse->addChild("value",$respuesta);
					
			$insertado = $xml->asXML('preguntas.xml');
			
			if($insertado == true){
				
				echo "<center>";
				
				echo "¡Pregunta agregada con exito!";
		

		
				echo "<br><br>";
				
				echo "<p> <a href='VerPreguntas.php'> VER TODAS LAS PREGUNTAS </a>";
				
				echo "</center>";
				
			}else{
					
				$inserteMessage = "Error al insertar la pregunta en el fichero XML";
				
				echo "<div id='tmessageError'>".$inserteMessage."</div>";
				
			}
		
						
			}//cierra la parte de insertar en xml
			
			$mysqli->close();

?>