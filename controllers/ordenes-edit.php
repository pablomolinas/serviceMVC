<?php 

require '../fw/fw.php';
//require '../models/Clientes.php';
require '../models/Ordenes.php';
require '../views/ordenesEdit.php';


$v = new ordenesEdit(); //vista

$id = ( isset($_GET["id"]) )? $_GET["id"] : 0;
$id = ( is_numeric($id) )? $id : 0 ;

if( isset($_POST["id_orden"]) ){
	$id = $_POST["id_orden"];
}


if( $id > 0 ){
	
	$e = new Ordenes(); //modelo
	
	if(isset($_POST["accion"]))
		if($_POST["accion"]=="evento-add"){

			try {
				$e->addEvento($_POST["id_orden"], 
							  $_POST["id_evento"], 
							  date("Y-m-d"), 
							  null, 
							  $_POST["obs_evento"]
							 );
			} catch (Exception $e) {
				$v->error($e->getMessage());
			}

		}else if($_POST["accion"]=="guardar"){		
		
			if(!isset($_POST["fecha_ingreso"])) $v->error("Parametro fecha invalido.");
			if(!isset($_POST["id_cliente"])) 	$v->error("Parametro id_usuario invalido.");						
			if(!isset($_POST["id_orden_proforma"]))$v->error("Parametro mascota invalido.");		
			if(!isset($_POST["falla_declarada"])) $v->error("Parametro falla_declarada invalido.");		
			if(!isset($_POST["observacion"])) $v->error("Parametro observacion invalido.");	
			if(!isset($_POST["observacion_privada"])) $v->error("Parametro observacion privada invalido.");

			try {
				
					$e->edit( 	$_POST["id_orden"],						  	
								$_POST["fecha_ingreso"], 
								$_POST["id_cliente"],
								$_SESSION["id_usuario"],
								$_POST["pdescuento"], //descuento
								$_POST["costo"],  //costo
								$_POST["importe"],  //importe
								$_POST["id_orden_proforma"], 
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

	$v->datos = $e->getId( $id );

	if($v->datos){  


		$v->sel_proformas = $v->crearSelect( 
											[
											"datos"  		=> 	[]  ,
										 	"nombre_control"=> 	"id_orden_proforma",
										 	"sel"			=>	$v->datos["id_orden_proforma"],
										 	"requerido"		=>  0
											]
								    		);	//listado prestaciones medicas seleccionando la correspondiente
		
	

		$v->eventos = $e->getEventosId($id);
		$v->repuestos = $e->getRepuestosId($id);
		$v->reparaciones = $e->getReparacionesId($id);
		$v->pagos = $e->getPagosId($id);

		
		$v->sel_eventos = $v->crearSelect( 
									[
									"datos"  		=> (new Ordenes())->getSelectDataEstados() ,
								 	"nombre_control"=> "id_evento", 	
								 	"requerido"		=> 0
									]
						    		);

		
		$v->render();
		exit;
	}		
}
	
	$v->error('ID invalido. <p><a href="ordenes.php" >Regresar a Ordenes</a></p>');

 ?>