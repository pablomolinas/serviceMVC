<?php 

require '../fw/fw.php';
require '../models/TurnosPrestaciones.php';
require '../models/Horarios.php';
require '../models/PrestacionesMedicas.php';
require '../models/Clientes.php';
require '../models/Mascotas.php';
require '../models/Veterinarios.php';
require '../models/TurnosEstados.php';
require '../models/FacturasClientes.php';
require '../views/turnosPrestacionesAdd.php';

$v = new turnosPrestacionesAdd(); //vista

	if(isset($_POST["id_cliente"])){		
				
		if(!isset($_POST["id_prestacion_medica"]))	$v->error("Parametro prestacion medica invalido.");
		if(!isset($_POST["fecha"])) 				$v->error("Parametro fecha invalido.");
		if(!isset($_POST["id_horario"])) 			$v->error("Parametro horario invalido.");
		if(!isset($_POST["id_mascota"])) 			$v->error("Parametro mascota invalido.");		
		if(!isset($_POST["id_veterinario"])) 		$v->error("Parametro veterinario invalido.");		
		
		$e = new TurnosPrestaciones(); //modelo
		
		try {
			$e->add( 	
					  	$_POST["id_prestacion_medica"],
						$_POST["fecha"], 
						$_POST["id_horario"],						
						$_POST["id_cliente"], 
						$_POST["id_mascota"], 						
						(string)TURNO_ASIGNADO, //ASIGNADO
						$_POST["id_veterinario"]
				);
		} catch (Exception $e) {
			$v->error($e->getMessage());
		}
	
		header("Location: turnosPrestaciones");
		exit;
		
	}
	
	$fecha = (isset($_GET["fecha"]))? $_GET["fecha"] : date("Y-m-d");
	$v->datos += [ "fecha" => $fecha ];
	$id_veterinario = (isset($_GET["vet"]))? $_GET["vet"] : "" ; 
	$id_prestacion_medica = ( isset($_GET["pres"]) )? $_GET["pres"] : "";
	$id_cliente = (isset($_GET["cli"]))? $_GET["cli"] : "";
	$id_mascota = (isset($_GET["masc"]))? $_GET["masc"] : "";
	$id_horario = (isset($_GET["hora"]))? $_GET["hora"] : "";
	$v->datos += [ "id_cliente" => $id_cliente ];
		

	if($fecha != "" && $id_veterinario != ""){
				
		$v->sel_horarios = $v->crearSelect( 
											[
											"datos"  		=> (new TurnosPrestaciones())->getSelectDataFechaVet($fecha, $id_veterinario, $id_horario) ,
										 	"nombre_control"=> "id_horario",
										 	"sel"			=>	$id_horario,	
										 	"requerido"		=> 1
											]
								    		); //selecciona el horario seteado y lista el resto de los disponibles para ese dia para el veterinario indicado
	}else
		$v->sel_horarios ="";

	$v->sel_prestaciones = $v->crearSelect( 
											[
											"datos"  		=> (new PrestacionesMedicas())->getSelectData()  ,
										 	"nombre_control"=> "id_prestacion_medica",
										 	"sel"			=>	$id_prestacion_medica,	
										 	"requerido"		=> 1
											]
								    		);

	$v->sel_clientes = $v->crearSelect( 
											[
											"datos"  		=> (new Clientes())->getSelectData()  ,
										 	"nombre_control"=> "id_cliente",
										 	"sel"			=>	$id_cliente,	
										 	"requerido"		=> 1
											]
								    		);			
	
	if( $id_cliente != "" )	
		$v->sel_mascotas = $v->crearSelect( 
												[
												"datos"  		=> (new Mascotas())->getSelectDataCliente($id_cliente, $id_mascota)  ,
											 	"nombre_control"=> "id_mascota",
											 	"sel"			=>	$id_mascota,	
											 	"requerido"		=> 0
												]
								    		);					
	else
		$v->sel_mascotas = "";
	
	$v->sel_veterinarios = $v->crearSelect( 
												[
												"datos"  		=> (new Veterinarios())->getSelectData()  ,
											 	"nombre_control"=> "id_veterinario",
											 	"sel"			=>	$id_veterinario,	
											 	"requerido"		=> 1
												]
								    		);
	
	

	$v->render();
	exit;


 ?>