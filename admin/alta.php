	<?php
		
		//Establecemos la conexion con el servidor dando usuario y contraeña
		$conexion = mysql_connect("localhost", "root", "") or 
						die("Error en la conexion");

			//Seleccionamos la Base de Datos a ocuapar.
			mysql_select_db( "helpdesk", $conexion ) or 
					die( "Error en la Seleccion de Base de Datos" );

			//Datos a insertar en la tabla personal
			$personales = mysql_query("INSERT INTO personal ( usuario, nombre, apellipa, apellima)
							VALUES  ( '$_POST[usuario]', '$_POST[nombre]', '$_POST[apellidopa]', '$_POST[apellidoma]' )", $conexion) or  
					die( "Error en la Tabla Personal" .mysql_error() ); 
			
			//Datos a introducir a la tabla usuarios
			$user = mysql_query("INSERT INTO usuarios ( user, password, privilegios )
							VALUES ( '$_POST[usuario]', '$_POST[pass]', '$_POST[permisos]' )", $conexion ) or 
					die( "Error en la tabla Usuarios" .mysql_error() );
			
			//Corroboramos el alta del usuario
			if( $user )
				echo "si";
			else
				echo "Error";

			// Cerramos la Conexion
			mysql_close($conexion); 
	?>
