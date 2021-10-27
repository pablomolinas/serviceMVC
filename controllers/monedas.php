<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "monedas",
											[
												[ 		"campo" 	=> 	"id_moneda" ,
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
																"value"	=>	"nombre_campo" ,
														"minlenght"	=>	2,
														"maxlenght"	=> 50	,
													"placeholder"	=> "ingresa un nombre"
												],
												[ 			"campo"	=> 	"descripcion" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Descripcion",
															 "listar" => 1 ,
															 "editar" => 1 ,
														"requerido" => 0,
																"value"	=>	"" ,
														"maxlenght"	=> 45,
													"placeholder"	=> "ingresa una descripcion del campo"
												],
				   								[ 			"campo"	=>	"cambio",
																 "tipo" => 	tipoDato::T_NUMBER 	 ,
														 	  "alias"	=> 	"Cambio" 				,
															 "listar" => 1 ,
															 "editar" => 1 ,
														"requerido" => 1,
																"value" => 1,
														"minlenght" => 1,
														"maxlenght" => 10	,
													 "placehlder" => "ingresa cambio"
												],												
												[ 			"campo"	=>	"Habilitada" ,
																"tipo"	=>	tipoDato::T_CHECK  ,
																"alias"	=>	"Habilitada" 		,
															"listar"	=>	0 ,
															"editar"	=>	1 ,
														"requerido"	=>	1,
																"value"	=>	1	
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Monedas del Sistema");
	$crud->setEliminar(true);
	

$v->datos = $crud->render();

$v->render();


 ?>