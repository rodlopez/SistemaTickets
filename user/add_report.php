<?



session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Usuario');



if( isset($_GET['guardar']) && $_GET['guardar'] == 1){
	
	// Establecemos la conexion con el servidor
		$conexion = mysql_connect( "localhost", "root", "" ) or 
						die( "Error en la conexion" );

	//Seleccionamos la Base de Datos
		mysql_select_db ( "helpdesk", $conexion ) or 
				die( "Error en la Seleccion de Base de Datos" );

	$insert = mysql_query("INSERT INTO  reports ( numrep, id_error, descripcion, id_user, estatus)
								 VALUES ( ". date("YmdHis", time()-25300) .",'$_POST[Errores]', '$_POST[comentario]', '$_SESSION[user]', '0') 
								 ", $conexion) or 
				die("Error de Inyeccion " .mysql_error());

	if( $insert)
				echo "si";
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
							alert('Introduce tu descripcion');
							return false;

						};

						//Manda esta alerta
						//Realiza el envio del formulario
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
					

										
			})

				function regresar ()
							{

								$('#contenedor_ajax .close').trigger('click');

							}


		</script>
		<form id="form_add_user" action="../user/add_report.php?guardar=1" method="post">
			
			Introduce tu Usuario:

			<br>

			<?php

				

				$user = $_SESSION['user'];
				
			?>

			<input type="text" id="user" name="user" value="<?php echo $user; ?>" disabled="disabled">

			<br>
			<br>
			
			Selecciona el tipo de Problema. 

			<select name="Errores">
				
				<?php

						$conexion = mysql_connect( "localhost", "root", "" ) or 
									die( "Error en la conexion" );

						//Seleccionamos la Base de Datos
						mysql_select_db ( "helpdesk", $conexion ) or 
									die( "Error en la Seleccion de Base de Datos" );

						$consulta = mysql_query("SELECT *
									FROM tipos_error", $conexion) or 
									die("error");

					while ($errores = mysql_fetch_array($consulta))
					 {
					?>
						
						<option value="<?= $errores['id_error']?>"><?= $errores['error']?></option>
					
					<?
					}

				?>

			</select>


			<textarea name="comentario" id="comentario" style="width: 90%" rows="10"></textarea>
			
			<input type="submit" class="btn btn-inverse" value="Add Reporte">
		
			<input type="button" class="btn btn-danger" onClick="regresar()" value="Regresar">

		</form>
	
	</body>

</html>