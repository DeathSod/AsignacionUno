<?php
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if(isset($_POST['boton_pass']))
	{
		if(empty($_POST['Newpass']) || empty($_POST['Repeatpass']))
		{
			echo "Llene todos los campos";
		}
		else
		{
			if($_POST['Newpass'] == $_POST['Repeatpass'])
			{
				$pass = test_input($_POST['Newpass']);
				$login = test_input($_POST['usuario']);
				$token = test_input($_POST['token']);

				$sql = "SELECT * FROM Usuario WHERE US_Login = '$login'";

				$stmt = $conn->query($sql)
				or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

				$numfilas = $stmt->num_rows;

				if($numfilas == 1)
				{
					$sql = "UPDATE Usuario SET US_Pass = '$pass' WHERE US_Login = '$login'";

					$stmt = $conn->query($sql)
					or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

					if ($stmt)
					{
						$sql = "DELETE FROM resetPassword WHERE RE_Token ='$token'";
						
						$stmt = $conn->query($sql)
						or die($conn->error_log(message). " en la línea ".(__LINE__‐1));
						
						echo "Contraseña cambiada";
						header('Refresh: 2; URL = index.php');
					}
					else{
						echo "Hubo un error";
					}
				}
				else
				{
					echo "El usuario no existe en la BD";
				}
			}
			else
			{
				echo "Las contraseñas no coinciden";
			}
		}
	}
?>