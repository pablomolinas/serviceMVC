<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();


										//$tabla, $id, $desc, $sel="", $desc2="", $where = "", $cssClass=" input-medium required", $toolTip = "Debes seleccionar un elemento." )
	$select_partidos = [ 	 "tabla" => "partidos",
								"id" => "id_partido",
					   "descripcion" => "nombre",
							   "sel" => 0	];

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "localidades",
											[
												[ 		"campo" 	=> 	"id_localidad" ,
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
												[ 				"campo"	=> 	"codigo_postal" 		,
																"tipo" 	=>	tipoDato::T_INT ,
																"alias"	=>	"Codigo postal",
																"listar" => 1 ,
															 	"editar" => 1 ,
															"requerido" => 1,
																"value"	=>	0 ,							
														"placeholder"	=> "ingresa un codigo postal"
												],
												[ 			"campo"	=>	"id_partido"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Partido",
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	1,
																"value"	=>	$select_partidos
												]	
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Localidades");
	

$v->datos = $crud->render();

$v->render();


 ?>