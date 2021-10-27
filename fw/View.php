<?php 

abstract class View {
	public $info="";

	public function render(){
		self::render_head();
		include '../html/'.get_class($this).'.php';		
		self::render_footer();
	}

	public function render_login(){
		include '../html/head.php';
		include '../html/'.get_class($this).'.php';		
		self::render_footer();
	}

	public function render_head(){
		include '../html/head.php';		
		include '../html/nav.php';				
	}
	
	public function render_footer(){	
		include '../html/footer.php';		
	}

	/**
		Este metodo muestra la descripcion del error y detiene la ejecucion
	*/
	public function error($descripcion=""){
		$this->info = $descripcion;
		self::render_head();
		include '../html/error.php';
		self::render_footer();
		exit;
	}


	//Guarda un mensaje de exito en un cuadro, se debe visualizar el contenido de $this->info en la vista
	public function alertSuccess($t=""){
		$this->info = ($t=="")? "" : 	'<div class="alert alert-success" role="alert">
											'.$t.'
										</div>';
	}

	//Guarda un mensaje de advertencia en un cuadro, se debe visualizar el contenido de $this->info en la vista
	public function alertWarnings($t=""){
		$this->info = ($t=="")? "" : 	'<div class="alert alert-warning" role="alert">
											'.$t.'
										</div>';
	}

	
	/** 
	Genera un select html
	------------------------------------------------------------------------------  
    	Recibe un array con datos y configuracion
    	ejemplo de uso: 
		$param = [
					"datos"  => [
									[ "id" => "1" , "nombre" => "Isaac Newton" ],
									[  "id" => "2" , "nombre" => "Michael Faraday" ]
								],
				 	"nombre_control" => "id_fisico",
				 	"sel"	 =>	1
	    		 ];
		datos: <array> de <array>; cada fila contiene un array con dos campos dos campos asociativos (id y nombre)
        nombre_control: name e id html del control        
        sel: id seleccionado, selecciona sel=value del option
    	opcion_0_val: value de la primer opcion del select, por defecto ''
        desc_0: descripcion de la primer opcion, por defecto "Seleccionar"               
        cssClass: tiene las clases de control bootstrap por defecto, cambiar el valor reemplaza el default        
		min: validacion (ej:si min=3 valida el formulario para opciones >=3 )
		requerido: validacion (establece min=1)        
    */
    public function crearSelect( $param ) 
    {           
        $name 		= (!empty($param["nombre_control"]))? $param["nombre_control"] : "" ;        
        $sel 		= (!empty($param["sel"]))? $param["sel"] : '';
        $opcion_0   = (isset($param["opcion_0_val"]))? $param["opcion_0_val"] : '';
        $desc_0     = (isset($param["desc_0"]))? $param["desc_0"] : 'Seleccionar';
        $cssClass	= (isset($param["cssClass"]))? $param["cssClass"] : " ";      
        $toolTip 	= (isset($param["toolTip"]))? $param["toolTip"] : "Debes seleccionar un elemento.";        
        $disabled 	= (!empty($param["disabled"]))? ' disabled="disabled" ' : "";
        $min 		= (!empty($param["min"]))? ' min="'.$param["min"].'" ' : "";
        $requerido  = (!empty($param["requerido"]))? ' required ' : "";                
        $datos		= ( is_array($param["datos"]) )? $param["datos"] : array();

        if( $requerido != '' && $min=='' )$min=' min="1" ';

        $f=""; 
  		if(empty($name))    
              return "Error en parametros vista::crearSelect(): " ;          
       

        $f.= '<select name="'.$name.'" id="'.$name.'" '.$min.' title="'.$toolTip.'" class="form-control form-control-sm '.$cssClass.'" '.$disabled.$requerido.'>
                    <option value="'.$opcion_0.'" ';

        if(count($datos))
        {      	            
            if ($sel==$opcion_0 || empty($sel)) $f.='selected="selected"';
            
            $f.= '>'.$desc_0.'</option>';		    

        	foreach ($datos as $key => $value) {
        		$f.= '<option value="'.$value["id"].'" ';
        		if ($value["id"] == $sel) $f.='selected="selected"';
				$f.= '>'.$value["nombre"].'</option>';
        	}            
        }else
            $f.= '>'.$desc_0.'</option>';           

        $f.= '</select>';

        return $f;
    }

}

 ?>