<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	Class vista_producto{
		private $categoria, $cantidad, $estilo, $precio, $orden, $esqueleto_producto, $productos, $salida, $cdb;

		function __construct($categoria = "", $cantidad = "", $estilo = "vertical", $precio = "si", $orden =""){
			$this->categoria	= $categoria;
			$this->cantidad 	= $cantidad;
			$this->estilo 		= $estilo;
			$this->precio 		= $precio;
			$this->orden 		= $orden;
			$this->estilo 		= $estilo;
			$this->cdb 			= new base();
		}
		function traer_vista_miniatura(){
			$rs = traer_productos($this->cantidad,$this->categoria,$this->orden);
			if($this->estilo=="vertical"){
				$this->abrir_archivo("$_SERVER[DOCUMENT_ROOT]/modulos/producto/vista/esqueleto_vertical.html");
			}
			if($rs['codigo']==1){
				$this->crear_productos($rs['mensaje']);
				$this->agregar_imagen_producto();
				$this->crear_vista_productos_miniatura();
				$respuesta = $this->crear_vista_final();
			}else
				$respuesta = "Error al traer productos".$rs['mensaje'];
			
			return $respuesta;
		}
		function traer_vista_grande($id){
			$this->abrir_archivo("$_SERVER[DOCUMENT_ROOT]/modulos/producto/vista/esqueleto_grande.html");
			$rs = traer_productos("","","",$id);
			if($rs['codigo']==1){
				$this->crear_productos($rs['mensaje']);
				$this->agregar_imagen_producto();
				$this->crear_vista_producto_grande();
				$respuesta = $this->crear_vista_final();
			}else 
				$respuesta = "Error al traer productos".$rs['mensaje'];
			
			return $respuesta;
		}
		function abrir_archivo($direccion){
			$archivo = fopen($direccion, "r");
			$str_archivo= "";
			if(!$archivo===false){
				while(!feof($archivo)) {
					$linea = fgets($archivo);
					$str_archivo .=$linea;
				}
				fclose($archivo);
			}
			$this->esqueleto_producto =  $str_archivo;
		}
		
		function crear_productos($productos){
			$datos = $productos;
				for($i=0;$i<count($productos);$i++)
					$this->productos[]	= new Producto($datos[$i]['id'],$datos[$i]['codigo'],$datos[$i]['titulo'],$datos[$i]['descripcion'],$datos[$i]['marca'],$datos[$i]['modelo'],$datos[$i]['categoria'],$datos[$i]['precio']);
		}
		function crear_vista_productos_miniatura(){

			for($i=0;$i<count($this->productos);$i++){
				$str_producto = $this->esqueleto_producto;
				$str_producto = str_replace("id_producto", encripta($this->productos[$i]->id), $str_producto);
				$str_producto = str_replace("Titulo Producto", $this->productos[$i]->titulo, $str_producto);
				$str_producto = str_replace("Informacion Producto", $this->productos[$i]->descripcion, $str_producto);
				$str_producto = str_replace("Imagen Principal", $this->crear_string_imagen($this->productos[$i]), $str_producto);
				$str_producto = str_replace("Precio Producto", "Q. ".number_format($this->productos[$i]->precio, 2, '.', ','), $str_producto);
				
				$this->productos[$i]->set_vista($str_producto);
			}
		}
		function crear_vista_producto_grande(){

			for($i=0;$i<count($this->productos);$i++){
				$str_producto = $this->esqueleto_producto;
				$str_producto = str_replace("id_producto", desencripta($this->productos[$i]->id), $str_producto);
				$str_producto = str_replace("Titulo Producto", $this->productos[$i]->titulo, $str_producto);
				$str_producto = str_replace("Codigo Producto", $this->productos[$i]->codigo, $str_producto);
				$str_producto = str_replace("Marca Producto", $this->productos[$i]->marca, $str_producto);
				$str_producto = str_replace("Modelo Producto", $this->productos[$i]->modelo, $str_producto);
				$str_producto = str_replace("Detalle Producto", $this->productos[$i]->descripcion, $str_producto);
				
				$str_producto = str_replace("Precio Producto", "Q. ".number_format($this->productos[$i]->precio, 2, '.', ','), $str_producto);
				$str_producto = str_replace("Imagen Principal", $this->crear_string_imagen($this->productos[$i]), $str_producto);
				$this->productos[$i]->set_vista($str_producto);
			}
		}
		function crear_string_imagen($producto){
			$str_imagen = "";
			for($j=0;$j<count($producto->imagenes);$j++)
				$str_imagen .= "<img src='".$producto->imagenes[$j]['url']."' alt=\"".$producto->imagenes[$j]['titulo']."\" />";
			
			return $str_imagen;
			
		}
		function agregar_imagen_producto(){
			for($j=0;$j<count($this->productos);$j++)
				$this->traer_imagenes($this->productos[$j]);
		}
		function traer_imagenes($producto){
			$seleccion 		= array("i.titulo","i.url");
			$limitantes 	= array(array("","pi.estatus","=","1"),array("and","pi.producto","=",$producto->id),array("and","pi.imagen","=","i.id"));
			$tabla			= array("producto_imagen as pi","imagen as i");
			$respuesta = $this->cdb->seleccionar($seleccion,$limitantes,$tabla);
			if($respuesta['codigo']==1)
				$producto->set_imagenes($respuesta['mensaje']);
		}
		function crear_vista_final(){
			$string_salida = "";	
			for($i=0;$i<count($this->productos);$i++)
				$string_salida .=$this->productos[$i]->vista;
			 
			return $string_salida;
		}
	}
	Class Producto{
		public $vista, $id, $titulo, $descripcion, $marca, $modelo, $categoria, $precio, $imagenes;
		function __construct($id, $codigo, $titulo, $descripcion, $marca, $modelo, $categoria, $precio){
			$this->id 			= $id;
			$this->codigo		= $codigo;
			$this->titulo 		= $titulo;
			$this->descripcion 	= $descripcion;
			$this->marca 	 	= $marca;
			$this->modelo 		= $modelo;
			$this->categoria 	= $categoria;
			$this->precio 		= $precio;
		}
		function set_imagenes($ar){
			$this->imagenes = $ar;
		}
		function set_vista($string){
			$this->vista = $string;
		}
	}
	function traer_productos($cantidad = "", $categoria = "", $orden = "", $id = ""){
		$cdb = new base();
		$seleccion = array("p.id", "p.codigo", "p.titulo", "p.descripcion", "m.titulo marca", "p.modelo", "p.categoria", "p.precio");
		$limitantes[] = array("","p.estatus","=","1");
		$limitantes[] = array("and","p.marca","=","m.id");
		if($categoria!="")
			$limitantes[] = array("and","p.categoria","=",$categoria);
		if($id!="")
			$limitantes[] = array("and","p.id","=",$id);
		if($orden!="")
			$cdb->set_referencia($this->orden);
		if($cantidad!="")
			$cdb->set_cantidad($this->cantidad);
		
		$tabla = array("producto p","marca m");
		$respuesta = $cdb->seleccionar($seleccion,$limitantes,$tabla);
		return $respuesta;
	}
?>