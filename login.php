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
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div> <!--Aqui se despliega el formulario-->
	
	<center>
	
	<h1>Acceso para Usuarios</h1>
	
	
	<form  id = "login" name "login" action="login.php" method="post" >

	
	<label>Email :</label><br>
	
	<input name="username" type="text" id="username" required>
	
	
	<br><br>

	<label>Password:</label><br>

	<input name="pass" type="password" id="pass" required>

	<br><br>

	<input type="submit" name="Submit" class = "boton" value="LOGIN">
	
	</center>

	</form>
		
	</div><!--Aqui termina e  formulario-->
	
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
	
</div>

</body>

</html>

<?php

	//PRIMERO ESTABLECEREMOS LAS CONEXIONES	
	
	//En local
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "usuario";
	
	
	/*$host = "mysql.hostinger.es";
	$user = "u204349316_oscar";
	$password = "gabriel3";
	$dbname = "u204349316_preg";
	*/
	
	$mysqli = mysqli_connect($host, $user, $password, $dbname);
	
	if ($mysqli->connect_errno)
	{
		die ( 'Error al conectar con la Base de Datos' . mysqli_connect_error() . PHP_EOL);
		
	}
	
		session_start();//PARA CUANDO HAGAMOS LA OPCINAL Y LE METAMOS TIMERS Y ESO
		
		//comprobaciones en el lado servidor

		if( empty($_POST['username']) || empty($_POST['pass']) ){
		
		die( '' );
		
		}
		
		function comprobarMail(){
	
		$patron_mail = '/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/';	
		
		return preg_match( $patron_mail, $_POST['username'] );
		
		}
		
	
		if( !comprobarMail() ){
			
			die("Error de identificacion, revisa los datos que has introducido");
		
		}	
			$email =  $_POST['username'];
			
			$pass = $_POST['pass'];
			
			$result = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' AND Clave = '$pass'" );
			
			$cont = mysqli_num_rows($result);
				
		if(  $cont > 0 ){ //si hay una o mas lineas que coincidan --> esta en la BD --> acierto
				
				$_SESSION['user'] = $email;
			
				$_SESSION['pass'] = $password;
			
			header("location: InsertarPregunta.php");//redireccionamos
			
			
		}else{
			
			echo "<center>";
			
			echo "<p> <a href='layout.html'> INICIO </a>";
			
			echo "<br></br>";	
			
			die("Error de identificacion, revisa los datos introducidos");//seria mejor con js...
			
		
		}
		
		mysqli_close($mysqli);
			
?>
