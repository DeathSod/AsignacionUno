<?php
	session_start();
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
		<h1> Recuperación contraseña </h1>
		<h3> Por favor indique su correo asociado a su cuenta para enviarle un link donde podrá cambiar su contraseña</h3>
		<form method="post" name="formrecup">
			<pre>Correo:    <input type="email" name="email" id="email"><br></pre>
			<input type="submit" name ="boton_correo" id="boton_correo" value="Pedir cambio contraseña" style="font-family:courier;">
			<input type="submit" name ="boton_regresar" id="boton_regresar" value="Volver" style="font-family:courier;" formaction="index.php" /><br /><br />
		</form>
		<?php
			include("enviaremail.php");
		?>
	</body>
</html>