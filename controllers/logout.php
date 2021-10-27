<?php 
session_start();

unset($_SESSION["id_usuario"]);
unset($_SESSION["nombre"]);
unset($_SESSION["apellido"]);
unset($_SESSION["user"]);
unset($_SESSION["id_tipo_usuario"]);

$_SESSION = array();

header("Location: login.php");
exit;

 ?>