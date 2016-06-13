<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bienvenido</title>
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
		<h1>Bienvenido <?php echo $_SESSION['username'];?></h1>
		<form method="post" align="center">
			<input type="submit" value="Actualizar Datos" name="Reset" style="font-family:courier;" formaction = "actualizardatos.php" />
			<input type="submit" value="Cerrar Sesion" name ="Logout" style="font-family:courier;"/>
		</form>
		<?php
			/*PHP para cerrar la sesion*/
			include("logout.php");
		?>
	</body>
</html>