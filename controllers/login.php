<?php 

session_start();

require_once '../fw/Database.php'; //no llamo a fw.php xq crea un redireccionamiento infinito
require_once '../fw/Model.php';
require_once '../fw/View.php';
require '../models/Usuarios.php';
require '../views/login.php';

$v = new login();

if(isset($_POST["user"]))
{    
    if(!isset($_POST["pass"])) $v->error("Error, parametro pass invalido.");

	$user = $_POST["user"];
	$pass = sha1($_POST["pass"]);

    try {
        $user=(new Usuarios())->login($user,$pass);    
        if( $user ){  
        
            $_SESSION['id_usuario'] = $user["id_usuario"];
            $_SESSION['nombre'] = $user["nombre"];
            $_SESSION['apellido'] = $user["apellido"];
            $_SESSION['user'] = $user["user"];      
            $_SESSION['id_tipo_usuario'] = $user["id_tipo_usuario"];
            
            header("Location: home.php");
            exit;
        } else
            $v->alertWarnings("Credenciales invalidas.");     

    } catch (Exception $e) {
        $v->alertWarnings($e->getMessage());  
    }            
}

$v->render_login();



 ?>