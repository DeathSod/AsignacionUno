<?php
	/*Mantiene la sesion activa por 2 horas, independientemente de si se cierra el explorador*/
	$activo = 7200;
	session_set_cookie_params($activo);
	ini_set('session.gc_maxlifetime', $activo);
	/*Inicio la función session_start() para que en caso de que se inicie la sesión se guarden los datos del usuario para usarlos después*/
	session_start();
	/*Si ya hay una sesión activa, te redirecciona a la sesión del ultimo usuario activo*/
	if($_SESSION['username'] != NULL)
	{
		header("Location:iniciosesionprincipal.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Asignacion #1</title>
		<meta charset="UTF-8">
		<style>
			body{
				font-family: courier;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<h1> Asignación #1 </h1>
		<form method="post" name="form1">
			<pre>Login:    <input type="text" name="Login" id="Login"><br></pre>
			<pre>Password: <input type="password" name="Pass" id="Pass"><br><br></pre>
			<input type="submit" name ="boton_inicio" id="boton_inicio" value="Iniciar Sesión" style="font-family:courier;">
			<input type="submit" name ="boton_crear" id="boton_crear" value="Crear Usuario" style="font-family:courier;" formaction="createuser.php" /><br /><br />
			<a href="recupcontra.php">Olvidó su contraseña?</a><br>
		</form>
		<?php
			/*PHP que valida el inicio de sesion*/
			include("validationsql.php");
		?>
	</body>
</html>
