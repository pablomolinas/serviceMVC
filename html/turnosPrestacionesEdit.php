<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">				
				<div class="row">
					<div class="col-1">
							<a class="btn btn-success" href="turnosPrestaciones" title="Regresar"><i class="fa fa-long-arrow-alt-left"></i></a>
					</div>								
					<div class="col-8">
							<h3>Edicion de Turno #<?=$this->datos["id_turno"]; ?></h3>
					</div>			
				</div>	
			</div>
			<div class="card-body">
				<?php echo $this->info; ?>
				<form action="" method="POST" name="form_edit" id="form_edit">                         
		                    
		                    <div class="form-group">
		                        <label for="id_turno" >ID</label>
		                        <input id="id_turno" name="id_turno" type="number" class="form-control"  value="<?php echo $this->datos["id_turno"] ?>" readonly="readonly" >
		                    </div>
		                    <div class="form-group">
		                        <label for="fecha" >Fecha (*)</label>
		                        <input id="fecha" name="fecha" type="date" class="form-control " placeholder="Selecciona una fecha" value="<?php echo $this->datos["fecha_mostrar"] ?>"  required <?php if($this->datos["id_estado_turno"] == TURNO_EN_PROGRESO ||
		                    			  $this->datos["id_estado_turno"] == TURNO_CUMPLIDO) echo 'readonly="readonly"' ?>  
		                        >
		                        <input id="fecha_actual" name="fecha_actual" type="hidden" value="<?php echo $this->datos["fecha"] ?>" >
		                    </div>
		                    <div class="form-group">
		                        <label for="id_horario" >Horarios disponibles (*)</label>
		                        <?php echo $this->sel_horarios; ?>
		                    </div>
		                    <div class="form-row">
							    <div class="col-md-6 mb-3">
							      <label for="id_cliente">Cliente (*)</label>
							      <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $this->datos["id_cliente"] ?>" />
		                          <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" value="<?php echo $this->datos["apellido_cliente"].", ".$this->datos["nombre_cliente"] ?>"  readonly="readonly" />							      
							    </div>
							    <div class="col-md-4 mb-3">
							      <label for="id_mascota" >Mascota</label>
							      <?php echo $this->sel_mascotas; ?>
							    </div>	
							    <div class="col-md-2 mb-3">
							      <label for="btn-agregar-mascota" >Agregar</label>
							      <a class="btn btn-success form-control" id="btn-agregar-mascota" href="crearMascota-<?php echo $this->datos["id_cliente"] ?>" title="Registrar nueva Mascota" target ="_blank" ><li class="fa fa-plus"></li></a>
							    </div>						    
							</div>		                    
		                    <div class="form-group">
		                        <label for="id_prestacion_medica" >Prestacion Medica (*)</label>
		                        <?php echo $this->sel_prestaciones; ?>
		                    </div>	
		                    <div class="form-group">
		                        <label for="id_veterinario" >Veterinario (*)</label>
		                        <?php echo $this->sel_veterinarios; ?>
		                        <input id="id_veterinario_actual" name="id_veterinario_actual" type="hidden" value="<?php echo $this->datos["id_veterinario"]; ?>" >
		                    </div>		                    
		                    <div class="form-group">
		                        <label for="id_factura_cliente" >Factura asociada</label>
		                        <?php echo $this->sel_facturas; ?>	                        
		                    </div>
		                    <div class="form-group">
		                        <label for="precio_venta">Precio</label>		                        
		                        <input type="number" class="form-control" name="precio_venta" id="precio_venta" value="<?php echo $this->datos["precio_venta"] ?>" readonly="readonly" />
		                    </div>
		                    <div class="form-group">
		                        <label for="id_estado_turno" >Estado de Turno (*)</label>
		                        <?php echo $this->sel_estado_turnos; ?>
		                    </div>							
							
							<div class="form-group">
							    <label for="diagnostico">Diagnostico</label>
							    <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3" 
							    <?php echo ($this->datos["id_estado_turno"] == TURNO_CUMPLIDO ||
							    			$_SESSION["id_tipo_usuario"] == USER_ADMIN )? ' readonly="readonly" ' : ""; ?>  
							    ><?php echo $this->datos["diagnostico"] ?></textarea>
							</div>
							
							<input type="submit" class="btn btn-primary" value="Guardar" 
							 <?php if($this->datos["id_estado_turno"] == TURNO_CUMPLIDO ||
									  $this->datos["id_estado_turno"] == TURNO_CANCELADO ) echo 'disabled'; ?> >
		     	</form>
			</div>
		</div>
	</div><!-- END COL-6 -->

