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
<h1>Administracion Menu</h1>
<div class="cf form-horizontal" tb="menu" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="menu" >
		<label class="col-sm-2 control-label">Codigo de menu: </label>
		<div class="col-sm-2 con_codigo">
			<input type="text" class="form-control codigo codigo_principal" >
		</div>
		<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control"  id="titulo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Url: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control"  id="url">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Posicion: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control"  id="posicion">
		</div>
	</div>
	<div class="form-group" tb="menu" >
		<label class="col-sm-2 control-label">Menu Padre: </label>
		<div class="linea-foranea dato col-sm-10">
			<input type="text" class="data col-sm-2 codigo codigo_foraneo" id="padre">
			<label class="descripcion-codigo control-label col-sm-8"></label>
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
	</div>
	<div class="form-group" tb="acceso" >
		<label class="col-sm-2 control-label">Acceso necesario: </label>
		<div class="linea-foranea dato col-sm-10">
			<input type="text" class="data col-sm-2 codigo codigo_foraneo" id="acceso">
			<label class="descripcion-codigo control-label col-sm-8"></label>
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
	</div>
	<div class="boton_ejecutar btn btn-primary btn-lg btn-block" id="boton_ejecutar_categoria">
		Ejecutar
	</div>
</div>	