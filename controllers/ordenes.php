<?php 

//    ../controllers/ordenes.php


require '../fw/fw.php';
require '../models/Ordenes.php';
require '../views/ordenesLista.php';

$e = new Ordenes(); 		//modelo
$v = new ordenesLista(); 	//vista

if( !empty($_POST["serie"]) ){

	$v->datos = $e->getSerie($_POST["serie"]);
	$v->alertSuccess('Resultado/s para: '.$_POST["serie"]);

}
else if(isset($_POST["desde"]) AND isset($_POST["hasta"])){
		
		$v->desde = $_POST["desde"];
		$v->hasta = $_POST["hasta"];
		
		try {
	
			$v->datos = $e->getTodosRango( $v->desde , $v->hasta );
			
	
		} catch (Exception $e) {
			$v->error($e->getMessage());
		}	

		$v->alertSuccess('datos desde '.$v->desde." hasta ".$v->hasta.'.');
		


} else{	
	$v->desde = date( "Y-m-d", strtotime( date("Y-m-d")." -1 month" ) );
	$v->hasta = date("Y-m-d");		
	
		$v->datos = $e->getTodosRango($v->desde , $v->hasta);
	
}
	
$v->render();

 ?>