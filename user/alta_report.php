<html>


<?php

	session_start();

	$_SESSION['user1'] = $_SESSION['user'];

	//echo "string" .$_SESSION['user1'];

	$conexion = mysql_connect ( "localhost", "root", "" ) or 
						die("Error en la Conexion");

				mysql_select_db( "helpdesk", $conexion ) or 
						die( "Error en la Seleccion de Base de Datos" );

				mysql_query( " INSERT INTO reports ( id_user, numrep,  id_error, descripcion, estatus ) 
									VALUES ( '$_SESSION[user1]','$_POST[idreport]', '$_POST[problem]', '$_POST[descrip]', '0') ", $conexion ) or
						die("Error al Crear el Registro " .mysql_error());

				mysql_close($conexion);

				echo "Reporte creado con Exito";

				echo "<br> Tu reporte es el: " .$_POST['idreport'];

?>

		<script type="text/javascript">

		function regresar ()

			 {
			
			 	location.href="../menus/menuuser1.php";

			}

	</script>

	<form>
		
		<input type="button" onClick="regresar()" value="Menu" >

	</form>

	
</html>