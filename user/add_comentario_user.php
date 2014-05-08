<?



session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Usuario');



if( isset($_GET['guardar']) && $_GET['guardar'] == 1){
	
	// Establecemos la conexion con el servidor
		$conexion = mysql_connect( "localhost", "root", "" ) or 
						die( "Error en la conexion" );

		//$us = $_POST['numrep'];

	//Seleccionamos la Base de Datos
		mysql_select_db ( "helpdesk", $conexion ) or 
				die( "Error en la Seleccion de Base de Datos" );

				//echo "" .$_POST['estatus']. "" .$_POST['numrep'];

	//$update = mysql_query("UPDATE reports SET estatus = '$_POST[estatus]' WHERE numrep = '$_POST[numrep]' ",$conexion) or 
			//	die("Error " .mysql_error());



	$usuario = mysql_query("SELECT *
					FROM reports AS rep
					INNER JOIN reportes_comentarios AS coment ON rep.numrep = coment.id_reporte
					WHERE numrep = '$_POST[numrep]' ", $conexion) or
				die ("Error 1" .mysql_error());


	$useri = mysql_query( "SELECT *
					FROM reports
					WHERE numrep = '$_POST[numrep]'", $conexion) or 
				die("Error 2 " .mysql_error());
	

	if ($user = mysql_fetch_array($useri))

		{
			$user['id_user'];
		}

	//echo "string1" .$us;
	//echo "string2" .$user['id_user'];


	$insert = mysql_query("INSERT INTO  reportes_comentarios (id_reporte, date, 
												id_user, comentario, user_coment)
							VALUES ( '$_POST[numrep]', '$_POST[idreport]' , 
								 				'$user[id_user]', '$_POST[comentario]', '$_SESSION[user]')
								  ") or 
				die("Error " .mysql_error());

	if( $insert && $insert )
		echo"si";
	else
		echo "no";

	exit();
}
?>

<html>
	
	<head>
	
		<title></title>
	
		<meta charset="UTF-8">
	
	</head>
	
	<body>

		<script type="text/javascript">
			
			$('#form_add_user').on('submit', function(e){
				e.preventDefault();
					//var usuario, password, password1;
					//usuario=document.getElementById('user');
					//Verificamos que el campo name no este vacio
					if  ( document.getElementById('comentario').value == 0 ) 
						
						{
							//Manda esta alerta
							alert('Introduce tu comentario');
							return false;

						};

						//Manda esta alerta
						//Realiza el envio del formulario
						getAjax( $(this).attr('action'), $(this).serialize(), null, function( text ){
							if( text.trim() == "si"){
								alert("Guardado Correctamente");
								$('#contenedor_ajax .close').trigger('click');
									window.location.reload();
								return false;
							} else {
								alert("Error al guardar");
								console.log( text );
								return false;
							}

						})
					

										
			})

				function regresar ()
							{

								$('#contenedor_ajax .close').trigger('click');

							}


		</script>
		<form id="form_add_user" action="../user/add_comentario_user.php?guardar=1" method="post">
			<input type="hidden" name="numrep" value="<?= $_POST['numrep']?>" />

			<!-- <select name="estatus" id="estatus">
				<option value="Abierto">Abierto</option>
				<option value="Trabajando">Trabajando</option>
				<option value="Cerrado">Cerrado</option>
			</select>
 -->
			<textarea name="comentario" id="comentario" style="width: 90%" rows="10"></textarea>

			<input type="hidden" name="idreport"  value="<?php echo date("YmdHis",time()-25300) ?>">
			
			<input type="submit" class="btn btn-info" value="Add Comentario">
		
			<input type="button" class="btn btn-warning" onClick="regresar()" value="Regresar">

		</form>
	
	</body>

</html>