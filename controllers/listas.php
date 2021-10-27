<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "listas",
											[
												[ 		"campo" 	=> 	"id_lista" ,
															"tipo"		=> 	tipoDato::T_INT,
															"alias"		=> 	"ID" ,
															"listar" 	=>	1 ,
															"editar"	=>	0
												],
												[ 			"campo"	=> 	"nombre" 		,
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
												[ 			"campo"	=> 	"descripcion" 		,
															"tipo" 	=>	tipoDato::T_TEXT ,
															"alias"	=>	"Descripcion",
															 "listar" => 0 ,
															"editar" => 1 ,
														"requerido" => 0,
															"value"	=>	"" ,
														"maxlenght"	=> 200,
													"placeholder"	=> "ingresa una descripcion del campo"	
												],
				   								[ 			"campo"	=>	"margen",
																 "tipo" => 	tipoDato::T_NUMBER 	 ,
														 	  "alias"	=> 	"Margen por defecto" 				,
															 "listar" => 1 ,
															 "editar" => 1 ,
														"requerido" => 1,
															"value" => 0,
														"minlenght" => 1,
														"maxlenght" => 10	,
													 "placehlder" => "ingresa un margen para la lista"
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listas de precio");
	$crud->setEliminar(true);
	

$v->datos = $crud->render();

$v->render();


 ?>