<?php 
//models/Usuarios.php

class Ordenes extends Model {

	public function getTodos(){

		$this->db->query("SELECT DISTINCT o.id_orden, DATE_FORMAT(o.fecha_ingreso, '%d-%m-%Y') as fecha_ingreso,  o.id_cliente, c.nombre, c.apellido, oe.nombre as nombre_estado, m.nombre as modelo, o.falla_declarada, e.serie
					FROM `ordenes` as o 
				    INNER JOIN clientes as c 
				    	ON o.id_cliente=c.id_cliente  
				    INNER JOIN equipos as e
				    	ON e.id_equipo=o.id_equipo
				    INNER JOIN modelos as m
				    	ON e.id_modelo=m.id_modelo					    
                    LEFT JOIN ordenes_eventos as oev
                    	ON oev.id_orden=o.id_orden
                    LEFT JOIN ordenes_estados as oe
                    	ON oev.id_orden_estado=oe.id_orden_estado
                    WHERE oev.id_orden_estado IN (SELECT MAX(id_orden_estado) from ordenes_eventos WHERE id_orden = o.id_orden)
				    ORDER BY o.fecha_ingreso DESC
				    LIMIT 50
						  ");
		
		return $this->db->fetchAll();
	}

	public function getTodosRango($desde="", $hasta=""){

		if( empty($desde) ) 
				$desde = "NOW()" ;
		else
			$this->validaFecha($desde);		
		if( empty($hasta) ) 
				$hasta = "NOW()" ; 
		else
			$this->validaFecha($hasta);

		$sql = "SELECT DISTINCT o.id_orden, DATE_FORMAT(o.fecha_ingreso, '%d-%m-%Y') as fecha_ingreso,  o.id_cliente, c.nombre, c.apellido, oe.nombre as nombre_estado, m.nombre as modelo, o.falla_declarada, e.serie
					FROM `ordenes` as o 
				    INNER JOIN clientes as c 
				    	ON o.id_cliente=c.id_cliente  
				    INNER JOIN equipos as e
				    	ON e.id_equipo=o.id_equipo
				    INNER JOIN modelos as m
				    	ON e.id_modelo=m.id_modelo					    
                    LEFT JOIN ordenes_eventos as oev
                    	ON oev.id_orden=o.id_orden
                    LEFT JOIN ordenes_estados as oe
                    	ON oev.id_orden_estado=oe.id_orden_estado
                    WHERE oev.id_orden_estado IN (SELECT MAX(id_orden_estado) from ordenes_eventos WHERE id_orden = o.id_orden) AND
				    o.fecha_ingreso BETWEEN '$desde' AND '$hasta'
				    ORDER BY oev.fecha DESC, o.id_orden DESC
				    LIMIT 50
						  ";
		//echo $sql;exit;

		$this->db->query($sql);
		
		return $this->db->fetchAll();
	}

	public function getSerie($txt){
		$sql = "SELECT o.id_orden, DATE_FORMAT(o.fecha_ingreso, '%d-%m-%Y') as fecha_ingreso,  o.id_cliente, c.nombre, c.apellido, oev.id_orden_estado, est.nombre as nombre_estado, m.nombre as modelo, o.falla_declarada, e.serie
					FROM `ordenes` as o 
				    INNER JOIN clientes as c 
				    	ON o.id_cliente=c.id_cliente  
				    INNER JOIN equipos as e
				    	ON e.id_equipo=o.id_equipo
				    INNER JOIN modelos as m
				    	ON e.id_modelo=m.id_modelo	
				    LEFT JOIN ordenes_eventos as oev
                    	ON oev.id_orden=o.id_orden
				    LEFT JOIN ordenes_estados as est
				    	ON oev.id_orden_estado=est.id_orden_estado 			    
				    WHERE oev.id_orden_estado IN (SELECT MAX(id_orden_estado) from ordenes_eventos WHERE id_orden = o.id_orden) 
				    AND e.serie like '%$txt%'
				    ORDER BY o.fecha_ingreso DESC
						  ";
		//echo $sql;exit;

		$this->db->query($sql);		
		return $this->db->fetchAll();
	}

	public function getId($id){	

		if( !ctype_digit($id) )die("id_orden no es un numero.");	
		if( $id <= 0 )die("id_orden fuera de rango.");

		$this->db->query( "SELECT o.id_orden, DATE_FORMAT(o.fecha_ingreso, '%Y-%m-%d') as fecha_ingreso,  o.id_cliente, c.nombre, c.apellido, o.id_estado, m.nombre as modelo, o.falla_declarada, o.observacion, o.observacion_privada, o.id_orden_proforma, o.pdescuento, o.costo, o.importe, e.serie
					FROM `ordenes` as o 
				    INNER JOIN clientes as c 
				    	ON o.id_cliente=c.id_cliente  
				    INNER JOIN equipos as e
				    	ON e.id_equipo=o.id_equipo
				    INNER JOIN modelos as m
				    	ON e.id_modelo=m.id_modelo					   	  
							WHERE id_orden=".$id 
						);
		
		return  $this->db->fetch();

	}

	public function add($id_equipo, $id_cliente, $fecha_ingreso, $id_estado, $id_usuario, $id_tecnico, $falla_declarada="", $observacion="", $observacion_privada=""){

		$sql="INSERT INTO ordenes (id_equipo, id_cliente, fecha_ingreso, id_usuario, falla_declarada, observacion, observacion_privada) 
						values ($id_equipo, $id_cliente, '$fecha_ingreso', $id_usuario, '$falla_declarada', '$observacion', '$observacion_privada')";
		//echo $sql;exit;
		$this->db->query($sql);
		$id = $this->db->last_id();

		if($id)
			$this->addEvento($id, 1, $fecha_ingreso);

	}

	/**
	 * Agrega un evento a la orden de reparacion
	 * 
	 * @param int $id_orden 
	 * @param int $id_orden_estado 
	 * @param string $fecha 
	 * @param string|null $fecha_notificacion 
	 * @param string|null $observacion 
	 * @return void
	 */
	public function addEvento($id_orden, $id_orden_estado, $fecha, $fecha_notificacion=null, $observacion=null){

		$f_not=($fecha_notificacion==null)? 'NULL' : "'$fecha_notificacion'";
		$obs=($observacion==null)? 'NULL' : "'$observacion'";

		$sql="INSERT INTO ordenes_eventos (id_orden, id_orden_estado, fecha, fecha_notificacion, observacion) 
						values ($id_orden, $id_orden_estado, '$fecha', $f_not, $obs)";
		//echo $sql;exit;
		return $this->db->query($sql);

	}

	public function edit($id, $fecha_ingreso, $id_cliente, $id_usuario, $pdescuento, $costo, $importe, $id_proforma,$falla_declarada="", $observacion="", $observacion_privada=""){

		if(!$this->validaProforma($id_proforma))
				$id_proforma = 'NULL';

		$falla=($falla_declarada!="")? "'$falla_declarada'" : 'NULL';
		$obs=($observacion!="")? "'$observacion'" : 'NULL';
		$obs_priv=($observacion_privada!="")? "'$observacion_privada'" : 'NULL';

		$sql ="UPDATE ordenes SET fecha_ingreso='$fecha_ingreso', 
								 id_cliente=$id_cliente,
								 id_usuario=$id_usuario,
								 pdescuento=$pdescuento,
								 costo=$costo,
								 importe=$importe,
								 id_orden_proforma=$id_proforma,
								 falla_declarada=$falla, 
								 observacion=$obs, 
								 observacion_privada=$obs_priv
				WHERE id_orden=".$id;
		//echo $sql;exit;
		return $this->db->query($sql);
	}
	
	public function getEventosId($id){	

		if( !ctype_digit($id) )die("id_orden no es un numero.");	
		if( $id <= 0 )die("id_orden fuera de rango.");

		$this->db->query( "SELECT oe.id_orden, oe.id_orden_estado, est.nombre, oe.observacion, oe.fecha, oe.fecha_notificacion
							FROM ordenes as o
							INNER JOIN ordenes_eventos as oe
								ON oe.id_orden=o.id_orden
							INNER JOIN ordenes_estados as est
								ON oe.id_orden_estado=est.id_orden_estado

							WHERE o.id_orden=$id 
							ORDER BY oe.fecha DESC, oe.id_orden_estado DESC
							"
						);
		
		return  $this->db->fetchall();

	}

	/**
	 * listado de repuestos utilizados en la reparacion
	 * 
	 * @param int $id id_orden
	 * @return void
	 */
	public function getRepuestosId($id){	

		if( !ctype_digit($id) )die("id_orden no es un numero.");	
		if( $id <= 0 )die("id_orden fuera de rango.");

		$sql = "SELECT odr.id_orden_detalle_repuesto, o.id_orden, odr.id_repuesto, odr.serie, odr.costo, r.nombre as nombre_repuesto
							FROM ordenes as o
							INNER JOIN ordenes_detalle_repuestos as odr
								ON odr.id_orden=o.id_orden
							INNER JOIN repuestos as r
								ON odr.id_repuesto=r.id_repuesto

							WHERE o.id_orden=".$id ;
		//echo $sql;exit;
		$this->db->query( $sql );
		
		return  $this->db->fetchall();

	}

	/**
	 * listado de reparaciones realizadas
	 * 
	 * @param int $id id_orden
	 * @return array
	 */
	public function getReparacionesId($id){	

		if( !ctype_digit($id) )die("id_orden no es un numero.");	
		if( $id <= 0 )die("id_orden fuera de rango.");

		$sql = "SELECT o.id_orden, odr.id_reparacion, odr.fecha_finalizada, odr.precio, odr.observacion, odr.id_tecnico, r.nombre as nombre_reparacion
							FROM ordenes as o
							INNER JOIN ordenes_detalle_reparaciones as odr
								ON odr.id_orden=o.id_orden 
							INNER JOIN reparaciones as r
								ON odr.id_reparacion=r.id_reparacion

							WHERE o.id_orden=".$id ;
		//echo $sql;exit;
		$this->db->query( $sql );
		
		return  $this->db->fetchall();

	}

	/**
	 * listado de pagos asociados a la orden
	 * 
	 * @param int $id id_orden
	 * @return array
	 */
	public function getPagosId($id){	

		if( !ctype_digit($id) )die("id_orden no es un numero.");	
		if( $id <= 0 )die("id_orden fuera de rango.");

		$sql = "SELECT p.id_pago_cliente, p.id_orden, p.id_forma_pago, p.fecha, p.importe, p.observacion, f.nombre as nombre_forma_pago 
				FROM `pagos_clientes` as p
			    INNER JOIN formas_pago as f
			    	ON f.id_forma_pago=p.id_forma_pago    
				WHERE p.id_orden=".$id ;
		//echo $sql;exit;
		$this->db->query( $sql );
		
		return  $this->db->fetchall();

	}	


	//retorna un array con la lista de todos los veterinarios (id_tipo_usuario=2)
	public function getSelectDataEstados(){
			
		$this->db->query("SELECT id_orden_estado AS id, nombre from  ordenes_estados");
		
		return $this->db->fetchAll();

	}

	//al menos 3 caracteres para el nombre de usuario
	private function validaUser($user){
		if( strlen($user) <= 3 ) throw new Exception("User, cantidad de caracteres inválida.");		
		$u = substr( $user, 0, 50 );
		$u = $this->db->escape($u);

		return $u;		
	}

	//al menos 3 caracteres para el nombre de usuario
	private function validaPass($pass){
		if( strlen($pass) <= 3 ) throw new Exception("Pass, cantidad de caracteres inválida.");		
		$u = substr( $pass, 0, 50 );
		$u = $this->db->escape($u);

		return $u;			
	}

	private function validaProforma($id){
		if(!ctype_digit($id)) return false;
		if($id <= 0)return false;

		return true;
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