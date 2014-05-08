<html>

<?

session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Administrador');

?>
	
	<head>
		
		<meta charset="UTF-8">

	</head>
<?php
	session_start();
	$_SESSION['newpass'] = $_POST['newpass'];
	$_SESSION['user'] = $_POST['usuario'];

	$conexion = mysql_connect( "localhost", "root", "") or 
						die("Error en la conexion");

				mysql_select_db( "helpdesk", $conexion ) or 
						die("Error en la Seleccion de Base de Datos");

	$update	=	mysql_query("UPDATE usuarios 
							SET password = '$_SESSION[newpass]'
							WHERE user = '$_SESSION[user]' ", $conexion ) or 
						die("Error al Actualizar" .mysql_error());

if( $update )
				echo "si";
			else
				echo "Error";

				mysql_close($conexion);
?>

</html>