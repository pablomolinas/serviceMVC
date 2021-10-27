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
require '../models/TurnosUtilizoProductosM.php';
require '../models/TurnosIndicaProductosM.php';
require '../models/TurnosIndicaPrestacionesMedicas.php';
require '../models/ProductosM.php';
require '../views/turnosPrestacionesEdit.php';
require '../funciones/getEstadosTurno.php';

$v = new turnosPrestacionesEdit(); //vista

$id = ( isset($_GET["id"]) )? $_GET["id"] : 0;
$id = ( is_numeric($id) )? $id : 0 ;

if( isset($_POST["id_turno"]) ){
	$id = $_POST["id_turno"];
}


if( $id > 0 ){
	
	$e = new TurnosPrestaciones(); //modelo
	
	if(isset($_POST["id_turno"])){		
		
		if(!isset($_POST["id_prestacion_medica"]))	$v->error("Parametro prestacion medica invalido.");
		if(!isset($_POST["fecha"])) 				$v->error("Parametro fecha invalido.");
		if(!isset($_POST["id_horario"])) 			$v->error("Parametro horario invalido.");
		if(!isset($_POST["id_factura_cliente"])) 	$v->error("Parametro factura cliente invalido.");
		if(!isset($_POST["id_cliente"])) 			$v->error("Parametro cliente invalido.");		
		if(!isset($_POST["id_mascota"])) 			$v->error("Parametro mascota invalido.");		
		if(!isset($_POST["diagnostico"])) 			$v->error("Parametro diagnostico invalido.");		
		if(!isset($_POST["id_estado_turno"])) 		$v->error("Parametro estado de turno invalido.");	
		if(!isset($_POST["id_veterinario"])) 		$v->error("Parametro veterinario invalido.");

		try {
				$e->edit( 	$_POST["id_turno"],
						  	$_POST["id_prestacion_medica"],
							$_POST["fecha"], 
							$_POST["id_horario"],
							$_POST["id_factura_cliente"], 
							$_POST["id_cliente"], 
							$_POST["id_mascota"], 
							$_POST["diagnostico"], 
							$_POST["id_estado_turno"], 
							$_POST["id_veterinario"]
						);			

			} catch (Exception $e) {
				$v->error($e->getMessage());	
			}					
		
			header("Location: turnosPrestaciones");
			exit;			
					
	}

	$v->datos = $e->getId( $id );

	if($v->datos){  

		$fecha = $v->datos["fecha"];
		$id_veterinario = $v->datos["id_veterinario"];
		$id_horario = $v->datos["id_horario"];

		if( isset($_GET["nueva_fecha"]) ) 			//la pagina recargó y recibe una nueva fecha, 
					$fecha = $_GET["nueva_fecha"];  //para la cual se listan los turnos disponibles	
		if( isset($_GET["nuevo_vet"]) ) 				   //la pagina recargó y recibe un nuevo veterinario, 
					$id_veterinario = $_GET["nuevo_vet"];  

		$v->datos += ["fecha_mostrar" => $fecha ]; 	// mostrar en el control la nueva fecha no guardada

		if( $fecha == $v->datos["fecha"] && 			
			$v->datos["id_veterinario"] != $id_veterinario ) $id_horario = ""; //si el dia es el mismo guardado, el vet no, no muestro el horario actual del turno

		$deshabilitar = ($v->datos["id_estado_turno"]==TURNO_EN_PROGRESO || 
						 $v->datos["id_estado_turno"]==TURNO_CUMPLIDO)? 1 : 0;

		$v->sel_horarios = $v->crearSelect( 
											[
											"datos"  		=> (new TurnosPrestaciones())->getSelectDataFechaVet($fecha, $id_veterinario, $id_horario) ,
										 	"nombre_control"=> "id_horario",
										 	"sel"			=>	$id_horario,	
										 	"disabled"		=>	$deshabilitar,
										 	"requerido"		=> 1
											]
								    		); //lista el horario reservado de este turno y el resto de los disponibles para ese dia para el veterinario indicado

		$v->sel_prestaciones = $v->crearSelect( 
											[
											"datos"  		=> 	(new PrestacionesMedicas())->getSelectData()  ,
										 	"nombre_control"=> 	"id_prestacion_medica",
										 	"sel"			=>	$v->datos["id_prestacion_medica"],	
										 	"disabled"		=>	$deshabilitar,
										 	"requerido"		=>  1
											]
								    		);	//listado prestaciones medicas seleccionando la correspondiente
		
		$v->sel_mascotas 	 = $v->crearSelect( 
												[
												"datos"  		=> 	(new Mascotas())->getSelectDataCliente($v->datos["id_cliente"])  ,
											 	"nombre_control"=> 	"id_mascota",
											 	"sel"			=>	$v->datos["id_mascota"],	
											 	"requerido"		=> 	0
												]
								    		);	//listado de mascotas		

		$v->sel_veterinarios = $v->crearSelect( 
												[
												"datos"  		=>  (new Veterinarios())->getSelectData()  ,
											 	"nombre_control"=>  "id_veterinario",
											 	"sel"			=>	$id_veterinario,	
											 	"disabled"		=>	$deshabilitar,
											 	"requerido"		=>  1
												]
								    		);
		//si el turno fue cancelado no permite cambiar estado, si fue cumplido tampoco
		if($v->datos["id_estado_turno"] == TURNO_CANCELADO || $v->datos["id_estado_turno"] == TURNO_CUMPLIDO)
						$deshabilitar = 1;
		else
						$deshabilitar = 0;
		//(new TurnosEstados())->getSelectData() 
		$v->sel_estado_turnos=  $v->crearSelect( 
												[
												"datos"  		=>  getEstadosTurno($v->datos["id_estado_turno"]),
											 	"nombre_control"=> "id_estado_turno",
											 	"sel"			=>	$v->datos["id_estado_turno"],	
											 	"disabled"		=>	$deshabilitar,
											 	"requerido"		=>  1
												]
								    		);

		$v->sel_facturas = 		$v->crearSelect( 
												[
												"datos"  		=> 	(new FacturasClientes())->getSelectDataCliente($v->datos["id_factura_cliente"])  ,
											 	"nombre_control"=> 	"id_factura_cliente",
											 	"sel"			=> 	$v->datos["id_factura_cliente"],	
											 	"requerido"		=> 	0
												]
								    		);
		
		// datos para visualizar si el veterinario utilizo productos en la consulta		

			$v->sel_productos_m =	$v->crearSelect( 
												[
												"datos"  		=> 	(new ProductosM())->getSelectData()  ,
											 	"nombre_control"=> 	"id_producto",	
											 	"desc_0"		=>	"Selecciona un producto medico",
											 	"requerido"		=> 	1
												]
								    		);
			
		if( isset($_GET["add-utilizo"]) )
				(new TurnosUtilizoProductosM())->add($id, $_GET["add-utilizo"]);
		if( isset($_GET["del-utilizo"]) )
				(new TurnosUtilizoProductosM())->del($id, $_GET["del-utilizo"]);
		
		$v->datos_productos_utilizados = (new TurnosUtilizoProductosM())->getTodosTurno($id);
		
		// datos para visualizar si el veterinario indico productos medicos
		$v->sel_indica_productos =	$v->crearSelect( 
												[
												"datos"  		=> 	(new ProductosM())->getSelectData()  ,
											 	"nombre_control"=> 	"id_producto_indicado",	
											 	"desc_0"		=>	"Selecciona un producto medico",
											 	"requerido"		=> 	1
												]
								    		);

		if( isset($_GET["add-indica"]) )
				(new TurnosIndicaProductosM())->add($id, $_GET["add-indica"]);
		if( isset($_GET["del-indica"]) )
				(new TurnosIndicaProductosM())->del($id, $_GET["del-indica"]);

		$v->datos_turnos_indica_productos = (new TurnosIndicaProductosM())->getTodosTurno($id);
		
		// datos para visualizar si el veterinario indico prestaciones medicas
		$v->sel_indica_prestaciones = $v->crearSelect( 
											[
											"datos"  		=> 	(new PrestacionesMedicas())->getSelectData()  ,
										 	"nombre_control"=> 	"id_prestacion_medica_indicada",
										 	"disabled"		=>	$deshabilitar,
										 	"desc_0"		=>	"Selecciona una prestacion medica",
										 	"requerido"		=>  1
											]
								    		);	//listado prestaciones medicas seleccionando la correspondiente

		if( isset($_GET["add-prest-indica"]) )
				(new TurnosIndicaPrestacionesMedicas())->add($id, $_GET["add-prest-indica"]);
		if( isset($_GET["del-prest-indica"]) )
				(new TurnosIndicaPrestacionesMedicas())->del($id, $_GET["del-prest-indica"]);

		$v->datos_turnos_indica_prestaciones = (new TurnosIndicaPrestacionesMedicas())->getTodosTurno($id);


		$v->render();
		exit;
	}		
}
	
	$v->error('ID invalido. <p><a href="turnosPrestaciones" >Regresar a Turnos</a></p>');

 ?>