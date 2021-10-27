<div class="container mt-3">
	<div class="row">
		<div class="col-2">
				<a class="btn btn-success" href="ordenes.php" title="Regresar"><i class="fa fa-long-arrow-alt-left"></i></a>
		</div>
		<div class="col-8">
				<h3>Edicion de Orden de reparacion #<?=$this->datos["id_orden"]; ?></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-8"><!-- col contenido tabs -->
			<ul class="nav nav-tabs" id="ordenes-tabs">
			  <li class="nav-item" ><!-- NAV PRINCIPAL -->
			    <a class="nav-link active"  id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal-tab" aria-selected="true">Principal</a>
			  </li><!-- END NAV PRINCIPAL -->
			  <li class="nav-item"><!-- NAV REPARACIONES -->
			    <a class="nav-link"  id="reparaciones-tab" data-toggle="tab" href="#reparaciones" role="tab" aria-controls="reparaciones" aria-selected="true">Reparaciones</a>
			  </li><!-- END NAV REPARACIONES -->
			  <li class="nav-item"><!-- NAV EVENTOS -->
			    <a class="nav-link"  id="eventos-tab" data-toggle="tab" href="#eventos" role="tab" aria-controls="eventos" aria-selected="true">Eventos</a>
			  </li>	  <!-- END NAV EVENTOS -->
			  <li class="nav-item"><!-- NAV pagos -->
			    <a class="nav-link"  id="pagos-tab" data-toggle="tab" href="#pagos" role="tab" aria-controls="pagos" aria-selected="true">Pagos asociados</a>
			  </li>	  <!-- END NAV pagos -->
			</ul>

			<form action="" method="POST" name="form_edit" id="form_edit">
			<div class="tab-content">
			  <div class="tab-pane container fade active" id="principal" role="tabpanel" aria-labelledby="principal"><!-- tab PRINCIPAL -->
			  			  	
				<?php echo $this->info; ?>
				    
				<div class="container-fluid">
					<div class="row">
							<div class="col-6">
			                        <input id="id_orden" name="id_orden" type="hidden" class="form-control"  value="<?php echo $this->datos["id_orden"] ?>" readonly="readonly" >	                    
			                    <div class="form-group">
			                        <label for="fecha_ingreso" >Fecha (*)</label>
			                        <input id="fecha_ingreso" name="fecha_ingreso" type="date" class="form-control " placeholder="Selecciona una fecha" value="<?php echo $this->datos["fecha_ingreso"] ?>"  required />		                        
			                    </div>		                    
			                    <div class="form-row">
								    <div class="col-md-6 mb-3">
								      <label for="id_cliente">Cliente (*)</label>
								      <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $this->datos["id_cliente"] ?>" />
			                          <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $this->datos["nombre"] ?>"  readonly="readonly" />						      
								    </div>	    						    
								</div>                     
							</div>
							<div class="col-6"><!--col2-->
								<div class="form-row">
								    <div class="col-md-6">
								      <label for="modelo">Equipo</label>
								      <input type="text" class="form-control" name="modelo" id="modelo" value="<?php echo $this->datos["modelo"] ?>" readonly="readonly" />
								    </div>	    			
								    <div class="col-md-6">
								    	<label for="serie">Serie</label>
								      	<input type="text" class="form-control" name="serie" id="serie" value="<?php echo $this->datos["serie"] ?>" readonly="readonly" />
								    </div>			    
								</div>						
								<div class="row">
									<div class="form-group">
				                        <label for="id_orden_proforma" >Proforma asociada</label>
				                        <?php echo $this->sel_proformas; ?>	
			                    	</div>
								</div>
							</div><!-- end col2 -->					
					</div><!-- end row1 -->
					<div class="row"><!-- row2 -->
						<div class="col-12">
							<div class="form-group">
							    <label for="falla_declarada">Falla declarada</label>
							    <textarea class="form-control" id="falla_declarada" name="falla_declarada" rows="2" 					     
							    ><?php echo $this->datos["falla_declarada"] ?></textarea>
							</div>	
							<div class="form-group">
							    <label for="observacion">Observacion</label>
							    <textarea class="form-control" id="observacion" name="observacion" rows="2" 					     
							    ><?php echo $this->datos["observacion"] ?></textarea>
							</div>
							<div class="form-group">
							    <label for="diagnostico">Observacion privada</label>
							    <textarea class="form-control" id="observacion_privada" name="observacion_privada" rows="2" 					     
							    ><?php echo $this->datos["observacion_privada"] ?></textarea>
							</div>									
						</div><!-- end col -->
						<div class="col"><!-- col2 -->
							
						</div><!-- end col2 -->
					</div><!-- end row2 -->						
					<div class="row"><input type="button" id="btnGuardar" class="btn btn-primary" value="Guardar" /></div>	     	
					
				</div><!-- end container -->	

			  </div><!-- end tab PRINCIPAL -->
			  
			  <div class="tab-pane container fade" id="reparaciones" role="tabpanel" aria-labelledby="reparaciones"><!-- tab REPARACIONES -->	  		
				<div class="container">					
					<div class="row">
					    <div class="col-md-4">
					      <label for="pdescuento">Descuento (*)</label>
		                  <input type="text" class="form-control" name="pdescuento" id="pdescuento" value="<?php echo $this->datos["pdescuento"] ?>" />	
					    </div>

					    <div class="col-md-4">
					      <label for="costo">Costo Total (*)</label>
		                  <input type="text" class="form-control" name="costo" id="costo" value="<?php echo $this->datos["costo"] ?>" />	
					    </div>
					
					    <div class="col-md-4">
					      <label for="importe">Importe Total (*)</label>
		                  <input type="text" class="form-control" name="importe" id="importe" value="<?php echo $this->datos["importe"] ?>" />	
					    </div>	    						    
					</div> 			
					<div class="row">	
								<div class="col-md-12"><h4>Reparaciones realizadas</h4></div>
								<div class="col-md-5">									
									<div class="form-group">
										Reparacion:
										<div class="buscador">
											<input type="text" class="form-control" name="nueva_reparacion" id="nueva_reparacion" placeholder="ingresa una descripcion">	
											<div id="resultados"></div>		
										</div>
										<input type="text" name="id_rep" id="id_rep" value="" >						
									</div>
									<div class="form-group">
										Precio: <input type="number" name="precio_reparacion" class="form-control" id="precio_reparacion" value="0.00">
									</div>
								</div>
								<div class="col-md-6">									
									<div class="form-group">
										<label for="obs_evento">Observacion</label>
										<textarea id="obs_evento" class="form-control" name="obs_evento"></textarea>
									</div>					
								</div>	
								<div class="col-md-1">
										<button id="btn-rep-add" class="btn btn-success">+ 	</button>
								</div>						
					</div>
					<div class="row"><!-- tablas reparaciones -->
						<div class="col-6">					
					    	<div class="row"> <!-- reparaciones tabla -->			
								<table class="table table-sm table-hover table-bordered">
									<thead class="thead-dark">
										<tr>
											<th>#</th>							
											<th>Reparacion</th>
											<th>Precio</th>
											<th>Fecha finalizada</th>		
											<th>Observacion</th>		
											<th>Accion</th>
										</tr>	
									</thead>					
									<tbody>
									<?php 	

									if( $this->reparaciones ){
										$filas ="";			
										foreach ($this->reparaciones as $value) {
											
											$filas .= "<tr>";				
											$filas .= "<td>".$value["id_reparacion"]."</td>";
											$filas .= "<td>".$value["nombre_reparacion"]."</td>";	
											$filas .= "<td>".$value["precio"]."</td>";	
											$filas .= "<td>".$value["fecha_finalizada"]."</td>";	
											$filas .= "<td>".$value["observacion"]."</td>";	

											//BOTONES DE ACCION
											$filas .= '<td>										
														<button class="btn btn-danger btn-del-indicado" id_reparacion="'.$value["id_reparacion"].'" id="btn-del-rep'.$value["id_reparacion"].'" title="Eliminar reparacion realizada" ><i class="fa fa-times"></i></button>								
													   </td>';
											$filas .="</tr>";					
										} 
										echo $filas;
									}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
									?>
									</tbody>
								</table>
						 	</div>	
						</div><!-- col1 reparaciones -->
						<div class="col-6">					
							<div class="row"><!-- row tabla -->	
								<h4>Repuestos utilizados</h4>					
								<table class="table table-sm table-hover table-bordered">
									<thead class="thead-dark">
										<tr>
											<th>#</th>							
											<th>Repuesto</th>
											<th>Costo</th>
											<th>Serie</th>		
											<th>Accion</th>
										</tr>	
									</thead>					
									<tbody>
									<?php 	

									if( $this->repuestos ){
										$filas ="";			
										foreach ($this->repuestos as $value) {
											
											$filas .= "<tr>";				
											$filas .= "<td>".$value["id_orden_detalle_repuesto"]."</td>";
											$filas .= "<td>".$value["nombre_repuesto"]."</td>";	
											$filas .= "<td>".$value["costo"]."</td>";			
											$filas .= "<td>".$value["serie"]."</td>";	

											//BOTONES DE ACCION
											$filas .= '<td>										
														<button class="btn btn-danger btn-del-indicado" id_detalle="'.$value["id_orden_detalle_repuesto"].'" id="btn-del-evento'.$value["id_orden_detalle_repuesto"].'" id_estado="'.$value["id_orden"].'" title="Eliminar repuesto utilizado" ><i class="fa fa-times"></i></button>								
													   </td>';
											$filas .="</tr>";					
										} 
										echo $filas;
									}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
									?>
									</tbody>
								</table>		
							</div>
						</div><!-- col2 reparaciones -->
					</div><!-- end row tablas reparaciones -->
					
				</div><!-- end container -->

			  </div><!-- end tab REPARACIONES -->
			  
			  <div class="tab-pane container fade" id="eventos" role="tabpanel" aria-labelledby="eventos"><!-- end tab EVENTOS -->
			  		<div class="container" ><!-- Eventos -->	
						
						<h4>Nuevo Evento</h4>
						
						<div class="col-md-4">
							<label for="id_evento">Estados</label>
							<?php echo $this->sel_eventos; ?>				
						</div>
						<div class="col-md-4">
							<label for="obs_evento">Observacion</label>
							<textarea id="obs_evento" class="form-control" name="obs_evento"></textarea>
						</div>
						<div class="col-md-4">
							<button id="btn-evento-add" class="btn btn-success btn-sm">+ 	</button>
						</div>									
							
					</div><!-- end container -->

			  </div><!-- end tab EVENTOS --> 
			  <div class="tab-pane container fade" id="pagos" role="tabpanel" aria-labelledby="pagos"><!-- tab pagos -->
			  		<div class="container" ><!-- Eventos -->	
						
						<h4>Pagos Asociados</h4>				
						
						<table class="table table-sm table-hover table-bordered">
							<thead class="thead-dark">
								<tr>
									<th>#</th>							
									<th>Forma de Pago</th>
									<th>Fecha</th>
									<th>Importe</th>		
									<th>Accion</th>
								</tr>	
							</thead>					
							<tbody>
							<?php 	

							if( $this->pagos ){
								$filas ="";			
								foreach ($this->pagos as $value) {
									
									$filas .= "<tr>";				
									$filas .= "<td>".$value["id_pago_cliente"]."</td>";
									$filas .= "<td>".$value["nombre_forma_pago"]."</td>";	
									$filas .= "<td>".$value["fecha"]."</td>";			
									$filas .= "<td>".$value["importe"]."</td>";	

									//BOTONES DE ACCION
									$filas .= '<td>										
												<button class="btn btn-danger btn-del-indicado" id_pago="'.$value["id_pago_cliente"].'" id="btn-del-pago'.$value["id_pago_cliente"].'"  title="Eliminar pago de cliente" ><i class="fa fa-times"></i></button>								
											   </td>';
									$filas .="</tr>";					
								} 
								echo $filas;
							}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
							?>
							</tbody>
						</table>					
							
					</div><!-- end container -->
			  </div><!-- end tab pagos -->
			</div><!-- end tab-content -->

		</div><!-- col contenido tabs -->
		<div class="col-4"><!-- col principal lateral -->
			<h4>Eventos Registrados</h4>
			<table class="table table-sm table-hover table-striped table-bordered">
				<thead >
					<tr>													
						<th>Estado</th>								
						<th>Accion</th>
					</tr>	
				</thead>					
				<tbody>
				<?php 	

				if( $this->eventos ){
					$filas ="";			
					foreach ($this->eventos as $value) {						
											
						$filas .= "<tr>
									 <td><strong>Estado:</strong> (#".$value["id_orden_estado"].') '.$value["nombre"];
						$filas .= "<p><strong>Fecha:</strong>".$value["fecha"].'</p>';
						$filas .= "<p><strong>Observacion:</strong>".$value["observacion"].'</p>';
						//BOTONES DE ACCION
						$filas .= '<td>										
									<button class="btn btn-danger btn-del-indicado" id_orden="'.$value["id_orden"].'" id="btn-del-evento'.$value["id_orden"].'" id_estado="'.$value["id_orden"].'" title="Eliminar producto indicado" ><i class="fa fa-times"></i></button>								
								   </td>
								  </tr>';		
							
																	
					} 
					echo $filas;
				}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
				?>
				</tbody>
			</table>	
		</div><!-- end col principal lateral -->
	</div><!-- end row principal -->
	<input type="hidden" id="accion" name="accion" />
	</form><!-- end form_edit -->	

</div><!-- END principal container -->
<script type="text/javascript">
	
	
	
	$(document).ready(function(){
			
		 $(function () {
		    $('#ordenes-tabs li:last-child a').tab('show')
		  });		 		 

		 //if( $("#id_estado").val() == 1 ){
		 //		$(".form-control").prop("disabled", true);
		 //}

		 $("body").on("submit" , "#form_edit" , function(){		 		
		 		$("select").removeAttr("disabled"); //sino no envia los deshabilitados
		 		return true;
		 });

		 $("body").on("click" , "#btn-evento-add" , function(){		 	
		 		$("#accion").val("evento-add");		 		
		 		$("#form_edit").submit();
		 });
		 
		 $("body").on("click" , "#btnGuardar" , function(){		 	
		 		$("#accion").val("guardar");		 		
		 		$("#form_edit").submit();
		 });	 
		
	
		 $("body").on("keyup", "#nueva_reparacion", function(e){
			
			var tecla = e.which;
			if(tecla == 27){ //ESC
				$(this).val("");
				limpiar_rep();				
				return;
			}
			var request = $.ajax({
			  	url: "../ajax/busquedaReparaciones.php",
			    method: "POST",
  				data: { busqueda : $("#nueva_reparacion").val() }
			}).done(function( datos ) {
			  limpiar_rep();
			  $("#resultados").html(datos).show();
			}).fail(function( jqXHR, textStatus ) {
			  	alert( "Request failed: " + textStatus );
			});					

		});

		$("body").on("focusout", "#nueva_reparacion", function(e){ 
			
			if(e.relatedTarget == null || 
				e.relatedTarget.classList.contains("item-result") == false)
					limpiar_rep(); 
			
		});
		$("body").on("focusin", "#nueva_reparacion", function(){ 		
					$("#resultados").show(); 
			
		});

		$("body").on("click", ".item-result", function(){
				$("#nueva_reparacion").val($(this).children("span").text());
				$("#id_rep").val($(this).attr("id"));	
				$("#precio_reparacion").val($(this).attr("precio"));			
				$("#resultados").html("");								
		});

		var limpiar_rep = function(){
			$("#id_rep").val("");	
			$("#precio_reparacion").val("0");	
			$("#resultados").hide();	
		}


	});

</script>
