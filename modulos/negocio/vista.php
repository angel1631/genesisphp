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
<h1>Administracion Negocios</h1>
<div class="cf form-horizontal" tb="negocio" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="negocio" >
		<label class="col-sm-2 control-label">Codigo de Negocio: </label>
		<div class="col-sm-2 con_codigo">
			<input type="text" class="form-control codigo codigo_principal" >
		</div>
		<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo del negocio: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" id="titulo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Descripcion</label>
		<div class="col-sm-10 dato">
			<textarea class="data form-control" id="descripcion"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Direccion: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" id="direccion">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Horarios: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" id="horarios">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Telefonos: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" id="telefonos">
		</div>
	</div>
	<div class="form-group foranea-multiple" tb="categoria" >
		<div class="agregar_linea_foranea">Agregar</div>
		<label class="col-sm-2 control-label">Categorias: </label>
	</div>

	<div class="boton_ejecutar btn btn-primary btn-lg btn-block" id="boton_ejecutar_categoria">
		Ejecutar
	</div>
</div>	