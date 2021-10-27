<div class="card">
  <div class="card-header">
    	<h3>Lista de turnos de Prestaciones medicas</h3>
    	<div class="col-6">
	    	<form method="post" id="form_filtro">
	    		<div class="form-group row">
		    		<label class="col-sm-2 col-form-label" for="desde">Desde</label>    		
		    		<div class="col-sm-10">
		    			<input class="form-control form-control-sm" type="date" autocomplete="off" name="desde" id="desde" value="<?php echo $this->desde; ?>" required>
		    		</div>
		    		<label class="col-sm-2 col-form-label" for="hasta">Hasta</label>    		
	    			<div class="col-sm-10">
	    				<input class="form-control form-control-sm" type="date" autocomplete="off" name="hasta" id="hasta" value="<?php echo $this->hasta; ?>" required >
	    			</div>
		    	</div>		    	  			    		
		    	<input type="submit" class="btn btn-primary mb-2" value="Consultar">
	    	</form>	    	
	    	<?php if(!empty($this->info)) echo '<div class="alert alert-success" role="alert">
														'.$this->info.'
												</div>'; ?>
    	</div>
  </div>
  <div class="card-body">
    	<table class="table table-sm table-striped table-hover table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Fecha/Hora</th>
					<th>Cliente</th>
					<th>Prestacion Medica</th>					
					<th>Veterinario</th>					
					<th>Estado</th>					
					<th>Accion</th>
				</tr>	
			</thead>					
			<tbody>
			<?php 				
			if( $this->turnos ){
				$filas ="";			
				foreach ($this->turnos as $value) {
					$filas .= "<tr>";				
					$filas .= "<td>".$value["id_turno"]."</td>";
					$filas .= "<td>".$value["fecha"]." ".$value["nombre_horario"]."</td>";
					$filas .= "<td>".$value["apellido_cliente"].', '.$value["nombre_cliente"]."</td>";				
					$filas .= "<td>".$value["nombre_prestacion"]."</td>";				
					$filas .= "<td>".$value["nombre_veterinario"]."</td>";
					$filas .= "<td>".$value["nombre_estado"]."</td>";		

					//BOTONES DE ACCION
					$cancelar_des = ( $_SESSION["id_tipo_usuario"] == USER_ADMIN &&
									  $value["id_estado_turno"] == TURNO_ASIGNADO )? '' : 'disabled' ;
					$filas .= '<td>
								<a class="btn btn-primary btn-edit" href="turnosPrestacionesEdit-'.$value["id_turno"].'" id="btn-edit'.$value["id_turno"].'" title="Editar Turno"><i class="fa fa-edit"></i></a>
								<button class="btn btn-danger btn-cancel" id_turno="'.$value["id_turno"].'" id="btn-cancel'.$value["id_turno"].'" title="Cancelar Turno" '.$cancelar_des.'><i class="fa fa-times"></i></button>
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
            		if( confirm("Quieres cancelar el turno #" + $(this).attr("id_turno") + "?" ) )
            						window.location.href = "/veterinaria/turnosPrestacionesCancel-"+$(this).attr("id_turno");            						
         });

	});

</script>



	
