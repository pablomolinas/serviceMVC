<div class="row justify-content-center">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				
				<div class="row">
					<div class="col-1">
							<a class="btn btn-success" href="turnosPrestaciones" title="Regresar"><i class="fa fa-long-arrow-alt-left"></i></a>
					</div>								
					<div class="col-8">
							<h3>Nuevo Turno </h3>				
							<p>Debes seleccionar una fecha y un veterinario para conocer los horarios de turno disponibles.</p>
					</div>			
				</div>
			</div>
			<div class="card-body">
				<?php echo $this->info; ?>
				<form action="" method="POST" name="form_edit" id="form_add">                                   
		                    <div class="form-group">
		                        <label for="fecha" >Fecha (*)</label>
		                        <input id="fecha" name="fecha" type="date" class="form-control " placeholder="Selecciona una fecha" value="<?php echo $this->datos["fecha"] ?>"  required min="<?php echo date("Y-m-d"); ?>" max="<?php echo date( "Y-m-d", strtotime( date("Y-m-d")." +3 month" ) );  ?>" >
		                        <input id="fecha_actual" name="fecha_actual" type="hidden" value="" >
		                    </div>
		                    <div class="form-group">
		                        <label for="id_veterinario" >Veterinario (*)</label>
		                        <?php echo $this->sel_veterinarios; ?>		                        
		                    </div>	
		                    <div class="form-group">
		                        <label for="id_horario" >Horarios disponibles (*)</label>
		                        <?php echo $this->sel_horarios; ?>
		                    </div>
		                    <div class="form-row">
							    <div class="col-md-6 mb-3">
							      <label for="id_cliente">Cliente (*)</label>
							      <?php echo $this->sel_clientes; ?>		                          
							    </div>
							    <div class="col-md-4 mb-3">
							      <label for="id_mascota" >Mascota</label>
							      <?php echo $this->sel_mascotas; ?>
							    </div>	
							    <?php if($this->sel_mascotas!=""){ ?>
							    <div class="col-md-2 mb-3">
							      <label for="btn-agregar-mascota" >Agregar</label>
							      <a class="btn btn-success form-control" id="btn-agregar-mascota" href="crearMascota-<?php echo $this->datos["id_cliente"] ?>" title="Nueva Mascota" target ="_blank" ><li class="fa fa-plus"></li></a>
							    </div>						    
							<?php } ?>
							</div>		                    
		                    <div class="form-group">
		                        <label for="id_prestacion_medica" >Prestacion Medica (*)</label>
		                        <?php echo $this->sel_prestaciones; ?>
		                    </div>			                    										
							
							<input type="submit" class="btn btn-primary" value="Guardar">
		     	</form>
			</div>
		</div>
	</div><!-- END COL-6 -->
</div><!-- END ROW -->
<script type="text/javascript">
	

	$(document).ready(function(){
		 $("body").on( "change" , "#fecha, #id_veterinario, #id_cliente" , function(){
		 	var param="";
		 	var actualizar = false;
		 	if( $("#fecha").val() !="" && $("#id_veterinario").val() !="" )	{
		 		param = "fecha="+$("#fecha").val()+"&vet="+$("#id_veterinario").val();
		 		
		 		if( $("#id_horario").val() != null && $("#id_horario").val() != "" )
		 				param = param+"&hora="+$("#id_horario").val();		 			 			
		 		
		 		actualizar = true;
		 	}
		 	
		 	if( $("#id_cliente").val() != "" && $(this).attr("id") == "id_cliente" || actualizar && $("#id_cliente").val() != "" ){
		 		if(param!="")param = param+"&"; 
		 		param = param+"cli="+$("#id_cliente").val();

		 		if( $("#id_mascota").val() != null && $("#id_mascota").val() != "" )		 		
		 			param = param+"&masc="+$("#id_mascota").val();

		 		actualizar=true;
		 	}

		 	if( $("#id_prestacion_medica").val() != "" && actualizar ){
		 		if(param!="")param = param+"&"; 
		 		param = param+"pres="+$("#id_prestacion_medica").val();		 		
		 	}


		 	if(actualizar)
		 		window.location.href = "turnosPrestacionesAdd?" + param;            						
		 });      						
	});

</script>
