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
					echo "Tipo de Error: " ;

							$case = $reg['tipoerror'];

							switch ($case) 
									{
										case '1': echo "No enciende";
											break;
							
										case '2': echo "Se traba";
											break;

										case '3': echo "No Reconoce nuevos dispositivos";
											break;

										case '4': echo "No Funciona Tecaldo/Mouse";
											break;

										case '5': echo "No lee Discos";
											break;

										case '6': echo "Monitor no se Ve";
											break;

										case '7': echo "Instalar un Programa nuevo";
											break;

										case '8': echo "Actualizar algun Programa";
											break;

										case '9': echo "Borrar algun Programa";
											break;

										case '10': echo "Programa No sirve";
											break;

										case '11': echo "Acceso a una Pagina Externa";
											break;

										case '12': echo "No puedo Acceder a ninguna Pagina";
											break;

										case '14': echo "Alta de Usuario ";
											break;

										case '15': echo "Baja de Usuario";
											break;

										case '16': echo "Solicitar Cambio de Contraseña";
											break;

										case '17': echo "Solicitar Cambio de Permisos";
											break;
											
										
										default:
											# code...
											break;
									}

					echo "<br>Descripcion de Problema: " .$reg['descripcion']. "<br>";

					echo "Estatus: ";

							$esta = $reg['estatus'];

								switch ($esta)
										 {
											case '0':
												 echo "No Revisado<hr>";
												break;
											case '1':
												echo "Trabajado<hr>";
												break;

											case '2':
												echo "Resuelto<hr>";
												break;	

											default:
												# code...
												break;
										}

				}

				mysql_close($conexion);

	?>

	<body>
		
		<script type="text/javascript">

			function menu ()
			 {
				location.href="../menus/menuuser.php"
			}

		</script>

		<form>
			
			<input type="button" onClick="menu()" value="Menu">

		</form>


	</body>

</html>