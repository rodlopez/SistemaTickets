<html>
	
	<?php

		session_start();

			$_SESSION['user']	= $_SESSION['user1'];
						//$_SESSION['pass1']

			$conexion =	mysql_connect( "localhost", "root", "" ) or
								die("Error en la conxion");

				mysql_select_db( "helpdesk", $conexion ) or 
						die("Error en la Seleccion de Base de Datos");

				$registro = mysql_query( " SELECT * 
											FROM reports
											WHERE user = '$_SESSION[user]' ", $conexion );

				while ( $reg = mysql_fetch_array($registro)) 

				{
					echo "Usuario: " .$reg['user']. "<br>";
					echo "Numero de Reporte: " .$reg['numrep']. "<br>";
					echo "Tipo de Error: " .$reg['tipoerror']. "<br>";
					echo "Descripcion de Problema: " .$reg['descripcion']. "<hr>";
				}

				mysql_close($conexion);

	?>

</html>