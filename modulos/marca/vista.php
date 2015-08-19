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
<h1>Administracion Marca</h1>
<div class="cf form-horizontal" tb="marca" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="marca" >
		<label class="col-sm-2 control-label">Codigo de marca: </label>
		<div class="col-sm-2 con_codigo">
			<input type="text" class="form-control codigo codigo_principal" >
		</div>
		<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="titulo_categoria"  id="titulo">
		</div>
	</div>
	<div class="boton_ejecutar btn btn-primary btn-lg btn-block" id="boton_ejecutar_categoria">
		Ejecutar
	</div>
</div>	