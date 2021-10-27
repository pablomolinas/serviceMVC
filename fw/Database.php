<?php 
//Patron Singleton

//constantes de conexion
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'bd_serv');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHAR', 'utf8');

class Database 
{
	private $res;
	private $cn=false;
	

	private static $instance = false;

	private function __construct(){  //patron Singleton

	}

	public static function getInstance(){
		if(!self::$instance) self::$instance = new Database();
		return self::$instance;
	}

	public function query($q){
		
		$this->connectIfNotConnected();		
		$this->res = mysqli_query($this->cn, $q);

		if( is_object($this->res) || $this->res==true )
				return true;
		
		return false;
			
	}

	
	private function connectIfNotConnected(){
		if(!$this->cn){
			$this->cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$this->cn->set_charset(DB_CHAR);
		}
	}	

	public function fetch(){
		
		if($this->res)
			 return mysqli_fetch_assoc($this->res);			
				
		return array();
								
	}

	public function fetchAll(){
		$aux = array();
		
		while( $fila = $this->fetch() ){
			$aux [] = $fila; 
		}

		return $aux;
	}

	public function last_id(){
		return mysqli_insert_id($this->cn);
	}

	public function numRows(){
		if(is_object($this->res))
			return mysqli_num_rows($this->res);	
		else
			return 0;
	}

	public function escape($str){
		$this->connectIfNotConnected();
		return mysqli_escape_string($this->cn, $str);
	}

	public function escapeWildcards($str){
		
		$str = str_replace( "%" , "\%" , $str );
		$str = str_replace( "_" , "\_" , $str );

		return $str;
	}

}

 ?>