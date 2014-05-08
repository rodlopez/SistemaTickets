<?php
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
									WHERE user = '$_POST[usuario]' ", $conexion) or
						die( "Error en la tabla " .mysql_error());

			if ( $reg = mysql_fetch_array($registros)) 
				{
				
				echo "Usuario: " .$reg['usuario']. "<br>";
				echo "Nombre: " .$reg['nombre']." " .$reg['apellipa']. " " .$reg['apellima']. "<br>";
				echo "Logeado como: " .$reg['privilegios']. "<br>";
				echo "<hr>";

				}

?>

<html>

	<script type="text/javascript">

	$('#form_new_pass').on('submit', function(e){
				e.preventDefault();

				getAjax( $(this).attr('action'), $(this).serialize(), null, function( text ){
								if( text.trim() == "si"){
									alert("Guardado Correctamente");
									window.location.reload();
									return false;
								} else {
									alert("Error al guardar");
									console.log( text );
									return false;
								}

							})

				)}





	function regresar ()
							{

								$('#contenedor_ajax .close').trigger('click');

							}


	</script>
	
	<form id="form_new_pass" action="actualizapass.php" method="post">
		
		<input type="text" value="<?php  echo $_POST['user']; ?>" name="usuario" readonly="readonly">

		Ingrese nuevo pasword:

		<input type="password" name="newpass">

		<input type="submit" value="Cambiar">

	</form>
	
</html>