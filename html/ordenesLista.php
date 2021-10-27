<div class="card">
  <div class="card-header">
    	<h3>Ordenes de reparacion</h3>
    	<form method="post" id="form_filtro">
    	<div class="container">
	    	<div class="row">    		
	    		<div class="col-4">		    	
			    		<div class="form-group">
				    		<label for="desde">Desde</label>  	    		
				    		<input class="form-control" type="date" autocomplete="off" name="desde" id="desde" value="<?php echo $this->desde; ?>" >
				    	</div>	
		    	</div>
	    		<div class="col-4">
	    			<div class="form-group">
			    		<label for="hasta">Hasta</label> 	    			
	    				<input class="form-control" type="date" autocomplete="off" name="hasta" id="hasta" value="<?php echo $this->hasta; ?>"  >	    			
				    </div>    			
	    		</div>   		
	    		<div class="col-4 align-self-center">
	    			<?php if(!empty($this->info)) echo '<div class="alert alert-success" role="alert">
																'.$this->info.'
														</div>'; ?>							
					
	    			<input type="submit" class="btn btn-info " value="Consultar">		
				</div>
	    	</div><!-- end row -->	    	
	    	<div class="row-form">
	    		<label for="serie">Serie</label>
	    		<input type="text" class="form-control col-md-3" name="serie" id="serie" value="" />
	    	</div><!-- end row2 -->
	    	<div class="row">
	    		<div class="col-md-2 offset-md-10"><a type="submit" href="ordenes-add.php" class="btn btn-primary" value="Consultar">Nueva Orden</a></div>
	    	</div><!-- end row3 -->
	    </div>
	    </form>		
  </div>
  <div class="card-body">
    	<table class="table table-sm table-striped table-hover table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Fecha ingreso</th>
					<th>Cliente</th>
					<th>Serie</th>
					<th>Equipo</th>					
					<th>Falla declarada</th>					
					<th>Estado</th>					
					<th>Accion</th>
				</tr>	
			</thead>					
			<tbody>
			<?php 				
			if( $this->datos ){
				$filas ="";			
				foreach ($this->datos as $value) {
					$filas .= "<tr>";				
					$filas .= "<td>".$value["id_orden"]."</td>";
					$filas .= "<td>".$value["fecha_ingreso"]."</td>";
					$filas .= "<td>".$value["nombre"]."</td>";				
					$filas .= "<td>".$value["serie"]."</td>";				
					$filas .= "<td>".$value["modelo"]."</td>";				
					$filas .= "<td>".$value["falla_declarada"]."</td>";
					$filas .= "<td>".$value["nombre_estado"]."</td>";		

					
					$filas .= '<td>
								<a class="btn btn-primary btn-edit" href="ordenes-edit.php?id='.$value["id_orden"].'" id="btn-edit'.$value["id_orden"].'" title="Editar orden"><i class="fa fa-edit"></i></a>
							   </td>';
					$filas .="</tr>";					
				} 
				echo $filas;
			}else echo '<tr><td colspan="7">Sin resultados</td></tr>';
			?>
			</tbody>
		</table>
  </div>
</div>
<script type="text/javascript">
	
	$(document).ready(function(){		
		
		
		$("body").on( "click" , ".btn-cancel" , function(){
            		if( confirm("Quieres cancelar el orden #" + $(this).attr("id_orden") + "?" ) )
            						window.location.href = "ordenes-cancel.php?id="+$(this).attr("id_orden");            						
         });

	});

</script>



	
