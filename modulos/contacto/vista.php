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

<div class="col-sm-12 blog-main">

	<p>Si deseas aparecer en nuestro directorio por favor escr&iacute;benos. </p>
</div>
<div class="cf form-horizontal" tb="contacto" acc="1" >
	<div class="form-group">
		<label class="col-sm-2 control-label">Nombre: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="titulo_categoria"  id="nombre">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Correo: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="correo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Telefono: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="telefono">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Consulta: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="consulta">
		</div>
	</div>
	<div class="boton_ejecutar btn btn-primary btn-lg btn-block">
		Ejecutar
	</div>
</div>	