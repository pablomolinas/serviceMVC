<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();


										//$tabla, $id, $desc, $sel="", $desc2="", $where = "", $cssClass=" input-medium required", $toolTip = "Debes seleccionar un elemento." )
	$select_provincias = [ 	 "tabla" => "provincias",
								"id" => "id_provincia",
					   "descripcion" => "nombre",
							   "sel" => 0	];

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "partidos",
											[
												[ 		"campo" 	=> 	"id_partido" ,
															"tipo"		=> 	tipoDato::T_INT,
															"alias"		=> 	"ID" ,
															"listar" 	=>	1 ,
															"editar"	=>	0
												],
												[ 				"campo"	=> 	"nombre" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Nombre",
																"listar" => 1 ,
															 	"editar" => 1 ,
															"requerido" => 1,
																"value"	=>	"" ,
															"minlenght"	=>	2,
															"maxlenght"	=> 100	,
														"placeholder"	=> "ingresa un nombre de provincia"
												],
												[ 			"campo"	=>	"id_provincia"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Provincia",
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	1,
																"value"	=>	$select_provincias
												]	
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Partidos");
	

$v->datos = $crud->render();

$v->render();


 ?>