<?php 
//models/TurnosPrestaciones.php

class TurnosPrestaciones extends Model {

	
	public function getId($id){

		if(!ctype_digit($id)) die("id_turno no es un numero");
		if($id <= 0) die("id_turno rango invalido");
		
		$sql = "SELECT t.id_turno, t.fecha, t.id_horario, h.nombre AS nombre_horario, t.id_factura_cliente, 
				t.id_cliente, c.nombre AS nombre_cliente, c.apellido AS apellido_cliente,
				t.id_mascota, t.id_prestacion_medica, t.id_veterinario, t.id_estado_turno, t.precio_costo, 
				t.precio_venta, t.diagnostico, m.nombre AS nombre_mascota, pm.nombre AS nombre_prestacion, 
				CONCAT(u.apellido, ', ', u.nombre) AS nombre_veterinario, et.id_estado_turno, 
				et.nombre AS nombre_estado
							FROM turnos_prestaciones_medicas AS t
							LEFT JOIN clientes c
								ON t.id_cliente = c.id_cliente
							LEFT JOIN mascotas AS m
								ON t.id_mascota = m.id_mascota							
							LEFT JOIN horarios AS h
								ON t.id_horario = h.id_horario
							LEFT JOIN prestaciones_medicas AS pm
								ON t.id_prestacion_medica = pm.id_prestacion_medica							
							LEFT JOIN usuarios AS u
								ON u.id_usuario = t.id_veterinario
							LEFT JOIN estados_turnos et
                            	ON t.id_estado_turno = et.id_estado_turno
							WHERE t.id_turno=".$id;

		$this->db->query($sql);
		
		return $this->db->fetch();
		
	}

	public function edit($id, $id_prestacion_medica, $fecha, $id_horario, $id_factura_cliente, $id_cliente, $id_mascota, 
						$diagnostico, $id_estado_turno, $id_veterinario){

		if(!ctype_digit($id)) 	throw new Exception("id_turno no es un numero.");
		if($id <= 0) 			throw new Exception("id_turno rango invalido.");
		if( !$this->getId($id) ) throw new Exception("id_turno inexistente.");
		
		$this->validaIdPrestacion($id_prestacion_medica);	
		$this->validaFecha($fecha);	
		$this->validaIdHorario($id_horario);			
		$this->validaIdCliente($id_cliente);	
		if(empty($id_factura_cliente)) $id_factura_cliente = 'NULL'; else $this->validaIdFactura($id_factura_cliente);
		if(empty($id_mascota)) $id_mascota = 'NULL'; else $this->validaIdMascota($id_mascota);		
		$diag = (empty($diagnostico))? 'NULL' : "'".$this->validaDiagnostico($diagnostico)."'";
		$this->validaIdEstadoTurno($id_estado_turno);
		$this->validaIdVeterinario($id_veterinario);
			
		

		$sql = "UPDATE turnos_prestaciones_medicas SET 
				id_prestacion_medica=$id_prestacion_medica, 
				fecha='$fecha', 
				id_horario=$id_horario, 
				id_factura_cliente=$id_factura_cliente, 
				id_cliente=$id_cliente, 
				id_mascota=$id_mascota, 
				diagnostico=$diag, 
				id_estado_turno=$id_estado_turno, 
				id_veterinario=$id_veterinario, 
				precio_costo=0, 
				precio_venta=0
				WHERE id_turno=".$id;
		//echo $sql;exit;
		if($this->db->query($sql))
			return $this->actualizarPrecioTurno($id);
		else
			return false;
	}

