<?php 
	if(isset($_POST['acc'])){
		$acc = $_POST['acc'];
		//este switch sera para agregar accesos 
		switch ($acc) {
			case '2':
				# code...
				
				break;
			
			default:
				# code...
				break;
		}
	}else{
		echo "Error no existe opcion";
		exit;
	}
?>
<h1>Administracion Productos</h1>
<div class="cf form-horizontal" tb="producto" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="producto" >
		<label class="col-sm-2 control-label">Codigo de producto: </label>
		<div class="col-sm-10 con_codigo">
			<input type="text" class="form-control codigo codigo_principal" >
			<div class="boton_buscar btn btn-default col-sm-2">Buscar</div>
		</div>
		
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Codigo Interno: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="titulo_categoria"  id="codigo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="titulo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Descripcion: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="descripcion">
		</div>
	</div>
	<div class="form-group" tb="marca" >
		<label class="col-sm-2 control-label">Marca: </label>
		<div class="linea-foranea dato col-sm-10">
			<input type="text" class="data col-sm-2 codigo codigo_foraneo" id="marca">
			<label class="descripcion-codigo control-label col-sm-8"></label>
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Modelo: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="modelo">
		</div>
	</div>
	
	<div class="form-group" tb="categoria" >
		<label class="col-sm-2 control-label">Categoria: </label>
		<div class="linea-foranea dato col-sm-10">
			<input type="text" class="data col-sm-2 codigo codigo_foraneo" id="categoria">
			<label class="descripcion-codigo control-label col-sm-8"></label>
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
	</div>
	<div class="form-group foranea-multiple" tb="imagen" >
		<div class="agregar_linea_foranea btn btn-default">Agregar</div>
		<label class="control-label">Imagenes: </label>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Precio: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="precio">
		</div>
	</div>
	<div class="boton_ejecutar btn btn-primary btn-lg btn-block" id="boton_ejecutar">
		Ejecutar
	</div>
</div>	