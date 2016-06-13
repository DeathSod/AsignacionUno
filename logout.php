<?php
	if(isset($_POST["Logout"]))
	{
		/*Elimino los valores del usuario que se guardaron en la sesion*/
		unset($_SESSION['username']);
		unset($_SESSION['nombre']);
		unset($_SESSION['apellido']);
		unset($_SESSION['email']);
		/*Redirecciona a la pagina de inicio*/
		header("Location:index.php");
	}
?>