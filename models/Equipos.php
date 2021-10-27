<?php 
//models/Equipos.php

class Equipos extends Model {

	
	public function getId($id){		

		$this->db->query( "SELECT * from  usuarios
							WHERE id_usuario=".$id );
		
		return  $this->db->fetch();

	}
	

	public function getSelectDataCliente($id_cliente){
			
		$this->db->query("SELECT e.id_equipo AS id, CONCAT( e.serie, ' ,' ,m.nombre) as nombre
							from  equipos e
							INNER JOIN modelos as m
								ON e.id_modelo=m.id_modelo
							WHERE e.id_cliente=".$id_cliente);
		
		return $this->db->fetchAll();

	}

}

 ?>