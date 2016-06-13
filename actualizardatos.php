<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Actualizacion de usuario</title>
		<meta charset="UTF-8">
		<style>
			body{
				font-family: courier;
			}
			h1{
				text-align: center;
			}
		</style>
	</head>
	<body>
		<h1> Actualizacion de usuario </h1>
		<form method="post">
			<!-- Se crea una tabla donde estará organizada el formulario -->
			<table border="0" align="center">

				<tr>
					<td>Nombre:</td>
					<td align="center"><input type="text" name="name" size="20" value ="<?php echo $_SESSION['nombre']; ?>" /></td>
				</tr>

				<tr>
					<td>Apellido:</td>
					<td align="center"><input type="text" name="lastname" size ="20" value ="<?php echo $_SESSION['apellido']; ?>" /></td>
				</tr>

				<tr>
					<td>Contraseña:</td>
					<td align="center"><input type="password" name="pass" size="20" /></td>
				</tr>

				<tr>
					<td>Repita contraseña:</td>
					<td align="center"><input type="password" name="passagain" size="20" /></td>
				</tr>

				<tr>
					<td>Correo:</td>
					<td align ="center"><input type="text" name="email" size="20" value ="<?php echo $_SESSION['email']; ?>"/></td>
				</tr>

				<tr>
					<td colspan="2" align="center"><input type="submit" value="Actualizar" name="boton_actualizar" style="font-family:courier;" /></td>
				</tr>

				<tr>				
					<td colspan="2" align="center"><input type="submit" value="Cancelar" style="font-family:courier;" formaction="iniciosesionprincipal.php" /></td>
				</tr>
			<table/>
		</form>
		<div align="center">
			<?php
				include("actualizarsql.php");
			?>
		</div>
	</body>
</html>