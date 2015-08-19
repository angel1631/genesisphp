$(document).ready(function(){
	var root = document.location.hostname;
	
	acc 		= '0';
	tb_activo 	= ''; 
	pt 			= $("#pt").attr("pat");
	$(".opcion_abc").click(function(){
		acc = $(this).attr("acc");
		$.traer_vista_formulario();
	});
	$.traer_vista_formulario = function(){
		$(".formulario").load("http://"+root+"/modulos/"+pt+"/vista.php",{acc: acc},function(){
			if(acc==1)
				$(".codigo_principal").parent().parent().css("display","none");
		});
	}
	$("body").on("click",".boton_ejecutar", function(){
		cf			= $(this).parent();
		tb_activo 	= cf.attr('tb');
		if(acc=='0')
			acc = cf.attr("acc");
		var dt_json = JSON.stringify(extraer_datos_formulario(cf));
		if(acc==1){
			enviar 	= {datos: dt_json, acc: acc};	
		}else{
			if(acc==2){
				enviar = {datos: dt_json, codigo: cf.children(".form-group").children(".con_codigo").children(".codigo_principal").val(), acc: acc};
			}else{
				enviar = {codigo: cf.children(".form-group").children(".con_codigo").children(".codigo_principal").val(), acc: acc};
			}
		}
		$.ajax({
			type: 'POST',
			data: enviar,
			url: 'http://'+root+'/modulos/'+tb_activo+'/controlador.php',
			cache: false,
            contentType: false,
            processData: false,
			dataType: 'json',
			success: function(res){
				if(res.codigo==1){
					alert(res.mensaje);
					cf.parent().html("");
				}else
					alert(res.mensaje);
			}
		});
	});
	function extraer_datos_formulario(formulario){
		arr_datos 	= {};
		contenedor_foranea_multiple = {}
		y			= 0;
		formulario.children(".form-group").each(function(){
			if($(this).children(".dato").length){
				dato = $(this).children(".dato").children(".data"); 
				arr_datos[dato.attr("id")] = dato.val();	
			}else if ($(this).children(".linea-foranea-multiple").length){
				foranea_multiple 		= {};
				x 						= 0;
				foranea_multiple['tb'] 	= $(this).attr("tb");
				$(this).children(".linea-foranea-multiple").each(function(){
					if($(this).children(".codigo_foraneo").val()!=""){
						foranea_multiple[x]  = $(this).children(".codigo_foraneo").val(); 
						x++; 
					}
				});
				contenedor_foranea_multiple[y] = foranea_multiple;
				arr_datos['foranea_multiple'] = contenedor_foranea_multiple;
				y++;
			}
		});
		return arr_datos;
	}

});