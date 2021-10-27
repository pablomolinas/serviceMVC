<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

										//$tabla, $id, $desc, $sel="", $desc2="", $where = "", $cssClass=" input-medium required", $toolTip = "Debes seleccionar un elemento." )
	$select_moneda = [ 	 "tabla" => "monedas",
									"id" => "id_moneda",
						   "descripcion" => "nombre",
								   "sel" => 1	];


	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "reparaciones",
				[
					[ 			"campo" 	=> 	"id_reparacion" ,
								"tipo"		=> 	tipoDato::T_INT,
								"alias"		=> 	"ID" ,
								"listar" 	=>	1 ,
								"editar"	=>	0
					],												
					[ 				"campo"	=>	"nombre" ,
									"tipo"	=>	tipoDato::T_TEXT  ,
									"alias"	=>	"Nombre" 		,
								"listar"	=>	1 ,
								"editar"	=>	1 ,
								"requerido"	=>	1 ,
								"maxlenght" => 	100	,
							   "placehlder" => "ingresa un nombre para esta reparacion."			
					],												
					[ 				"campo"	=>	"descripcion" ,
									"tipo"	=>	tipoDato::T_TEXT  ,
									"alias"	=>	"Descripcion" 		,
								"listar"	=>	0 ,
								"editar"	=>	1 ,
								"requerido"	=>	0 ,
								"maxlenght" => 	200	,
							   "placehlder" => "ingresa una descripcion."			
					],
					[ 				"campo"	=>	"id_moneda"  ,
									"tipo"	=> tipoDato::T_SELECT ,
									"alias"	=>	"Moneda",			
								"listar"	=>	0 ,
								"editar"	=>	1 ,
								"requerido"	=>	1,
									"value"	=>	$select_moneda
					]
				]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Reparaciones");
	$crud->setEliminar(true);
	
$v->datos = $crud->render();

$v->render();


 ?>