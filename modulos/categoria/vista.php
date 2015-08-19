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
<h1>Administracion Categoria</h1>
<div class="cf form-horizontal" tb="categoria" acc=<?php echo "\"".$acc."\""; ?>>
	
	<div class="form-group" tb="categoria" >
		<label class="col-sm-2 control-label">Codigo de categoria: </label>
		<div class="col-sm-10 con_codigo">
			<input type="text" class="col-sm-8 form-control codigo codigo_principal" >	
			<div class="boton_buscar btn btn-default col-sm-1">Buscar</div>
		</div>
		
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Titulo de la categoria: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="titulo_categoria"  id="titulo">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Url pagina: </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" ntb="imagen_categoria"  id="url_pagina">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Url imagen: </label>
		<div class="col-sm-10 dato">
			<input type="text" class="data form-control" ntb="imagen_categoria"  id="imagen">
		</div>
	</div>
	<div class="form-group" tb="categoria" >
		<label class="col-sm-2 control-label">Categoria padre: </label>
		<div class="linea-foranea dato">
			<input type="text" class="data form-control codigo codigo_foraneo" id="padre">
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
				url: 'http://'+root+'/modulos/categoria/controlador.php',
				dataType: 'json',
				data: {acc: '7', codigo: $(this).val()},
				success: function(res){
					if(res.codigo==1)
						$("#url_pagina").val("http://"+root+"/contenedores/productos/?ct="+res.mensaje);
					else
						res.mensaje
				}
			})
		});
	});
</script>