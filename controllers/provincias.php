<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "provincias",
											[
												[ 		"campo" 	=> 	"id_provincia" ,
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
															"requerido" =>  1,
																"value"	=>	"" ,
															"minlenght"	=>	2,
															"maxlenght"	=>  50,
														"placeholder"	=> "ingresa una provincia"
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Provincias");
	

$v->datos = $crud->render();

$v->render();


 ?>