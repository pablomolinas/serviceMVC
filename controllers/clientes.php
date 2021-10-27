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

	$select_clientes_estados = [ "tabla" => "clientes_estados",
									"id" => "id_estado",
						   "descripcion" => "nombre",
								   "sel" => 1	];

	$select_lista = [ 		     "tabla" => "listas",
									"id" => "id_lista",
						   "descripcion" => "nombre",
								   "sel" => 1	];

	$select_condicion_fiscal = [ "tabla" => "condicion_fiscal",
									"id" => "id_condicion_fiscal",
						   "descripcion" => "nombre",
								   "sel" => 1	];

	//Crud( nom_tabla, array(array( nom_campo, tipo_dato , alias , listar , editar , requerido, value, type, minlenght, maxlenght, placeholder , extraclass  )) )
	$crud = new Crud ( "clientes",
											[
												[ 			"campo" 	=> 	"id_cliente" ,
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
															"maxlenght"	=> 150	,
														"placeholder"	=> "ingresa un nombre"
												],
												[ 				"campo"	=> 	"apellido" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Apellido",
															   "listar" => 	1 ,
															   "editar" => 	1 ,
															"requerido" => 	0 ,
																"value"	=>	"",
															"minlenght"	=>	2 ,
															"maxlenght"	=> 100,
														"placeholder"	=> "ingresa un apellido"
												],
												[ 				"campo"	=> 	"domicilio" 		,
																"tipo" 	=>	tipoDato::T_TEXT ,
																"alias"	=>	"Domicilio",			   
															"listar"	=>	0 ,
															   "editar" => 	1 ,	
															"maxlenght"	=> 	150,
														"placeholder"	=> "ingresa un domicilio"
												],
												[ 				"campo"	=>	"id_localidad"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Localidad",					
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	0,
																"value"	=>	$select_localidades
												],
												[
																"campo"	=>	"dni",
																"tipo"	=>	tipoDato::T_INT,
																"alias"	=>	"Dni",
															"listar"	=>	0 ,
															   "editar" =>	1 ,
															"minlenght" =>	1 ,
															"maxlenght" =>  10 ,
													 	   "placehlder" => "ingresa un dni"
												],
				   								[ 				"campo"	=>	"tel",
																 "tipo" => 	tipoDato::T_TEL 	 ,
														 	  "alias"	=> 	"Telefono" 				,
															   "listar" => 0 ,
															   "editar" => 1 ,
															"requerido" => 0 ,
																"value" => "",
															"minlenght" => 7,
															"maxlenght" => 45	,
													 	   "placehlder" => "ingresa un telefono"
												],
				   								[ 			"campo"	=>	"tel2",
															 "tipo" => 	tipoDato::T_TEL ,
														 	"alias"	=> 	"Telefono 2" 	,		
														   "editar" => 	1 ,
														"listar"	=>	0 ,
														"requerido" => 	0 ,		
														"minlenght" => 	7 ,
														"maxlenght" => 	45	,
													   "placehlder" => "ingresa otro telefono"
												],
				   								[ 			"campo"	=>	"email",
															 "tipo" => 	tipoDato::T_EMAIL 	,
														 	"alias"	=> 	"E-mail" 			,
														   "listar" => 	0 ,
														   "editar" => 	1 ,
														"requerido" => 	0 ,	
														"minlenght" => 	1 ,
														"maxlenght" => 	150	,
													   "placehlder" => "ingresa un email"
												],
												[
																"campo"	=>	"cuit",
																"tipo"	=>	tipoDato::T_INT,
																"alias"	=>	"Cuit",
															   "editar" =>	1 ,
															"listar"	=>	0 ,
															"minlenght" =>	11 ,
															"maxlenght" =>  11 ,
													 	   "placehlder" => "ingresa un cuit"
												],
												[ 				"campo"	=>	"id_condicion_fiscal"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Condicion fiscal",					
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	1 ,
																"value"	=>	$select_condicion_fiscal
												],
												[ 				"campo"	=>	"id_lista"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Lista de precios",					
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	1 ,
																"value"	=>	$select_lista
												],
												[ 				"campo"	=>	"id_estado"  ,
																"tipo"	=> tipoDato::T_SELECT ,
																"alias"	=>	"Estado",					
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	1 ,
																"value"	=>	$select_clientes_estados
												],												
												[ 				"campo"	=>	"observacion" ,
																"tipo"	=>	tipoDato::T_TEXT  ,
																"alias"	=>	"Observacion" 		,
															"listar"	=>	0 ,
															"editar"	=>	1 ,
															"requerido"	=>	0 ,
															"maxlenght" => 	200	,
														   "placehlder" => "ingresa una observacion"			
												]
											]
					 ); //se pasan datos de tabla al constructor


	$crud->setTitulo("Listado de Clientes");
	$crud->setEliminar(true);
	
$v->datos = $crud->render();

$v->render();


 ?>