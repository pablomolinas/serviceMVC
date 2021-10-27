<?php

if(isset($_POST["busqueda"])){	
	if($_POST["busqueda"] != "" ){
		require_once '../fw/fw.php';	
		require_once( '../models/Reparaciones.php' ); 

		$r = new Reparaciones();

		$result = $r->buscar($_POST["busqueda"]);
		
		if($result){	
			$txt = '<ul>';
			foreach ($result as $value) {
			  $txt .= '<li>
							<a href="#" class="item-result" id="'.$value["id_reparacion"].'" precio="'.$value["id_moneda"].'" >'.$value["id_reparacion"].', <span class="desc">'.$value["nombre"].'</span></a>
					   </li>'; 
			}
			$txt .= "</ul>";
		}else
			$txt='<ul><li href="#" class="item-result">Sin resultados.</li></ul>';

		echo $txt;
	}else
		echo "";

}else
	echo "Error, no se recibio cadena de busqueda";

exit;
 ?>