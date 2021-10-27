<?php 

//    ../controllers/turnos-prestaciones.php


require '../fw/fw.php';
require '../models/TurnosPrestaciones.php';
require '../views/turnosPrestacionesCancel.php';


$v = new turnosPrestacionesCancel(); //vista

if( isset($_GET["id"]) ){
	
	$e = new TurnosPrestaciones(); 		//modelo				
	
	try{
	
		$e->cancelarTurno($_GET["id"]);
	
	}catch(exception $e){
		$v->error("<p>".$e->getMessage().'<a href="turnosPrestaciones"> Regresar</a></p>');
	}
	
	header("Location: /veterinaria/turnosPrestaciones");
	exit;
	
}
	$v->info = "Error al cancelar turno.";
	$v->error();




 ?>