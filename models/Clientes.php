<?php 
//models/Clientes.php

class Clientes extends Model {

	public function getTodos(){

		$this->db->query("SELECT * FROM Clientes");
		
		return $this->db->fetchAll();
	}

	public function getId($id){		

		$this->db->query( "SELECT * from  usuarios
							WHERE id_usuario=".$id );
		
		return  $this->db->fetch();

	}

		

	public function getSelectData(){
			
		$this->db->query("SELECT id_cliente AS id, nombre from  clientes
							WHERE id_estado=1");
		
		return $this->db->fetchAll();

	}

}

 ?>