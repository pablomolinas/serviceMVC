<div class="containe-fluid">		
  <div class="col-md-6">
	<div class="buscador">
		<input type="text" class="form-control" name="reparaciones" id="reparaciones" placeholder="Ingresa texto a buscar" />	
		<div id="resultados"></div>		
	</div>	
  </div>
</div>
<script type="text/javascript">
	
	$(document).ready(function(){

		$("body").on("keyup", "#reparaciones", function(e){
			
			var tecla = e.which;
			if(tecla == 27){ //ESC
				$(this).val("");
				$("#resultados").html("");
				return;
			}
			var request = $.ajax({
			  	url: "../ajax/busquedaReparaciones.php",
			    method: "POST",
  				data: { busqueda : $("#reparaciones").val() }
			}).done(function( datos ) {
			  $("#resultados").html(datos);
			}).fail(function( jqXHR, textStatus ) {
			  	alert( "Request failed: " + textStatus );
			});					

		});

		$("body").on("click", ".item-result", function(){
				alert($(this).attr("id") + ', descripcion: '+ $(this).children("span").text() );
		});

	});


</script>