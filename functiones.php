<?php 
//error_reporting(0);
function validar( $user, $pass , $privilegios_get, $p_permitido){
	$salir = false;

	if( $user == "") $salir = true;

	if ( $pass == "") $salir = true;

	if( $privilegios_get != $p_permitido )  $salir = true;

	if( $salir ){
		echo "<script> window.location.href='../index.html'</script>";
		exit;
	}

}

?>