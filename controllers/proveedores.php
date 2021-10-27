<?php 

require_once '../fw/fw.php';
require_once( '../fw/CRUD/config.php' );
require_once( '../views/crudView.php' );

	$v = new crudView();

										//$tabla, $id, $desc, $sel="", $desc2="", $where = "", $cssClass=" input-medium required", $toolTip = "Debes seleccionar un elemento." )
	$select_localidades = [ 	 "tabla" => "localidades",
								"id" => "id_localidad",
					   "descripcion" => "nombre",
							   "sel" => 0	];

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "proveedores",
											[
												[ 		"campo" 	=> 	"id_proveedor" ,
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
												[ 			"campo"	=> 	"domicilio" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Domicilio",
															 "listar" => 0 ,
															 "editar" => 1 ,
														"requerido" => 0,
																"value"	=>	"" ,
														"maxlenght"	=> 150,
													"placeholder"	=> "ingresa un domicilio"
												],
												[ 			"campo"	=>	"id_localidad"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Localidad",
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	0,
																"value"	=>	$select_localidades
												],
				   								[ 			"campo"	=>	"tel",
																 "tipo" => 	tipoDato::T_TEL 	 ,
														 	  "alias"	=> 	"Telefono" 				,
															 "listar" => 0 ,
															 "editar" => 1 ,
														"requerido" => 1,
																"value" => "",
														"minlenght" => 7,
														"maxlenght" => 45	,
													 "placehlder" => "ingresa un telefono"
												],
				   								[ 			"campo"	=>	"tel2",
																 "tipo" => 	tipoDato::T_TEL ,
														 	  "alias"	=> 	"Telefono 2" 	,
															 "listar" => 0 ,
															 "editar" => 1 ,
														"requerido" => 0,
																"value" => "",
														"minlenght" => 7,
														"maxlenght" => 45	,
													 "placehlder" => "ingresa otro telefono"
												],
				   								[ 			"campo"	=>	"email",
																 "tipo" => 	tipoDato::T_EMAIL 	,
														 	  "alias"	=> 	"E-mail" 			,
															 "listar" => 0 ,
															 "editar" => 1 ,
														"requerido" => 1,	
														"minlenght" => 1,
														"maxlenght" => 150	,
													 "placehlder" => "ingresa un telefono"
												],												
												[ 				"campo"	=>	"observacion" ,
																"tipo"	=>	tipoDato::T_TEXT  ,
																"alias"	=>	"Observacion" 		,
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	0,
															"maxlenght" => 400	,
														   "placehlder" => "ingresa una observacion"			
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Proveedores");
	$crud->setEliminar(true);
	

$v->datos = $crud->render();

$v->render();

 ?>