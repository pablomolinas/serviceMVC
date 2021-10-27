<?php 
//  fw/fw.php
session_start();

require_once '../fw/Database.php';
require_once '../fw/Model.php';
require_once '../fw/View.php';

if(!isset($_SESSION["id_usuario"])){
	
    header("Location: ../controllers/login.php");exit;
              
}


 ?>