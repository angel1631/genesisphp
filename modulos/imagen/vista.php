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
<h1>Administracion de Imagenes</h1>
<div class="cf form-horizontal" tb="imagen" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="imagen" >
		<label class="col-sm-2 control-label">Codigo de categoria: </label>
		<div class="col-sm-10 con_codigo">
			<input type="text" class="form-control codigo codigo_principal col-sm-6" >
			<div class="boton_buscar btn btn-default col-sm-2">Buscar</div>
		</div>
		
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo de imagen: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="titulo_imagen"  id="titulo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Seleccionar imagen: </label>
		<div class="col-sm-10">
			<input type="file" class="form-control" ntb="imagen"  id="archivo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Url imagen: </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" ntb="imagen_categoria"  id="url_archivo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">imagen: </label>
		<div class="col-sm-10 form-con-img" >
			<img src="" type="text" class=""  id="vista_imagen">
		</div>
	</div>
	<div class="boton_ejecutar_form_archivo btn btn-primary btn-lg btn-block" id="boton_ejecutar_categoria">
		Ejecutar
	</div>
</div>	