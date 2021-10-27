<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "marcas",
											[
												[ 		"campo" 	=> 	"id_marca" ,
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
														"placeholder"	=> "ingresa un nombre nompre para la marca"
												],
												[ 				"campo"	=> 	"descripcion" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Descripcion",
																"listar" => 0 ,
															 	"editar" => 1 ,
															"requerido" => 0,
																"value"	=>	"" ,
															"minlenght"	=>	2,
															"maxlenght"	=> 150	,
														"placeholder"	=> "ingresa una descripcion para la marca"
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Marcas (Fabricantes)");
	


$v->datos = $crud->render();

$v->render();

 ?>