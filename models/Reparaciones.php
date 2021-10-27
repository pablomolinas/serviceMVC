<?php 
//models/Reparaciones.php

class Reparaciones extends Model {

	public function getTodos(){

		$this->db->query("SELECT * FROM reparaciones");
		
		return $this->db->fetchAll();
	}

	public function buscar($busqueda){
		$txt = $this->db->escape($busqueda);
		$txt = $this->db->escapeWildcards($txt);

		$sql = "SELECT id_reparacion, nombre, id_moneda 
					FROM reparaciones
					WHERE nombre LIKE '%$txt%' 
					LIMIT 100";
		//echo $sql;exit;
		$this->db->query($sql);
		return $this->db->fetchAll();
	}

		

}

 ?>