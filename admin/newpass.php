<!doctype html>
<html lang="en">

<?

session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Administrador');

?>

	
	<head>
	
		<meta charset="UTF-8">
	
		<title>Document</title>
	
	</head>
	
	<body>
		
		<form action="buscar.php" method="post">
			
			Usuario :
			<input type="text" name="user">
			<br>
			<input type="submit" value="buscar">

		</form>
		
	</body>

</html>