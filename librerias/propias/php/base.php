<?php 
Class base{
	protected $coneccion		= array();
	protected $cantidad			= 0;
	protected $referencia 		= "";
	protected $forma 			= "";
	
	function base(){
		$host="localhost";
		$base="gtcompra";
		$usuario="pr_alpha";
		$password="2W2tMEPGdP2pZA3m";
		$enlace = new mysqli($host, $usuario, $password,$base);           
		$this->coneccion = $enlace;
	}
	
	//define la cantida de tuplas a afectar o retornar, por defecto estara en 0 que es no hay limite
	function set_cantidad($valor){
		$this->cantidad = $valor;
	}
	//define si que encabezado servira de referencia para el orden por defecto esta vacio para que no lo ordene.
	function set_referencia($valor){
		$this->referencia = $valor;
	}
	//define la forma en la que se mostrara la consulta si en forma desendente o desendente, por defecto esta vacio para que no ordene
	function set_forma($valor){
		$this->forma = $valor;
	}

	function iniciar_transaccion(){
		$sql = "START TRANSACTION";
		if($this->coneccion->query($sql)){
			return 1;
		}else{
			return "error al iniciar transaction ".$this->coneccion->error;
		}
	}
	function confirmar_transaccion(){
		$sql = "COMMIT";
		if($this->coneccion->query($sql)){
			return 1;
		}else{
			return "error al hacer commit ".$this->coneccion->error;
		}	
	}
	function regresar_transaccion(){
		$sql = "ROLLBACK";
		if($this->coneccion->query($sql)){
			return 1;
		}else{
			return "error al hacer rollback ".$this->coneccion->error;
		}	
	}
	//se setean todas las restricciones que se usaran tanto en las consultas, actualizaciones y eliminaciones
	// eje: $restriccion = array(array("and","tabla.encabezado",">=(operador)",valor),array("and(agregado)","encabezado","<=(operador)",tabla.encabezado));
	function restricciones($restriccion){
		$sql = " WHERE ";
		for($i=0;$i<count($restriccion);$i++){
			$sql	.= " ".$restriccion[$i][0]." ";
			$sql	.= $restriccion[$i][1]." ";
			$sql	.= $restriccion[$i][2]." ";
			if(strpos($restriccion[$i][3], ".")){
				$sql .= $restriccion[$i][3];
			}elseif($restriccion[$i][3]==""){
				$sql .= "NULL";
			}else{
				$sql .= "'".$restriccion[$i][3]."'";
			}	
		}
		return $sql;
	}
	//inserta los valores a la base de datos ingresa valores con su respectivo encabezado de tabla,
	//$variables = array("encabezado1"=>"valor","encabezado2"=>"valor2");
	//$tabla= string con nombre de la tabla,
	//$increment estring con 1 o 0 que significa: 1 = retorna el insert_id y 0 retorno la cantidad de filas afectadas
	function insertar($variables, $tabla,$increment){
		$estructura = "(";
		$valores	= "(";
		$sql 	= "INSERT INTO $tabla "; //se inicia con la sentensia sql del insert y se especifica la tabla.
		if(count($variables)>0){	//verifico que vengan valores para ingresar
			foreach ($variables as $clave => $valor) {
				$estructura 	.= $clave.", ";
				if($valor==""){
					$valores 	.= "NULL , ";	
				}else{
					$valores 	.= "'".verificar_texto($valor)."', ";	
				}
			}
			$estructura = substr($estructura, 0, -2);
			$valores 	= substr($valores, 0, -2);
			$estructura .= ")";
			$valores	.= ")";
			$sql		.= $estructura." VALUES ".$valores;
			if($this->coneccion->query($sql)){
				if($this->coneccion->affected_rows>0){
					if($increment==1)
						$respuesta = array("codigo"=>'1',"mensaje"=>$this->coneccion->insert_id);	
					else
						$respuesta = array("codigo"=>'1',"mensaje"=>$this->coneccion->affected_rows);
				}else{
					$respuesta = array("codigo"=>'0',"mensaje"=>"No realizo el insert : ".$this->coneccion->error);	
				}	
			}else{
				$respuesta = array("codigo"=>'0',"mensaje"=>"Ocurrio un error al realizar el insertar: $sql ".$this->coneccion->error);	
			}
		}else{
			$respuesta = array("codigo"=>'0',"mensaje"=>"El arreglo de ingreso viene vacio");
		}
		return $respuesta;
	}
	//actualizar tuplas usa el metodo restricciones,
	function actualizar($variables,$limitantes,$tabla){
		$sql = "UPDATE $tabla SET ";
		foreach ($variables as $clave => $valor) {
			$sql .= "$clave = ";
			if($valor=="")
				$sql .="NULL, ";
			else
				$sql .="'".verificar_texto($valor)."', ";
		}
		$sql = substr($sql, 0, -2);
		if(count($limitantes)>0)
			$sql .= $this->restricciones($limitantes);
		
		if($this->coneccion->query($sql)){
			if($this->coneccion->affected_rows>0){
				$respuesta = array("codigo"=>'1',"mensaje"=>$this->coneccion->affected_rows);
			}else{
				$respuesta = array("codigo"=>'2',"mensaje"=>"No afecto registros: ".$this->coneccion->error);	
			}	
		}else{
			$respuesta = array("codigo"=>'0',"mensaje"=>"Ocurrio un error al realizar la actualizacion: $sql".$this->coneccion->error);	
		}
		return $respuesta;	
	}
	//se utiliza para eliminar tuplas de la base de datos, usa el metodo restricciones
	function eliminar($limitantes,$tabla){
		$sql = "DELETE FROM $tabla";

		if(count($limitantes)>0)
			$sql .= $this->restricciones($limitantes);
		
		if($this->coneccion->query($sql)){
			if($this->coneccion->affected_rows>0){
				$respuesta = array("codigo"=>'1',"mensaje"=>$this->coneccion->affected_rows);
			}else{
				$respuesta = array("codigo"=>'0',"mensaje"=>"No afecto registros eliminacion: ".$this->coneccion->error);	
			}	
		}else{
			$respuesta = array("codigo"=>'0',"mensaje"=>"Ocurrio un error al realizar el eliminar: $sql".$this->coneccion->error);	
		}
		return $respuesta;
	}
	function seleccionar($seleccion,$limitantes,$tablas){			
		$sql = "SELECT ";
		foreach ($seleccion as $valor) {
			$sql .= "$valor, ";
		}
		$sql = substr($sql, 0, -2);
		$sql .= " FROM ";
		foreach ($tablas as $valor) {
			$sql .= "$valor, ";
		}
		$sql = substr($sql, 0, -2);

		if(count($limitantes)>0)
			$sql .= $this->restricciones($limitantes);
	
		if($this->referencia != "" and $this->forma != "")
			$sql .= " ORDER BY ".$this->referencia." ".$this->forma;
		if($this->cantidad>0){
			$sql.=" limit ".$this->cantidad;
		}
		$exe = $this->coneccion->query($sql);
		if($exe){
			if($exe->num_rows>0){
				
				for($i=0;$i<$exe->num_rows;$i++){
					$data = $exe->fetch_array();
					$datos[$i]=$data;
				}
				//$respuesta = array("codigo"=>'2', "mensaje"=>$datos);
				$respuesta = array("codigo"=>'1', "mensaje"=>$datos);
			}else{
				$respuesta = array("codigo"=>'2', "mensaje"=>"No hay registros"." QUERY: $sql ");	
			}	
		}else{
			$respuesta = array("codigo"=>'0', "mensaje"=>"Ocurrio un error al realizar el query: $sql ".$this->coneccion->error);	
		}
		return $respuesta;	
	}
	function ejecutar_query($sql){
		$exe = $this->coneccion->query($sql);
		if(!$exe){
			return "error".$this->coneccion->error;
		}else{
			return $exe;
		}
	}
}
?>