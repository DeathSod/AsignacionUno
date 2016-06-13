<?php
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if(isset($_POST['boton_actualizar'])){
		if(empty($_POST['name']) || empty($_POST['lastname']) || empty($_POST['email'])){
			echo "No puede dejar Nombre, Apellido ni Correo vacios.";
		}
		else
		{
			$nombre = test_input($_POST['name']);
			$apellido = test_input($_POST['lastname']);
			$correo = test_input($_POST['email']);
			$login = $_SESSION['username'];

			require_once('conexionmysql.php');

			$sql = "SELECT * FROM Usuario WHERE US_Login = '$login'";

			$stmt = $conn->query($sql)
			or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

			$numfilas = $stmt->num_rows;
			if($numfilas == 1)
			{
				if ($_POST['passagain'] == $_POST['pass'] && !empty($_POST['pass']) && !empty($_POST['passagain'])){
					$pass = $_POST['pass'];

					$sql = "UPDATE Usuario SET US_Nombre = '$nombre', US_Apellido = '$apellido', US_Mail = '$correo', US_Pass = $pass WHERE US_Login = '$login'";
						
					$stmt = $conn->query($sql)
					or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

					echo "Datos Actualizados";
				}
				else if(empty($_POST['pass']) && empty($_POST['passagain']))
				{
					$sql = "UPDATE Usuario SET US_Nombre = '$nombre', US_Apellido = '$apellido', US_Mail = '$correo' WHERE US_Login = '$login'";
						
					$stmt = $conn->query($sql)
					or die($conn->error_log(message). " en la línea ".(__LINE__‐1));
					
					echo "Datos Actualizados";
				}
				else
				{
					echo "Error";
				}
				/*
				if (2 == 2))
				{
					echo "Entre 2";
					$pass = $_POST['pass'];
					$sql = "UPDATE Usuario SET US_Nombre = '$nombre', US_Apellido = '$apellido', US_Mail = '$correo', US_Pass = '$pass' WHERE US_Login = ''$login";
					
					$stmt = $conn->query($sql)
					or die($conn->error_log(message). " en la línea ".(__LINE__‐1));					
				
					echo "Datos Actualizados";
				}
				else
				{
					echo "Entre";
					
					$sql = "UPDATE Usuario SET US_Nombre = '$nombre', US_Apellido = '$apellido', US_Mail = '$correo' WHERE US_Login = ''$login";
					
					$stmt = $conn->query($sql)
					or die($conn->error_log(message). " en la línea ".(__LINE__‐1));					
				
					echo "Datos Actualizados";
				}
*/
			}
		}
	}
?>