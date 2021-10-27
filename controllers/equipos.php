<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

										//$tabla, $id, $desc, $sel="", $desc2="", $where = "", $cssClass=" input-medium required", $toolTip = "Debes seleccionar un elemento." )
	$select_clientes = [ 	 "tabla" => "clientes",
									"id" => "id_cliente",
						   "descripcion" => "nombre",
								   "sel" => 0	];

	$select_modelos = [ "tabla" => "modelos",
									"id" => "id_modelo",
						   "descripcion" => "nombre",
								   "sel" => 0	];
	

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "equipos",
				[
					[ 			"campo" 	=> 	"id_equipo" ,
								"tipo"		=> 	tipoDato::T_INT,
								"alias"		=> 	"ID" ,
								"listar" 	=>	1 ,
								"editar"	=>	0
					],
					[ 				"campo"	=>	"id_cliente"  ,
									"tipo"	=> tipoDato::T_SELECT ,
									"alias"	=>	"Cliente",			
								"listar"	=>	1 ,
								"editar"	=>	1 ,
								"requerido"	=>	1,
									"value"	=>	$select_clientes
					],
					[ 				"campo"	=>	"id_modelo"  ,
									"tipo"	=> tipoDato::T_SELECT ,
									"alias"	=>	"Modelo",					
								"listar"	=>	1 ,
								"editar"	=>	1 ,
								"requerido"	=>	1 ,
									"value"	=>	$select_modelos
					],												
					[ 				"campo"	=>	"serie" ,
									"tipo"	=>	tipoDato::T_TEXT  ,
									"alias"	=>	"Serie" 		,
								"listar"	=>	1 ,
								"editar"	=>	1 ,
								"requerido"	=>	0 ,
								"maxlenght" => 	50	,
							   "placehlder" => "ingresa un numero de serie."			
					],												
					[ 				"campo"	=>	"observacion" ,
									"tipo"	=>	tipoDato::T_TEXT  ,
									"alias"	=>	"Observacion" 		,
								"listar"	=>	0 ,
								"editar"	=>	1 ,
								"requerido"	=>	0 ,
								"maxlenght" => 	400	,
							   "placehlder" => "ingresa una observacion"			
					],												
					[ 				"campo"	=>	"fecha_alta",
									"tipo"	=>	tipoDato::T_HIDDEN ,
									"alias"	=>	"fecha_alta",
								"listar"	=>	0 ,
								"editar"	=>	0 ,
								"requerido"	=>	0 , 
									"value"	=>	"NOW()"
					]
				]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Equipos");
	$crud->setEliminar(true);
	
$v->datos = $crud->render();

$v->render();


 ?>