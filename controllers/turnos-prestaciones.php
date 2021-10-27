<?php 

//    ../controllers/turnos-prestaciones.php


require '../fw/fw.php';
require '../models/TurnosPrestaciones.php';
require '../views/turnosPrestacionesLista.php';

$e = new TurnosPrestaciones(); 		//modelo
$v = new turnosPrestacionesLista(); //vista

if(isset($_POST["desde"]) AND isset($_POST["hasta"])){
		
		$v->desde = $_POST["desde"];
		$v->hasta = $_POST["hasta"];
		
		try {
	
			if( $_SESSION["id_tipo_usuario"] == USER_ADMIN )
				$v->turnos = $e->getTodosRango( $v->desde , $v->hasta );
			else 	//si es un veterinario solo puede ver sus turnos
				$v->turnos = $e->getTodosRangoVet( $_SESSION["id_usuario"], $v->desde , $v->hasta ); 
	
		} catch (Exception $e) {
			$v->error($e->getMessage());
		}	

		$v->alertSuccess('Turnos desde '.$v->desde." hasta ".$v->hasta.'.');
		


}else{	
	$v->desde = $v->hasta = date("Y-m-d");		
	
	if( $_SESSION["id_tipo_usuario"] == USER_ADMIN )
		$v->turnos = $e->getTodosRango( $v->desde , $v->hasta );
	else 	//si es un veterinario solo puede ver sus turnos
		$v->turnos = $e->getTodosRangoVet( $_SESSION["id_usuario"], $v->desde , $v->hasta ); 
}
	
$v->render();

 ?>