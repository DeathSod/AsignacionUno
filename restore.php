<?php
	$token = $_GET['RE_Token'];
	$idu = $_GET['RE_idUsuario'];

	require_once('conexionmysql.php');

	$sql = "SELECT * FROM resetPassword WHERE RE_Token = '$token'";

	$stmt = $conn->query($sql)
	or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

	$numfilas = $stmt->num_rows;

	if($numfilas == 1)
	{
		$usuario = $stmt->fetch_assoc();
		$login = $usuario['RE_Login'];
		if( sha1($usuario['RE_idUsuario']) == $idu){
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Recuperación de contraseña</title>
		<meta charset="UTF-8">
		<style>
			body{
				font-family: courier;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<form method = "post" name = "form_reset">
			<pre>Nueva Contraseña:    <input type="password" name="Newpass" id="Newpass"><br></pre>
			<pre>Repita Contraseña:   <input type="password" name="Repeatpass" id="Repeatpass"><br><br></pre>
			<input type="submit" name="boton_pass" id="boton_pass" value="Cambiar Contraseña" style="font-family:courier;"><br /><br />
			<input type="hidden" name="usuario" value="<?php echo $login; ?>">
			<input type="hidden" name="token" value="<?php echo $token; ?>">
		</form>
		<?php
			include("validatepass.php")
		?>
	</body>
</html>
<?php
			$conn->close();
		}
		else
		{
			$conn->close();
			header("Location:index.php");
		}
	}
	else
	{
		$conn->close();
		header("Location:index.php");
	}
?>