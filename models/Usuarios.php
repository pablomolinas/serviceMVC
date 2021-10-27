<?php 
//models/Usuarios.php

class Usuarios extends Model {

	public function getTodos(){

		$this->db->query("SELECT * FROM usuarios");
		
		return $this->db->fetchAll();
	}

	public function getId($id){		

		$this->db->query( "SELECT * from  usuarios
							WHERE id_usuario=".$id );
		
		return  $this->db->fetch();

	}
	

	public function login($user, $pass){

		$u = $this->validaUser($user);
		$p = $this->validaPass($pass);

		$this->db->query( "SELECT * FROM usuarios
							WHERE user='$u' AND pass='$p'
						" );
		
		return  $this->db->fetch();

	}

	//retorna un array con la lista de todos los veterinarios (id_tipo_usuario=2)
	public function getSelectData(){
			
		$this->db->query("SELECT id_usuario AS id, nombre from  usuarios");
		
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

}

 ?>