	//actualiza precio_costo y precio_venta de id_turno, segun su precio en la prestacion_medica
	private function actualizarPrecioTurno($id_turno){
				
			//VALIDAR

			$sql = "UPDATE turnos_prestaciones_medicas a
					INNER JOIN prestaciones_medicas b 
							ON a.id_prestacion_medica = b.id_prestacion_medica
					SET a.precio_costo = b.precio_costo, a.precio_venta = b.precio_venta
					WHERE a.id_turno=$id_turno";
			return $this->db->query($sql);
	}

	
	//agregar un nuevo turno y retorna el id, o false si error
	public function add($id_prestacion_medica, $fecha, $id_horario, $id_cliente, 
							$id_mascota, $id_estado_turno, $id_veterinario){
		
		$this->validaIdPrestacion($id_prestacion_medica);
		$this->validaFecha($fecha);	
		$this->validaIdHorario($id_horario);			
		$this->validaIdCliente($id_cliente);	
		if(empty($id_mascota)) 	$id_mascota = 'NULL'; else $this->validaIdMascota($id_mascota);
		$this->validaIdEstadoTurno($id_estado_turno);
		$this->validaIdVeterinario($id_veterinario);
		
		$sql = "INSERT INTO `turnos_prestaciones_medicas` (`id_prestacion_medica`, `fecha`, `id_horario`, `id_cliente`, `id_mascota`, `id_estado_turno`, `id_veterinario`) 
			VALUES ($id_prestacion_medica, '$fecha', $id_horario, $id_cliente, $id_mascota, $id_estado_turno, $id_veterinario)";
		
		//echo $sql;exit;
		if($this->db->query($sql)){
				 $id = $this->db->last_id(); 		//obtengo el ultimo id
				 $this->actualizarPrecioTurno($id); //actualizo precios
				 return $id;
		}			
		else
			return false;
	}

