<html>
<?php
	
	$conexion = mysql_connect( "localhost", "root", "") or 
						die("Error en la conexion");

				mysql_select_db( "helpdesk", $conexion) or 
						die("Error en la Seleccion de Base de Datos " .mysql_error());

	$comentarios = mysql_query( "SELECT *
									FROM reports AS rep
									INNER JOIN tipos_error AS tipos  ON rep.id_error = tipos.id_error 
									WHERE numrep = '$_POST[numrep]'", $conexion) or 
						die("Error en la Consula" .mysql_error());

	$reports = mysql_query( "SELECT *
								FROM reports AS rep 
								INNER JOIN reportes_comentarios AS coment ON rep.numrep = coment.id_reporte
								WHERE numrep = '$_POST[numrep]' ", $conexion) or 
						die("Error en la Consulta 2 " .mysql_error());
?>
				<table class="table table-striped  table-bordered  table-hover">
					<!-- <th> # </th> -->
					<th> # reporte </th>
					<th> # comentario </th>
					<th> Usuario </th>
					<th> Error </th>
					<th> Descripción </th>

				<tbody>
				
<?
		
		$com = mysql_fetch_array($comentarios);
		
		while ($coment = mysql_fetch_array($reports)) 
				{

				echo "<tr>";
					//echo "<td>" .$com['id']. "</td>" ;
					echo "<td>" .$com['numrep']. "</td>" ;
					echo "<td>" .$coment['date']. "</td>" ;
					echo "<td>" .$coment['user_coment']. "</td>" ;
					echo "<td>" .$com['error']. "</td>" ;
					echo "<td>" .$coment['comentario']. "</td>" ;
				echo "</tr>";
				}

?>
					
					

					
				</tbody>
					
				</table>

<?
	mysql_close($conexion);
?>
<script type="text/javascript">
	
	function regresar ()
							{

								$('#contenedor_ajax .close').trigger('click');

							}

</script>

	<input type="button" class="btn btn-warning" onClick="regresar()" value="Regresar">
				
</html>