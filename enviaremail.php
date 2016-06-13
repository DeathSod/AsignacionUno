<?php
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function linkpass($idu, $login, $conn)
	{
		/*Funcion que se encarga de crear el link que se enviará por correo para cambiar la contraseña*/
		$cadena = $idu.$login.rand(1,9999999).date('Y-m-d');
		$token = sha1($cadena);

		$sql2 = "INSERT INTO resetPassword (RE_idUsuario, RE_Login, RE_Token, RE_Creado) VALUES ($idu,'$login','$token',NOW());";
		$resultado = $conn->query($sql2);
		if ($resultado){
			$hyperlink = $_SERVER['SERVER_NAME'].'/AsignacionUno/restore.php?RE_idUsuario='.sha1($idu).'&RE_Token='.$token;
			return $hyperlink;
		}
		else
		{
			return FALSE;
		}
	}

	function enviarcorreo($email, $enlace, $name)
	{
		/*Funcion que se encarga de mandar el msg desde una cuenta gmail*/
		$mensaje = '<p>Se ha recibido una petición para reestablecer la contraseña de la cuenta asociada a este correo</p>
					<p>Si no pediste una petición para reestablecer la contraseña has caso omiso a este correo</p>
					<strong>El enlace para reestablecer tu contraseña es el siguiente:</strong><br>
					<a href="'.$enlace.'">http://'.$enlace.'</a>';

		include("PHPMailer/class.phpmailer.php");
		include("PHPMailer/class.smtp.php");
		
		$mail = new PHPMailer();

		$mail->isSMTP();
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = "ssl"; 
		$mail->Host = "smtp.gmail.com"; 
		$mail->Port = 465;

		$mail->Username = "pruebasmarcellh2@gmail.com";
		$mail->Password = "DeathSod";

		$mail->FromName = "AsignacionUno";
		$mail->Subject = "Reestablecer Contraseña";
		$mail->AltBody = "Esto es un correo para cambiar la contraseña";
		$mail->MsgHTML($mensaje);
		$mail->AddAddress($email,$name);
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';

		if(!$mail->Send())
		{
			echo "No se envio el correo";
		}
		else
		{
			echo "Se envio exitosamente<br />";
		}
	}
	if(isset($_POST['boton_correo']))
	{
		if(empty($_POST['email'])){
			echo "El campo no puede estar vacio";
		}
		else
		{
			$correo = test_input($_POST['email']);
			require_once('conexionmysql.php');

			$sql = "SELECT * FROM Usuario WHERE US_Mail = '$correo'";

			$stmt = $conn->query($sql)
			or die($conn->error_log(message). " en la línea ".(__LINE__‐1));

			$numfilas = $stmt->num_rows;

			if ($numfilas == 1)
			{
				$getdata = mysqli_fetch_assoc($stmt);
				$id = $getdata['US_ID'];
				$login = $getdata['US_Login'];
				$nombre = $getdata['US_Nombre'];
			
				$link = linkpass($id, $login, $conn);

				if($link)
				{
					enviarcorreo($correo,$link,$nombre);
				}
				else
				{
					echo "Hubo un error";
				}

				$conn->close();
			}
			else
			{
				echo "El correo no esta asociado en la BD";
				$conn->close();
			}
		}
	}
?>