	public function getTodos(){

		$this->db->query("SELECT t.id_turno,  DATE_FORMAT(t.fecha, '%d-%m-%Y') AS fecha, t.id_horario, h.nombre AS nombre_horario, t.id_factura_cliente, 
							t.id_cliente, c.nombre AS nombre_cliente, c.apellido AS apellido_cliente,
							t.id_mascota, t.id_prestacion_medica, t.id_veterinario, t.id_estado_turno, t.precio_costo, 
							t.precio_venta, t.diagnostico, m.nombre AS nombre_mascota, pm.nombre AS nombre_prestacion, 
							CONCAT(u.apellido, ', ', u.nombre) AS nombre_veterinario, et.id_estado_turno, 
							et.nombre AS nombre_estado
							FROM turnos_prestaciones_medicas AS t
							LEFT JOIN clientes c
								ON t.id_cliente = c.id_cliente
							LEFT JOIN mascotas AS m
								ON t.id_mascota = m.id_mascota							
							LEFT JOIN horarios AS h
								ON t.id_horario = h.id_horario
							LEFT JOIN prestaciones_medicas AS pm
								ON t.id_prestacion_medica = pm.id_prestacion_medica							
							LEFT JOIN usuarios AS u
								ON u.id_usuario = t.id_veterinario
							LEFT JOIN estados_turnos et
                            	ON t.id_estado_turno = et.id_estado_turno
							");
		return $this->db->fetchAll();
	}

	//Listado de turnos por rango de fechas
	public function getTodosRango($desde="", $hasta=""){
		
		if( empty($desde) ) 
				$desde = "NOW()" ;
		else
			$this->validaFecha($desde);		
		if( empty($hasta) ) 
				$hasta = "NOW()" ; 
		else
			$this->validaFecha($hasta);


		$sql = "SELECT t.id_turno, DATE_FORMAT(t.fecha, '%d-%m-%Y') AS fecha, t.id_horario, h.nombre AS nombre_horario, t.id_factura_cliente, 
				t.id_cliente, c.nombre AS nombre_cliente, c.apellido AS apellido_cliente,
				t.id_mascota, t.id_prestacion_medica, t.id_veterinario, t.id_estado_turno, t.precio_costo, 
				t.precio_venta, t.diagnostico, m.nombre AS nombre_mascota, pm.nombre AS nombre_prestacion, 
				CONCAT(u.apellido, ', ', u.nombre) AS nombre_veterinario, et.id_estado_turno, 
				et.nombre AS nombre_estado
							FROM turnos_prestaciones_medicas AS t
							LEFT JOIN clientes c
								ON t.id_cliente = c.id_cliente
							LEFT JOIN mascotas AS m
								ON t.id_mascota = m.id_mascota							
							LEFT JOIN horarios AS h
								ON t.id_horario = h.id_horario
							LEFT JOIN prestaciones_medicas AS pm
								ON t.id_prestacion_medica = pm.id_prestacion_medica							
							LEFT JOIN usuarios AS u
								ON u.id_usuario = t.id_veterinario
							LEFT JOIN estados_turnos et
                            	ON t.id_estado_turno = et.id_estado_turno
							WHERE t.fecha BETWEEN '$desde' AND '$hasta'
							";
		//echo $sql;exit; //DEBUG		

		$this->db->query($sql);
		return $this->db->fetchAll();
	}

	//Listado de turnos por rango de fechas para un veterinario determinado
	public function getTodosRangoVet($id_vet, $desde="", $hasta=""){
		
		if( empty($desde) ) 
				$desde = "NOW()" ;
		else
			$this->validaFecha($desde);		
		if( empty($hasta) ) 
				$hasta = "NOW()" ; 
		else
			$this->validaFecha($hasta);


		$sql = "SELECT t.id_turno, DATE_FORMAT(t.fecha, '%d-%m-%Y') AS fecha, t.id_horario, h.nombre AS nombre_horario, t.id_factura_cliente, 
				t.id_cliente, c.nombre AS nombre_cliente, c.apellido AS apellido_cliente,
				t.id_mascota, t.id_prestacion_medica, t.id_veterinario, t.id_estado_turno, t.precio_costo, 
				t.precio_venta, t.diagnostico, m.nombre AS nombre_mascota, pm.nombre AS nombre_prestacion, 
				CONCAT(u.apellido, ', ', u.nombre) AS nombre_veterinario, et.id_estado_turno, 
				et.nombre AS nombre_estado
							FROM turnos_prestaciones_medicas AS t
							LEFT JOIN clientes c
								ON t.id_cliente = c.id_cliente
							LEFT JOIN mascotas AS m
								ON t.id_mascota = m.id_mascota							
							LEFT JOIN horarios AS h
								ON t.id_horario = h.id_horario
							LEFT JOIN prestaciones_medicas AS pm
								ON t.id_prestacion_medica = pm.id_prestacion_medica							
							LEFT JOIN usuarios AS u
								ON u.id_usuario = t.id_veterinario
							LEFT JOIN estados_turnos et
                            	ON t.id_estado_turno = et.id_estado_turno
							WHERE t.id_veterinario=$id_vet AND t.fecha BETWEEN '$desde' AND '$hasta'
							";
		//echo $sql;exit; //DEBUG		

		$this->db->query($sql);
		return $this->db->fetchAll();
	}
	
	//Estable un turno en id_estado_turno=3 (cancelado)
	public function cancelarTurno($id){
		
		if(!ctype_digit($id)) throw new Exception("id_turno no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_turno rango invalido.");		
		if(!$this->getId($id)) throw new exception("ID inexistente.");

		return $this->db->query("UPDATE turnos_prestaciones_medicas SET id_estado_turno=".TURNO_CANCELADO." 
							WHERE id_turno=".$id);
	}


	public function getHistoriaClinica($id_mascota){
			
	$this->db->query("SELECT  DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, diagnostico , id_prestacion_medica from turnos_prestaciones_medicas WHERE id_mascota=".$id_mascota);		

	return $this->db->fetchAll();

	}


	// recibe una fecha y retorna todos los turnos disponibles para ese dia(no asignados, no cumplidos),
	// incluyendo el id_sel si lo recibe como parametro porque es el turno propio en cuestion
	public function getSelectDataFechaVet($fecha, $veterinario, $id_sel=""){

			if(!ctype_digit($veterinario)) die("veterinario no es un numero.");
			if($veterinario <= 0) 	 	   die("veterinario rango invalido.");

			$f = explode('-', $fecha);
			if ( count($f) == 3 ){
	   			 if ( !checkdate($f[1], $f[2], $f[0]) )die("Fecha invalida.");
			}else{
				die("Fecha formato invalido.");
			}


			//VALIDAR fecha, veterinario,  id_sel
			$sql = "SELECT id_horario AS id, nombre FROM horarios
										WHERE id_horario NOT IN 
										(select id_horario from turnos_prestaciones_medicas 
												where fecha = '$fecha' 
												AND (id_estado_turno=".TURNO_ASIGNADO." OR id_estado_turno=".TURNO_CUMPLIDO.") 
												AND id_veterinario=$veterinario)";

			if(!empty($id_sel))
					$sql .= "OR id_horario=".$id_sel;

			$this->db->query($sql);		

			return $this->db->fetchAll();

	}
		
	private function validaDiagnostico($txt){

		$txt = substr( $txt, 0, 400 );
		$txt = $this->db->escape($txt);
		return $txt;		

	}
	private function validaIdMascota($id){

		if(!ctype_digit($id)) throw new Exception("id_mascota no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_mascota rango invalido.");
		if( !$this->db->query("SELECT * FROM mascotas WHERE id_mascota=".$id) ) 
							  throw new Exception("id_mascota inexistente.");

	}

	private function validaIdEstadoTurno($id){

		if(!ctype_digit($id)) throw new Exception("id_estado_turno no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_estado_turno rango invalido.");
		if( !$this->db->query("SELECT * FROM estados_turnos WHERE id_estado_turno=".$id) ) 
							  throw new Exception("id_estado_turno inexistente.");

	}

	private function validaIdVeterinario($id){

		if(!ctype_digit($id)) throw new Exception("id_veterinario no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_veterinario rango invalido.");
		if( !$this->db->query("SELECT * FROM usuarios WHERE id_tipo_usuario=2 AND id_usuario=".$id) ) 
							  throw new Exception("id_veterinario inexistente.");

	}

	private function validaIdCliente($id){

		if(!ctype_digit($id)) throw new Exception("id_cliente no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_cliente rango invalido.");
		if( !$this->db->query("SELECT * FROM clientes WHERE id_cliente=".$id) ) 
							  throw new Exception("id_cliente inexistente.");

	}

	private function validaIdFactura($id){

		if(!ctype_digit($id)) throw new Exception("id_factura_cliente no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_factura_cliente rango invalido.");
		if( !$this->db->query("SELECT * FROM facturas_clientes WHERE id_factura_cliente=".$id) ) 
							  throw new Exception("id_factura_cliente inexistente.");

	}

	private function validaIdPrestacion($id){

		if(!ctype_digit($id)) throw new Exception("id_prestacion no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_prestacion rango invalido.");
		if( !$this->db->query("SELECT * FROM prestaciones_medicas WHERE id_prestacion_medica=".$id) ) 
							  throw new Exception("id_prestacion inexistente.");

	}

	private function validaIdHorario($id){

		if(!ctype_digit($id)) throw new Exception("id_horario no es un numero.");
		if($id <= 0) 	 	  throw new Exception("id_horario rango invalido.");
		if( !$this->db->query("SELECT * FROM horarios WHERE id_horario=".$id) ) 
							  throw new Exception("id_horario inexistente.");

	}

	private function validaFecha($fecha){

		$f = explode('-', $fecha);
		if ( count($f) == 3 ){
   			 if ( !checkdate($f[1], $f[2], $f[0]) )	throw new Exception("Fecha invalida.");
		}else{
			throw new Exception("Fecha formato invalido.");
		}

	}
	
}

 ?>