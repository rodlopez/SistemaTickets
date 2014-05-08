<html>
	
	<head>
	
		<title> .:Usuarios Registrados:. </title>
	
	</head>
	
	<?php
			//Creamos la conexion con el Servidor
		$conexion = mysql_connect ("localhost", "root", "") or
						die("Error en la conexion");

			// Seleccionamos la Base de Datos
			mysql_select_db("helpdesk", $conexion) or
						die("Error en la Seleccion de Base de Datos");

			//Apareamos las tablas mediante INNER JOIN por medio del nombre de usuario
			$reg=mysql_query("SELECT *
								FROM usuarios as users
								INNER JOIN personal as pers on users.user = pers.usuario ", $conexion) or
							die("Error en Tabla " .mysql_error());

			// Apareamos las tablas por medio de WHERE
			/*$reg = mysql_query("SELECT * 
									FROM usuarios,personal
									WHERE usuarios.user = personal.usuario", $conexion)	or 
						die("Error en la tabla " .mysql_error());*/

			// Imprimos todos los registros que existen
		while ($registro=mysql_fetch_array($reg)) 
			{
				echo "Usuario: " .$registro['usuario']. "<br>";
				echo "Nombre: " .$registro['nombre']." " .$registro['apellipa']. " " .$registro['apellima']. "<br>";
				echo "Logeado como: " .$registro['privilegios']. "<br>";
				echo "<hr>";
			}

		//Cerramos la conexion
		mysql_close($conexion);


	?>

	
		
		<script type="text/javascript">

			//Funcion para regresar al login cuando los datos son erroneos
								function regresar ()  
				 					
				 					{
									
										//alert("Entro a la function");   
										location.href= "../menus/menuadmin.html";   //Pagina a la que se redigira

									}

		</script>

		<form>
			
			<input type="button" onclick="regresar()" value="Menu">

		</form>

		
</html>