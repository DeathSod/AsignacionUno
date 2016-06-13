<?php
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if(isset($_POST["boton_inicio"])){
		
		$data = array();

		if(empty($_POST['Login']))
		{
			$data[] = "Login";
		}
		else
		{
			$login = test_input($_POST["Login"]);
		}
		if(empty($_POST["Pass"]))
		{
			$data[] = "Password";
		}
		else
		{
			$pass = test_input($_POST["Pass"]);
		}

		if(empty($data))
		{
			require_once('conexionmysql.php');

			$sql = "SELECT * FROM Usuario WHERE US_Login = '$login' AND US_Pass = '$pass'";

			/*Ejecuto el sql*/
			$stmt = $conn->query($sql)
			or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

			/*Obtengo el numero de filas en la consulta*/
			$numfilas = $stmt->num_rows;

			/*Si el usuario existe en la BD inicio sesion*/
			if($numfilas == 1){
				/*Consigo el valor del correo del usuario en la BD*/
				$getdata = mysqli_fetch_assoc($stmt);
				$correo = $getdata['US_Mail'];
				$nombre = $getdata['US_Nombre'];
				$apellido = $getdata['US_Apellido'];
				
				/*Cierro la conexion*/
				$conn->close();
				
				/*Guardo en la sesion el nombre de usuario y su correo*/
				$_SESSION['username'] = $login;
				$_SESSION['nombre'] = $nombre;
				$_SESSION['apellido'] = $apellido;
				$_SESSION['email'] = $correo;
				
				/*Redirecciono a la pagina del usuario*/
				header("Location:iniciosesionprincipal.php");
			}
			else{
				echo "El usuario no esta registrado";
				$conn->close();
			}
			
		}
		else
		{
			echo "Fallo en el inicio de sesion debido a que las validaciones de los siguientes datos no se cumplieron: <br />";
			foreach($data as $obj)
			{
				/*Muestra los campos que no cumplen con las validaciones*/
				echo "$obj<br />";
			}
		}
	}
?>