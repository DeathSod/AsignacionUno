<?php
	/*Esta funcion elimina cualquier dato perjudicial para poder meterla en la BD*/
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if(isset($_POST['Boton'])){

		/*Se crea un array que se usará después para verificar que no hay campos obligatorios vacios*/
		$data = array();

		if(empty($_POST['login']))
		{
			$data[] = 'Login';
		}
		else
		{
			$login = test_input($_POST['login']);
		}

		if(empty($_POST['pass']) || $_POST['pass'] != $_POST['passagain'])
		{
			$data[] = 'Contraseña';
		}
		else{
			$contra = test_input($_POST['pass']);
		}

		if(empty($_POST['email']))
		{
			$data[] = 'Correo';
		}
		else
		{
			$correo = test_input($_POST['email']);
		}

		if(empty($_POST['name']))
		{
			$data[] = 'Nombre';
		}
		else
		{
			$nombre = test_input($_POST['name']);
		}

		if(empty($_POST['lastname']))
		{
			$data[] = 'Apellido';
		}
		else
		{
			$apellido = test_input($_POST['lastname']);
		}

		if(empty($data))
		{
			/*Crea la conexion con la BD*/
			require_once('conexionmysql.php');

			/*El sql que se usara para insertar los datos en la BD*/
			$sql = "INSERT INTO Usuario (US_Login, US_Pass, US_Mail, US_Nombre, US_Apellido) VALUES 
					(?, ?, ?, ?, ?)";

			/*Prepara la base de datos donde se va a efectuar el sql*/
			$statement = mysqli_prepare($conn,$sql);

			/*Asigna los valores a las variables en el sql reemplazando los ?*/
			/*Las s indican cada valor que se le asigna a cada variable, como es s es string y se coloca 5 veces porque son 5 variables*/
			mysqli_stmt_bind_param($statement, "sssss", $login, $contra, $correo, $nombre, $apellido);

			/*Ejecuta el sql*/
			mysqli_stmt_execute($statement);

			/*Verifica que la sentencia se ejecuto y se insertaron los valores en la BD*/
			$aff_col = mysqli_stmt_affected_rows($statement);

			if ($aff_col == 1)
			{
				echo 'Usuario agregado';
				/*Cierra la sentencia*/
				mysqli_stmt_close($statement);
				/*Cierra la conexion con la BD*/
				mysqli_close($conn);
			}
			else
			{
				echo "Ocurrio un error <br />";
				/*Muestra el error relacionado con la BD*/
				echo mysqli_error();
				mysqli_stmt_close($statement);
				mysqli_close($conn);	
			}

		}
		else
		{
			echo "Fallo el registro debido a que las validaciones de los siguientes datos no se cumplieron: <br />";
			foreach($data as $obj)
			{
				echo "$obj<br />";
			}
		}
	}
?>