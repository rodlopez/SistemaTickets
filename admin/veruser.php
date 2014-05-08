	<?php

		session_start();

		// Establecemos la conexion con el servidor
		$conexion = mysql_connect( "localhost", "root", "" ) or 
						die( "Error en la conexion" );

			//Seleccionamos la Base de Datos
				mysql_select_db ( "helpdesk", $conexion ) or 
						die( "Error en la Seleccion de Base de Datos" );

			// Apareamos las tablas y seleccionamos los campos a comparar para el acceso
		$registros = mysql_query( " SELECT *
									FROM usuarios as users 
									INNER JOIN personal as pers on users.user = pers.usuario
									WHERE user = '$_POST[usuario]' and password = '$_POST[password]' LIMIT 0,1", $conexion) or
						die( "Error en la tabla " .mysql_error());

			$reg=mysql_fetch_array($registros);

			$_SESSION['id_user'] = $reg['id'];
			$_SESSION['user'] = $_POST['usuario'];
			$_SESSION['pass'] = $_POST['password'];
			$_SESSION['privilegios'] = $reg['privilegios'];

			
			// Verificamos si el usuario existe y si la contraseña coincide
			if ( $reg )
				
				{
					//Si los datos coinciden da la bienvenida
					echo "Hola bienvenido : " .$reg['privilegios']. " " .$reg['nombre']. "<br>";  
						

						//El valor de Privilegios lo aginamos a una variable
						$permisos= $reg['privilegios'];

						
						//Dependiendo de la cadena devuelta por privilegios se efectua alguno de los casos
						switch ($permisos) 
							
							{
								
								
								case 'Administrador':
										//echo "Eres Administrador";
										header('Location:../menus/menuadmin.php');

								break;
				
								case 'Usuario':
										
										header('Location:../menus/menuuser1.php');
								break;
				
								default:
								break;
							}
				}

			// si los datos son erroneos
			else
			 {
			 	// Pide verificar los datos
			 	echo "Datos invalidos favor de verificar la informacion";
	?>
			 		<html>
						<script type="text/javascript">
								
								//Funcion para regresar al login cuando los datos son erroneos
								function on(){
									setTimeout(function(){
										window.location.href = "../index.html";
									},400)
									
								}

						</script>
			 		<body  onload="on()">
		
		
					</body>
					</html>
		
	<?php
			}
	?>
	
	


