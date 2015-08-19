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
<h1>Administracion Slide Show</h1>
<div class="cf form-horizontal" tb="slideshow" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="slideshow" >
		<label class="col-sm-2 control-label">Codigo de Banner: </label>
		<div class="col-sm-10 con_codigo">
			<input type="text" class="col-sm-8 form-control codigo codigo_principal" >	
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
		
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo de Banner: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" id="titulo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Posicion a mostrar: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" id="posicion">
		</div>
	</div>
	
	<div class="form-group" tb="imagen" >
		<label class="col-sm-2 control-label">Imagen: </label>
		<div class="linea-foranea dato">
			<input type="text" class="data form-control codigo codigo_foraneo" id="imagen">
			<label class="descripcion-codigo control-label"></label>
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
	</div>

	<div class="boton_ejecutar btn btn-primary btn-lg btn-block" id="boton_ejecutar_categoria">
		Ejecutar
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var root = document.location.hostname;
		
		$("body").on("change",".codigo_principal",function(){
			$.ajax({
				type: 'post',
				url: 'http://'+root+'/genesis_bazar/modulos/categoria/controlador.php',
				dataType: 'json',
				data: {acc: '7', codigo: $(this).val()},
				success: function(res){
					if(res.codigo==1)
						$("#url_pagina").val("http://"+root+"/index.php/productos/?ct="+res.mensaje);
					else
						res.mensaje
				}
			})
		});
	});
</script>	