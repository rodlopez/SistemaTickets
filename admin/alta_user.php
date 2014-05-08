<html>

<?

session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Administrador');

?>
	
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
					if  ( document.getElementById('name').value == 0 ) 
						
						{
							//Manda esta alerta
							alert('Introduce tu nombre');
							return false;

						};

					//Verificamos que el campo apepa no este vacio
					if  ( document.getElementById('apepa').value == 0 ) 
						
						{
							//Manda esta alerta
							alert('Introduce apellido paterno');
							return false;

						};

					//Verificamos que el campo apema no este vacio
					if  ( document.getElementById('apema').value == 0 )
					 	
					 	{
					 		//Manda esta alerta
					 		alert('Introduce apellido materno');
					 		return false;
					 	};

					 //Verificamos que el campo user no este vacio
					if  ( document.getElementById('user').value == 0 ) 
						
						{
							//Manda esta alerta
							alert('Falta tu usuario');
							return false;

						};	

					//Verificamos que el campo pass no este vacio
					if  ( document.getElementById('pass').value == 0 ) 
						
						{
							//Manda esta alerta
							alert('Falta password');
							return false;

						};

					//Verificamos que el campo pass1 no este vacio
					if  ( document.getElementById('pass1').value == 0 )
						 
						 {
						 	//Manda esta alerta
						 	alert('Falta Confirmar tu password');
						 	return false;

						 };

					// creamos dos variables para guardar las contraseñas
					var password = document.getElementById('pass').value;
					var password1 = document.getElementById('pass1').value;

					
					//Veridicamos que la contraseña no tengas mas de 10 caracteres
					if  ( password.length > 10 )
					
					 {
						//Manda esta alerta
					 	alert('Tu password debe de tener maximo 10 caracteres.');
					 	return false;

					 }// else{};					
					//alert('pass = ' +password);
					//alert('pass1 = ' +password1);
					
					//Comprobamos que las contraseñas coincidan
					if  ( password == password1 ) 

						{
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
						} 

						//Si las contraseñas no coinciden
						else
						
							{
								//Manda esta alerta
								alert('Tus password no coinciden');
								return false;
							};
					/*if (password==password1)
						{
							alert('Tus password coinciden');
							//document.getElementById('form').submit();
						};
					else 
					{
						alert('Tus password no coinciden');
					}*/

										
			})

				function regresar ()
							{

								$('#contenedor_ajax .close').trigger('click');

							}


		</script>
		<form id="form_add_user" name="form" action="../admin/alta.php" method="post">
			
			Ingrese su nombre:
			
			<input type="text" name="nombre" id="name">
			
			<br>
			
			Ingrese apellido paterno:
			
			<input type="text" name="apellidopa" id="apepa">
			
			<br>
			
			Ingrese apellido materno:
			
			<input type="text" name="apellidoma" id="apema">
			
			<br>
			
			Usuraio:
			
			<input type="text" name="usuario" id="user">
			
			<br>
			
			Password:
			
			<input type="password" name="pass" id="pass">
			
			<br>
			
			Confirmar Password:
			
			<input type="password" name="pass1" id="pass1">
			
			<br>
			
			<select name="permisos">
			
				<option> </option>
			
				<option value="Usuario">Usuario</option>
			
				<option value="Administrador">Administrador</option>
			
			</select>
			
			<br>
			
			<input type="submit" class="btn btn-inverse" value="Crear usuario">
		
			<input type="button" class="btn btn-danger" onClick="regresar()" value="Regresar">

		</form>
	
	</body>

</html>