<?php if($this->datos["id_estado_turno"] == TURNO_EN_PROGRESO ||
		 $this->datos["id_estado_turno"] == TURNO_CUMPLIDO){ 

	$readonly = ($this->datos["id_estado_turno"] == TURNO_CUMPLIDO || 
				 $_SESSION["id_tipo_usuario"] == USER_ADMIN AND 
				 $this->datos["id_estado_turno"] == TURNO_EN_PROGRESO )? ' disabled="disabled" ' : "";
	?>
<div class="col-6">
	<div class="col-12"><!-- ROW Productos medicos utilizados -->	
		<div class="card">
			<div class="card-header">
				<h4>Productos medicos utilizados en la consulta</h4>
				<form method="post">
					<div class="input-group">		                        
		                        <?php echo $this->sel_productos_m; ?>
		                        <div class="input-group-append">
		                        	<button type="button" class="btn btn-outline-primary" name="btn-add-utilizado" id="btn-add-utilizado" title="Agregar producto utilizado" <?php echo $readonly; ?> ><i class="fa fa-plus"></i></button>
		                        </div>
		            </div>	
				</form>
			</div>
			<div class="card-body">
				<table class="table table-sm table-hover table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>#</th>							
							<th>Producto</th>												
							<th>Accion</th>
						</tr>	
					</thead>					
					<tbody>
					<?php 	

					if( $this->datos_productos_utilizados ){
						$filas ="";			
						foreach ($this->datos_productos_utilizados as $value) {
							$filas .= "<tr>";				
							$filas .= "<td>".$value["id_producto"]."</td>";
							$filas .= "<td>".$value["nombre"]."</td>";			

							//BOTONES DE ACCION
							$filas .= '<td>										
										<button class="btn btn-danger btn-del-utilizado" id_producto="'.$value["id_producto"].'" id="btn-del-utilizado'.$value["id_turno"].'" title="Eliminar producto utilizado" '.$readonly.'><i class="fa fa-times"></i></button>								
									   </td>';
							$filas .="</tr>";					
						} 
						echo $filas;
					}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
					?>
					</tbody>
				</table>
			</div>
		</div>		
	</div><!-- END ROW Productos medicos utilizados -->
	<div class="col-12"><!-- ROW prestaciones medicos indicadas -->	
		<div class="card">
			<div class="card-header">
				<h4>Prestaciones medicas indicadas</h4>
				<form method="post">
					<div class="input-group">		                        
		                        <?php echo $this->sel_indica_prestaciones; ?>
		                        <div class="input-group-append">
		                        	<button type="button" class="btn btn-outline-primary" name="btn-add-prest-indicada" id="btn-add-prest-indicada" title="Agregar prestacion indicada" <?php echo $readonly; ?> ><i class="fa fa-plus"></i></button>
		                        </div>
		            </div>	
				</form>
			</div>
			<div class="card-body">
				<table class="table table-sm table-hover table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>#</th>							
							<th>Prestaciones</th>												
							<th>Accion</th>
						</tr>	
					</thead>					
					<tbody>
					<?php 	

					if( $this->datos_turnos_indica_prestaciones ){
						$filas ="";			
						foreach ($this->datos_turnos_indica_prestaciones as $value) {
							$filas .= "<tr>";				
							$filas .= "<td>".$value["id_prestacion_medica"]."</td>";
							$filas .= "<td>".$value["nombre"]."</td>";			

							//BOTONES DE ACCION
							$filas .= '<td>										
										<button class="btn btn-danger btn-del-prest-indicada" id_prestacion_medica_indicada="'.$value["id_prestacion_medica"].'" id="btn-del-prest-indicada'.$value["id_prestacion_medica"].'" title="Eliminar prestacion indicada" '.$readonly.'><i class="fa fa-times"></i></button>								
									   </td>';
							$filas .="</tr>";					
						} 
						echo $filas;
					}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
					?>
					</tbody>
				</table>
			</div>
		</div>		
	</div><!-- END ROW Prestaciones indicadas -->
	<div class="col-12"><!-- ROW Productos medicos indicados -->	
		<div class="card">
			<div class="card-header">
				<h4>Productos medicos indicados</h4>
				<form method="post">
					<div class="input-group">		                        
		                        <?php echo $this->sel_indica_productos; ?>
		                        <div class="input-group-append">
		                        	<button type="button" class="btn btn-outline-primary" name="btn-add-indicado" id="btn-add-indicado" title="Agregar producto indicado" <?php echo $readonly; ?> ><i class="fa fa-plus"></i></button>
		                        </div>
		            </div>	
				</form>
			</div>
			<div class="card-body">
				<table class="table table-sm table-hover table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>#</th>							
							<th>Producto</th>												
							<th>Accion</th>
						</tr>	
					</thead>					
					<tbody>
					<?php 	

					if( $this->datos_turnos_indica_productos ){
						$filas ="";			
						foreach ($this->datos_turnos_indica_productos as $value) {
							$filas .= "<tr>";				
							$filas .= "<td>".$value["id_producto"]."</td>";
							$filas .= "<td>".$value["nombre"]."</td>";			

							//BOTONES DE ACCION
							$filas .= '<td>										
										<button class="btn btn-danger btn-del-indicado" id_producto_indicado="'.$value["id_producto"].'" id="btn-del-indicado'.$value["id_turno"].'" title="Eliminar producto indicado" '.$readonly.'><i class="fa fa-times"></i></button>								
									   </td>';
							$filas .="</tr>";					
						} 
						echo $filas;
					}else echo '<tr><td colspan="3">Sin resultados</td></tr>';
					?>
					</tbody>
				</table>
			</div>
		</div>		
	</div><!-- END ROW Productos medicos indicados -->
</div><!-- END COL-6: columna 2 -->
<?php } //end if (id_estado_turno=cumplido) ?>
</div><!-- END ROW -->
<script type="text/javascript">
	

	$(document).ready(function(){
		 
		 if( $("#id_estado_turno").val() == <?php echo TURNO_CANCELADO ?>){
		 		$(".form-control").prop("disabled", true);
		 }

		 $("body").on("submit" , "#form_edit" , function(){		 		
		 		$("select").removeAttr("disabled"); //sino no envia los deshabilitados
		 		return true;
		 });

		 $("body").on( "change" , "#fecha, #id_veterinario" , function(){
		 	if( $("#fecha").val() !="" && $("#id_veterinario").val() !="" )	
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&nueva_fecha="+$("#fecha").val()+"&nuevo_vet="+$("#id_veterinario").val();            						
		 });  

		 $("body").on( "click" , "#btn-add-utilizado" , function(){
		 	if( $("#id_producto").val() !="" )			 		
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&add-utilizo="+$("#id_producto").val();            						
		 });
		 $("body").on( "click" , ".btn-del-utilizado" , function(){	 		
		 	if( confirm("Quieres eliminar el producto utilizado?" ) )
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&del-utilizo="+$(this).attr("id_producto");            						
		 });

		 $("body").on( "click" , "#btn-add-indicado" , function(){
		 	if( $("#id_producto_indicado").val() !="" )			 		
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&add-indica="+$("#id_producto_indicado").val();            						
		 });
		 $("body").on( "click" , ".btn-del-indicado" , function(){	 		
		 	if( confirm("Quieres eliminar el producto utilizado?" ) )
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&del-indica="+$(this).attr("id_producto_indicado");            						
		 });

		 $("body").on( "click" , "#btn-add-prest-indicada" , function(){
		 	if( $("#id_prestacion_medica_indicada").val() !="" )			 		
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&add-prest-indica="+$("#id_prestacion_medica_indicada").val();            						
		 });
		 $("body").on( "click" , ".btn-del-prest-indicada" , function(){	 		
		 	if( confirm("Quieres eliminar el prestacion medica indicada?" ) )
		 		window.location.href = "turnosPrestacionesEdit?id="+$("#id_turno").val()+"&del-prest-indica="+$(this).attr("id_prestacion_medica_indicada");            						
		 });
	});

</script>
