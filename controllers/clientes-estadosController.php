<?php 

require_once( 'application/view.php');

require_once( PATH_FW.'CRUD/config.php' );


	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "clientes_estados",
											[
												[ 		"campo" 	=> 	"id_estado" ,
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
															"maxlenght"	=>  80,
														"placeholder"	=> "ingresa un estado"
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Estados de clientes");
	



$vista = new view();

$vista->render_header();
echo $crud->render();
$vista->render_footer();

 ?>