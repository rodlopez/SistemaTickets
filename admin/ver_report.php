<html>
<head>
		
	<meta charset="UTF-8">

</head>
<?php

session_start();
	
	

	
	$conexion = mysql_connect ( "localhost", "root", "" ) or
						die( "Error en la conexion" );

				mysql_select_db ( "helpdesk", $conexion ) or
						die( "Error en la Base de Datos" );

		$reportes = mysql_query( "SELECT *
									FROM reports ", $conexion ) or
						die( "Error al Cargar la Tabla " .mysql_error());

			while ( $rep = mysql_fetch_array( $reportes) ) 

				{
				
					echo "Numero de Reporte: " .$rep['id']. "<br>";

					echo "Usuario que Levanto el Reporte: " .$rep['user']. "<br>";

					echo "Id de Reporte: " .$rep['numrep']. "<br>";

						$case = $rep['tipoerror'];

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

					echo "<br> Descripcion del Problema: " .$rep['descripcion']. "<br>";

					echo "Estatus: " ;

							$esta = $rep['estatus'];

								switch ($esta)
										 {
											case '0':
												 echo "No Revisado";
												break;
											case '1':
												echo "Trabajado";
												break;

											case '2':
												echo "Resuelto";
												break;	

											default:
												# code...
												break;
										}


					

	$_SESSION['Idreport'] = $rep['numrep'];

	//$numrep = $rep['numrep'];

	//echo "Holaaaaaaaaaa" .$_SESSION['Idreport'];

	//echo "hola2 " .$numrep;

?>
				<script type="text/javascript">

					function borrar () 

					{
						location.href="deleta.php";
					}

					function modificar ()

					 {
						location.href="modrep.php";
					}

				</script>


				<form>
					
					<input type="button" onClick="borrar()" value="Borrar">

					<input type="button" onClick="modificar()" value="Modificar">

				</form>
<?php
				echo "<hr>";

				}
				//session_destroy();

?>


	
	<script type="text/javascript">

		function regresar ()

			 {
			
			 	location.href="../menus/menuadmin.html";

			}

	</script>

	<form>
		
		<input type="button" onClick="regresar()" value="Menu" >

	</form>



</html>