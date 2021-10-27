<?php 
//controllers/home.php
require '../fw/fw.php';
require '../views/home.php';

$v = new home(); //vista
//$v->empleados = $e->getTodos();
$v->render();



 ?>