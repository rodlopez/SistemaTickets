<?php
	session_start();
	include ("../functiones.php");
	validar( $_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Administrador');


	//Creamos la conexion con el Servidor
	$conexion = mysql_connect ("localhost", "root", "") or
					die("Error en la conexion");

	// Seleccionamos la Base de Datos
	mysql_select_db("helpdesk", $conexion) or
				die("Error en la Seleccion de Base de Datos");

	//Apareamos las tablas mediante INNER JOIN por medio del nombre de usuario
	$reg=mysql_query("SELECT *, CONCAT(nombre, ' ', apellipa, ' ', apellima) as nombre_completo
						FROM usuarios as users
						INNER JOIN personal as pers on users.user = pers.usuario ", $conexion) or
					die("Error en Tabla " .mysql_error());


	$reporte = mysql_query( "SELECT reports.*, reports.id as id_reporte,usuarios.*,
							 (SELECT tipos_error.error FROM tipos_error WHERE tipos_error.id_error = reports.id_error)  AS error
							 FROM reports  
						     INNER JOIN usuarios ON usuarios.user = reports.id_user");
							
										
?>
<!doctype html>
<html lang="en">
	
	<head>
	
		<meta charset="UTF-8">
	
		<title>Document</title>

		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-responsive.min.css">

		<script src="../assets/js/jquery.js"></script>
		<script src="../assets/js/bootstrap.js"></script>
		<!-- // <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
	
	</head>

	<style>

	</style>
	
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">Help Desk</a><button id="salir" style="float:right;" class=" btn btn-info">Salir</button>
					

				</div>
			</div>
		</div>

		<br>
		<br>
		<br>
		<div class="container">

			<h2>Usuarios <a id="add_user" style="float:right; font-size:.7em;" href="#"> Add User</a></h2>
			
				<h3>Mostrar</h3>

				<select name="user" id="priv" >
						
						<option></option>
						<option value="Administrador">Administradores</option>
						<option value="Usuario">Usuarios</option>

				</select>

			<table class="table table-striped  table-bordered  table-hover">
				<thead>
					<th> # </th>
					<th> Nombre </th>
					<th> Usuario </th>
					<th> Privilegios </th>
					<th> Acciones </th>
				</thead>
				<tbody>

				<?php

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
						
					
				<?php
						}

				?>



					
				</tbody>
			</table>


			<h2>Reportes</h2>

			<table class="table table-striped  table-bordered  table-hover">
				<thead>
					<th> # </th>
					<th> # reporte </th>
					<th> Error </th>
					<th> Descripción </th>
					<th> Usuario </th>
					<th> Status </th>
					<th>Action</th>
				</thead>
				<tbody>
					<?// Imprimos todos los registros que existen
					while ($registro=mysql_fetch_array($reporte)) 
						{
							?>
						<tr>
							<td><?= $registro['id_reporte']?></td>
							<td><?= $registro['numrep']?></td>
							<td><?= $registro['error']?></td>
							<td><?= $registro['descripcion']?></td>
							<td><?= $registro['user']?></td>
							<td><?= $registro['estatus']?></td>
							<td> <button class="btn btn-blue add_comentario" data-id="<?= $registro['numrep']?>"> Comentario </button></td>
							<td> <button class="btn btn-blue delete" data-id="<?= $registro['numrep']?>"> Borrar </button></td>
							<td><button class="btn btn-info ver_coment" data-id="<?= $registro['numrep']?>">Ver Comentarios</button></td>
						</tr>
						<?}
					?>
				</tbody>
			</table>

		</div>


		
		<div id="contenedor_ajax" class="modal hide fade in" >
			<div class="modal-header" style="background: peru; color: white;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="titulo"></h3>
			</div>
			<div id="html_ajax" class="modal-body">
			
			</div>		
		</div>
		

	</body>
	<script>

	//Ocupamos jquery y ajax

	$(function()
		{

			$('#salir').on('click', function(a){
				a.preventDefault();
				location.href="../index.html";
				alert('Saliendo');
			})

			$('#priv').on('change',function(a){
				a.preventDefault();
				getAjax ( 'mostrar.php',  { usuario :  $(this).parent().find('#priv').val() }, 'Usuarios')
				
			});


			//Permite agregar un nuevo usuario
			$('#add_user').on('click', function(a){
				a.preventDefault();
				getAjax("../admin/alta_user.php", null, "Add Usuario")
			})

			
		

			//Agragar comentario a Reporte
			$('.add_comentario').on('click', function(){
				getAjax('../admin/add_comentario.php', { numrep : $(this).attr('data-id') }, "Add Comentario", null );
			})

			//Borrar Reporte
			$('.delete').on('click', function(){
				getAjax('../admin/deleta.php', { numrep : $(this).attr('data-id') }, null , function(text){
					if (text.trim() == 'si') 
					{
						alert('Borrado Correctamente');
						window.location.reload();
					}
					else 
					{
						alert("No se borro");
					}

				} );
			})

			//Borrar usuario
			$('.delete_user').on('click', function(){
				getAjax('../admin/delete_user.php', { usuario : $(this).attr('data-id') }, null , function(text){
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

		$('.ver_coment').on('click', function(a){
				a.preventDefault();
				getAjax("../ver_coment.php", { numrep : $(this).attr('data-id') }, "Ver comentario")
			})
	})

	//Ocupamos Ajax para el traslado de Informacion.
	function getAjax( url, data, titulo, callback ) {
		
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