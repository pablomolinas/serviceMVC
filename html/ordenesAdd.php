<div class="container mt-3">
	<div class="row">
		<div class="col-2">
				<a class="btn btn-success" href="ordenes.php" title="Regresar"><i class="fa fa-long-arrow-alt-left"></i></a>
		</div>
		<div class="col-8">
				<h3>Nueva orden de reparacion</h3>
		</div>
	</div>

			  	
	<?php echo $this->info; ?>
	<form action="" method="POST" name="form_add" id="form_add">    
	<div class="container-fluid">
		<div class="row">
				<div class="col-6">                                          
                    <div class="form-group">
                        <label for="fecha_ingreso" >Fecha (*)</label>
                        <input id="fecha_ingreso" name="fecha_ingreso" type="date" class="form-control " placeholder="Selecciona una fecha" value="<?php echo $this->fecha_ingreso ?>"  required />		                        
                    </div>		                    
                    <div class="form-row">
					    <div class="col-md-6 mb-3">
					      <label for="id_cliente">Cliente (*)</label>
					     <?php echo $this->sel_clientes; ?>      
					    </div>	    						    
					</div>                      
				</div>
				<div class="col-6"><!--col2-->
					<div class="form-row">
					    <div class="col-md-6 mb-3">
					      <label for="id_cliente">Propietario del equipo (*)</label>
					     <?php echo $this->sel_propietarios; ?>      
					    </div>	    						    
					</div> 
					<div class="form-row">
					    <div class="col-md-12">
					      <label for="modelo">Equipo</label>
					      <?php echo $this->sel_equipos; ?>
					    </div>		
					    		    
					</div>						
					<div class="row">
						<div class="form-group">
	                        <label for="id_orden_proforma" >Proforma asociada</label>
	                        
                    	</div>
					</div>
				</div><!-- end col2 -->					
		</div><!-- end row1 -->
		<div class="row"><!-- row2 -->
			<div class="col-6">
				<div class="form-group">
				    <label for="falla_declarada">Falla declarada</label>
				    <textarea class="form-control" id="falla_declarada" name="falla_declarada" rows="3" 					     
				    ></textarea>
				</div>										
			</div><!-- end col -->
			<div class="col"><!-- col2 -->
				<div class="form-group">
				    <label for="observacion">Observacion</label>
				    <textarea class="form-control" id="observacion" name="observacion" rows="3" 					     
				    ></textarea>
				</div>
				<div class="form-group">
				    <label for="diagnostico">Observacion privada</label>
				    <textarea class="form-control" id="observacion_privada" name="observacion_privada" rows="3" 					     
				    ></textarea>
				</div>
			</div><!-- end col2 -->
		</div><!-- end row2 -->						
		<div class="row"><input type="button" id="guardar" class="btn btn-primary" value="Guardar" /></div>	     	
		
	</div><!-- end container -->	
	<input type="hidden" name="accion" id="accion" />
	
</form>
</div><!-- END ROW -->
<script type="text/javascript">
	
	
	
	$(document).ready(function(){
			
		 
		 $("body").on("click" , "#guardar" , function(){		 				 				 		
		 		$("#accion").val("guardar");
		 		$("#form_add").submit();
		 		//return true;
		 });

		 $("body").on( "change" , "#fecha, #id_propietario" , function(){
		 			$("#accion").val("");
		 			$("#form_add").submit();	 		           						
		 });  

		
	});

</script>
