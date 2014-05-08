<html>

<?php



session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Usuario');



$conexion = mysql_connect ( "localhost", "root", "" ) or
						die( "Error en la conexion" );

				mysql_select_db ( "helpdesk", $conexion ) or
						die( "Error en la Base de Datos" );

		$reportes = mysql_query( "SELECT *
									FROM reports AS report 
									INNER JOIN tipos_error AS error ON report.id_error = error.id_error
									WHERE numrep = '$_POST[numrep]'", $conexion ) or
						die( "Error al Cargar la Tabla " .mysql_error());
//echo "string " .$_POST['numrep'];

			if ( $rep = mysql_fetch_array( $reportes) ) 

				{
				
				?>

				<body>

				<table class="table table-striped  table-bordered  table-hover">
				
				<thead>
					
					<th>Numero de Reporte</th>
					<th>Usuario</th>
					<th>Tipo de Error </th>
					<th>Descripcion</th>
				
				</thead>
					

					<tbody>
						
						<td><?= $rep['numrep'] ?></td>
						<td><?= $rep['id_user'] ?></td>
						<td><?= $rep['error']?></td>
						<td><?= $rep['descripcion']?></td>

					</tbody>


				</table>
				
				<input type="button" class="btn btn-danger" onClick="regresar()" value="Regresar">					

		<script type="text/javascript">

			function regresar ()

			 {
				location.href="../menus/menuuser1.php"
			}

		</script>

						<?

						}

				else {
					echo "El reporte no existe";

?>


	

	<form>
		

		<input type="button" class="btn btn-danger" onClick="regresar()" value="Regresar">

	</form>
	
	</body>

</html>

<?php

				}

?>

