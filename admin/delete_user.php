<?php

	session_start();



			$conexion=mysql_connect("localhost","root","") or
			 				 die("Problemas en la conexion");

			mysql_select_db("helpdesk", $conexion) or
			  				die("Problemas en la selección de la base de datos");

			$delete =   mysql_query("DELETE 
										FROM usuarios 
										WHERE user = '$_POST[usuario]'",$conexion) or
			    die("Problemas en el select:".mysql_error());

			 $comentarios = mysql_query("DELETE 
			 							FROM personal 
			 							WHERE usuario = '$_POST[usuario]'",$conexion) or
			    die("Problemas en el select:".mysql_error());

			if( $delete && $comentarios)
				echo "si";
			else
				echo "no";
			

			

			mysql_close($conexion);

?>
