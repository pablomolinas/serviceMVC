<?php 

require '../fw/fw.php';
require '../models/Clientes.php';
require '../models/Equipos.php';
require '../models/Ordenes.php';
require '../views/ordenesAdd.php';


$v = new ordenesAdd(); //vista


$id_cliente = (!empty($_POST["id_cliente"]))? $_POST["id_cliente"] : 0 ;
$id_propietario = (!empty($_POST["id_propietario"]))? $_POST["id_propietario"] : 0 ;
$v->fecha_ingreso = (!empty($_POST["fecha_ingreso"]))? $_POST["fecha_ingreso"] : date("Y-m-d") ;
$id_equipo = (!empty($_POST["id_equipo"]))? $_POST["id_equipo"] : 0 ;

	
	if(isset($_POST["accion"]) )
		if($_POST["accion"] =="guardar"){		
		
		if(!isset($_POST["fecha_ingreso"])) $v->error("Parametro fecha invalido.");
		if(!isset($_POST["id_cliente"])) 	$v->error("Parametro id_usuario invalido.");					
		if(!isset($_POST["id_equipo"]))$v->error("Parametro id_equipo invalido.");		
		if(!isset($_POST["falla_declarada"])) $v->error("Parametro falla_declarada invalido.");		
		if(!isset($_POST["observacion"])) $v->error("Parametro observacion invalido.");	
		if(!isset($_POST["observacion_privada"])) $v->error("Parametro observacion privada invalido.");

		$e = new Ordenes(); //modelo

		try {
			
				$e->add( 	$_POST["id_equipo"],
							$_POST["id_cliente"],						  	
							$_POST["fecha_ingreso"],
							$_SESSION["id_usuario"], 
							1, 							
							$_POST["falla_declarada"], 
							$_POST["observacion"], 
							$_POST["observacion_privada"]					
						);			

			} catch (Exception $e) {
				$v->error($e->getMessage());	
			}					
		
			header("Location: ordenes.php");
			exit;			
					
	}

			
	$v->sel_clientes = $v->crearSelect( 
									[
									"datos"  		=> 	(new Clientes)->getSelectData() 	  ,
								 	"nombre_control"=> 	"id_cliente",
								 	"sel"			=>	$id_cliente,
								 	"requerido"		=>  0
									]
						    		);	//listado prestaciones medicas seleccionando la correspondiente
	$v->sel_propietarios = $v->crearSelect( 
									[
									"datos"  		=> 	(new Clientes)->getSelectData() 	  ,
								 	"nombre_control"=> 	"id_propietario",
								 	"sel"			=>	$id_propietario,
								 	"requerido"		=>  0
									]
						    		);	//listado prestaciones medicas seleccionando la correspondiente

	$v->sel_equipos = $v->crearSelect([
								"datos"  		=> (new Equipos())->getSelectDataCliente($id_propietario) ,
							 	"nombre_control"=> "id_equipo", 
							 	"sel"			=>	$id_equipo,	
							 	"requerido"		=> 0
								]);


		
	$v->sel_eventos = $v->crearSelect( 
								[
								"datos"  		=> (new Ordenes())->getSelectDataEstados() ,
							 	"nombre_control"=> "id_evento", 	
							 	"requerido"		=> 0
								]
					    		);

		
		$v->render();
		exit;
			


 ?>