<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();


										//$tabla, $id, $desc, $sel="", $desc2="", $where = "", $cssClass=" input-medium required", $toolTip = "Debes seleccionar un elemento." )
	$select_marcas = [ 	 "tabla" => "marcas",
								"id" => "id_marca",
					   "descripcion" => "nombre"
							   	];
	$select_padre = [ 	 "tabla" => "modelos",
								"id" => "id_modelo",
					   "descripcion" => "nombre"
							   	];

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "modelos",
											[
												[ 			"campo" 	=> 	"id_modelo" ,
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
														"placeholder"	=> "ingresa un nombre"
												],
												[ 				"campo"	=> 	"descripcion" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Descripcion",
																"listar" => 0 ,
															 	"editar" => 1 ,
															"requerido" => 0,
																"value"	=>	"" ,
															"minlenght"	=>	2,
															"maxlenght"	=> 200	,
														"placeholder"	=> "ingresa una descripcion"
												],
												[ 			"campo"	=>	"id_marca"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Marca",
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	1,
																"value"	=>	$select_marcas
												],
												[ 			"campo"	=>	"id_padre"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Submodelo de",
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	0 ,
																"value"	=>	$select_padre
												]	
											]
					 , 
					 " ORDER BY nombre ASC" // where para aplicar los filtros necesarios
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Modelos de Equipos");
	



$v->datos = $crud->render();

$v->render();


 ?>