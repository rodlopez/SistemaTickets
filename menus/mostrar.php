<?
	
	session_start();
	include ("../functiones.php");
	validar( $_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Administrador');

?>

<html>

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-responsive.min.css">
	<script src="../assets/js/jquery.js"></script>
		<script src="../assets/js/bootstrap.js"></script>

<?

$conexion = mysql_connect ( "localhost", "root", "") or 
						die("Error de conexion");

				mysql_select_db( "helpdesk", $conexion ) or 
						die("Erro en la selecion");

	// $registros = mysql_query( "SELECT *,  CONCAT(nombre, ' ', apellipa, ' ', apellima) as nombre_completo
	// 								FROM usuarios as user
	// 								INNER JOIN personal as pers on users.user = pers.usuario
	// 								WHERE privilegios = '$_POST[usuario]'");

	$reg=mysql_query("SELECT *, CONCAT(nombre, ' ', apellipa, ' ', apellima) as nombre_completo
						FROM usuarios as users
						INNER JOIN personal as pers on users.user = pers.usuario
						WHERE privilegios = '$_POST[usuario]' ", $conexion) or
					die("Error en Tabla " .mysql_error());


?>		

		<table class="table table-striped  table-bordered  table-hover">
				<thead>
					<th> # </th>
					<th> Nombre </th>
					<th> Usuario </th>
					<th> Privilegios </th>
					<th> Acciones </th>
				</thead>
				<tbody>

				<?

					while ( $usuario = mysql_fetch_array($reg)  )

						 {
				?>				
					
						
				   		<tr>
							
							<td><?= $usuario['id']?></td>
							<td><?= $usuario['nombre_completo']?></td>
							<td><?= $usuario['user']?></td>
							<td><?= $usuario['privilegios']?></td>
							<td><button class="btn btn-blue delete_user" data-id="<?= $usuario['user']?>"> Borrar </button></td>
							
						</tr>
						
					
				<?
						}

				?>
				


					
				</tbody>
			</table>

				<input type="button" class="btn btn-info" style="float:right;" onClick="regresar()" value="Salir">  
		
		<script type="text/javascript">

			function regresar ()
							{

								$('#contenedor_ajax .close').trigger('click');

							}

			
				$('.delete_user').on('click', function(){
				Ajax('../admin/delete_user.php', { usuario : $(this).attr('data-id') }, null , function(text){
						if (text.trim() == 'si') 
							{
								alert('Borrado Coreectamente');
								window.location.reload();
							}
							else 
								{
									alert("No se borro");
								}

				} );
			})

			function Ajax ( url, data, titulo, callback)
					{
							
						$.ajax({
							
							url : url,
				
							type : "POST",
							
							data : data,

									success : function( text ){
								
										if( titulo != null){
											
											$("#contenedor_ajax .titulo" ).text( titulo );
											$("#contenedor_ajax #html_ajax" ).html( text );
											$('#contenedor_ajax').modal();
										
										}
										
											if( callback != undefined ) callback( text );
									}
						
				 		})

					}






		</script>
</html>