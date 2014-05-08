<?php
	
	session_start();

	include ("../functiones.php");

	validar($_SESSION['user'], $_SESSION['pass'], $_SESSION['privilegios'], 'Usuario');

	//Creamos conexion con el servidor
	$conexion = mysql_connect( "localhost", "root", "") or 
						die("Error en la conexion");

				mysql_select_db( "helpdesk", $conexion) or 
						die("Error en la Base de Datos");
	
	// $reportes = mysql_query("SELECT * 
	// 							FROM reports
	// 							WHERE user = '$_SESSION[user]'")

	$misreportes =	mysql_query("SELECT *
							FROM reports AS report
							INNER JOIN tipos_error AS tip_er ON report.id_error = tip_er.id_error
							WHERE id_user = '$_SESSION[user]'", $conexion)	or 
						die("Error en la consulta " .mysql_error());

	$user	=	mysql_query("SELECT *
											FROM reports AS report
											INNER JOIN tipos_error AS tip_er ON report.id_error = tip_er.id_error
											WHERE id_user = '$_SESSION[user]'", $conexion)	or 
										die("Error en la consulta " .mysql_error());


				?>

<html lang="en">
	
	<head>
	
		<meta charset="UTF-8">
	
		<title>Document</title>

		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-responsive.min.css">

		<script src="../assets/js/jquery.js"></script>
		<script src="../assets/js/bootstrap.js"></script>
	
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
					<a class="brand" href="#">Help Desk</a>
		
					<div style="float: right;">
						<input type="text" name="numrep"  id="valor" class="input-medium search-query">
						     
  						<button class="btn btn-info search"  data-text="valor" >Search</button>
  						
  					</div> 



					<button style="float: ;" class="btn btn-danger  salir">Salir</button>
				</div>
			</div>
		</div>


		<br>
		<br>
		<br>
		<div class="container">

			<?
						//$usuario = mysql_fetch_array($user);
					
						//echo "user" .$usuario['id_user'];
					
			?>

			<h2> Mis Reportes <a id="add_report" style="float:right; font-size:.7em;" href="#">Add Report </a></h2>
				
			
					

				<table class="table table-striped  table-bordered  table-hover">
					
					<thead>
						
					<th> # </th>
					<th> Usuario </th>
					<th> Num Reporte </th>
					<th> Tipo Error </th>
					<th> Descricion </th>
					<th> Estatus </th>
					<th> Action </th>

					</thead>

					<tbody>
						
					<?php 

						while ($misrep = mysql_fetch_array($misreportes))
						 {
							
						?>

						<tr>
							
							<td><?= $misrep['id']?></td>
							<td><?= $misrep['id_user']?></td>
							<td><?= $misrep['numrep']?></td>
							<td><?= $misrep['error']?></td>
							<td><?= $misrep['descripcion']?></td>
							<td><?= $misrep['estatus']?></td>
							<td><button class="btn btn-inverse view_coment" data-id="<?= $misrep['numrep']?>">Ver Comentaios</button></td>
							<td><button class="btn btn-inverse add_coment" data-id="<?= $misrep['numrep']?>">Agregar Comentario</button></td>
							

						</tr>
					

						<?php
						}
						?>
						
					</tbody>


				</table>			
					

		</div>


		<!-- Este Div nos Permite agregar un reporte nuevo. -->
		<div id="contenedor_ajax" class="modal hide fade in" >
			<div class="modal-header" style="background: peru; color: white;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="titulo"></h3>
			</div>
			<div id="html_ajax" class="modal-body">
			
			</div>		
		</div>

</body>

		
		<script type="text/javascript">

			$(function()
		{
			$('.salir').on('click', function(a){
				a.preventDefault();
				location.href="../index.html";
				alert('Saliendo');
			})

			$('.search').on('click', function(){
				getAjax('../user/search_report.php', { numrep : $(this).parent().find('#valor').val() } , "Reporte", null );

				
			})
			
			$('#add_report').on('click', function(){
				getAjax('../user/add_report.php', { id_user : $(this).attr('data-id') }, "Add Reporte", null );

				
			})

			$('.view_coment').on('click',function(){
				getAjax('../ver_coment.php', { numrep : $(this).attr('data-id') }, "Expediente Del Reporte", null );
			})

			$('.add_coment').on('click', function(){
				getAjax("../user/add_comentario_user.php", { numrep : $(this).attr('data-id')}, "Add Coment", null);
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