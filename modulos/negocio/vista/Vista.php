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
		function traer_vista_miniatura($items = ""){
			if($items=="")
				$rs = traer_productos($this->cantidad,$this->categoria,$this->orden);
			else
				$rs = $items;

			if($this->estilo=="vertical"){
				$this->abrir_archivo("$_SERVER[DOCUMENT_ROOT]/modulos/negocio/vista/esqueleto_horizontal.html");
			}
			if($rs['codigo']==1){
				$this->crear_productos($rs['mensaje']);
				//$this->agregar_imagen_producto();
				$this->crear_vista_productos_miniatura();
				$respuesta = $this->crear_vista_final();
			}else
				$respuesta = "Error al traer productos".$rs['mensaje'];
			
			return $respuesta;
		}
		function traer_vista_grande($id){
			$this->abrir_archivo("esqueleto_grande.html");
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
			while(!feof($archivo)) {
				$linea = fgets($archivo);
				$str_archivo .=$linea;
			}
			fclose($archivo);
			$this->esqueleto_producto =  $str_archivo;
		}
		
		function crear_productos($productos){
			$datos = $productos;
				for($i=0;$i<count($productos);$i++)
					$this->productos[]	= new Producto($datos[$i]['id'],$datos[$i]['titulo'],$datos[$i]['descripcion'],$datos[$i]['direccion'],$datos[$i]['horarios'],$datos[$i]['telefonos']);
		}
		function crear_vista_productos_miniatura(){

			for($i=0;$i<count($this->productos);$i++){
				$str_producto = $this->esqueleto_producto;
				$str_producto = str_replace("id_producto", encripta($this->productos[$i]->id), $str_producto);
				$str_producto = str_replace("Titulo Producto", $this->productos[$i]->titulo, $str_producto);
				$str_producto = str_replace("Descripcion Producto", $this->productos[$i]->descripcion, $str_producto);
				$str_producto = str_replace("Direccion Producto", $this->productos[$i]->direccion, $str_producto);
				$str_producto = str_replace("Horarios Producto", $this->productos[$i]->horarios, $str_producto);
				$str_producto = str_replace("Telefonos Producto", $this->productos[$i]->telefonos, $str_producto);
				$str_producto = str_replace("Imagen Principal", $this->crear_string_imagen($this->productos[$i]), $str_producto);
				$this->productos[$i]->set_vista($str_producto);
			}
		}
		function crear_vista_producto_grande(){

			for($i=0;$i<count($this->productos);$i++){
				$str_producto = $this->esqueleto_producto;
				$str_producto = str_replace("id_producto", modifica_numero($this->productos[$i]->id), $str_producto);
				$str_producto = str_replace("Titulo Producto", $this->productos[$i]->titulo, $str_producto);
				$str_producto = str_replace("Introduccion Producto", $this->productos[$i]->introduccion, $str_producto);
				$str_producto = str_replace("Informacion Producto", $this->productos[$i]->informacion, $str_producto);
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
		public $vista, $id, $titulo, $descripcion, $direccion, $horarios, $imagenes;
		function __construct($id, $titulo, $descripcion, $direccion, $horarios,$telefonos){
			$this->id 			= $id;
			$this->titulo 		= $titulo;
			$this->descripcion 	= $descripcion;
			$this->direccion 	= $direccion;
			$this->horarios 	= $horarios;
			$this->telefonos	= $telefonos;
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
		$seleccion = array("n.id","n.titulo","n.descripcion","n.direccion","n.horarios","n.telefonos");
		$limitantes = array(array("","n.estatus","=","1"));
		if($categoria!="")
			$limitantes[] = array("and","c.id","=",$categoria);
		if($id!="")
			$limitantes[] = array("and","id","=",$id);
		if($orden!="")
			$cdb->set_referencia($this->orden);
		if($cantidad!="")
			$cdb->set_cantidad($this->cantidad);
		
		$tabla = array("negocio n INNER JOIN negocio_categoria nc ON n.id = nc.negocio INNER JOIN categoria c ON nc.categoria = c.id");
		$respuesta = $cdb->seleccionar($seleccion,$limitantes,$tabla);
		return $respuesta;
	}
?>