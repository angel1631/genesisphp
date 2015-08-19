$(document).ready(function(){
	var root = document.location.hostname;
	var db_ac 	= "";
	var tb_ac 	= "";

	var destino 	= "";
	puntero_act = "";
	$("body").on("click",".boton_buscar",function(){
		var padre 		= $(this).parent().parent();
		var activador	= $(this).parent();

		$(".contenedor_buscador").css("display","block");
		if(padre.attr("tb")!=""){
			tb_ac 	= padre.attr("tb");
			db_ac	= activador;
			$.ajax({
				type: 'POST',
				url: 'http://'+root+'/modulos/buscador/vista.html',
				success: function(res){
					res = res.replace("Titulo Buscador", "Buscador de "+tb_ac);
					$(".contenedor_buscador").html(res);
				}
			});
		}
	});
	$("body").on("click",".boton_eliminar",function(){
		$(this).parent().remove();
	});
	$("body").on("click",".contenedor_buscador .cerrar", function(){
		$(this).parent().html("");
		$(".contenedor_buscador").css("display","none");
	});
	$("body").on("click",".boton_ejecutar_busqueda", function(){
		$.ajax({
			type: 'POST',
			url: 'http://'+root+'/modulos/'+tb_ac+'/controlador.php',
			dataType: 'json',
			data: {tb: tb_ac, texto: $(".txt_buscar").val(), acc: '4'},
			success: function(res){
				if(res.codigo==1){
					$(".resultado_busqueda").html(res.mensaje);
				}else 
					alert(res.mensaje);
			}
		});
	});
	$("body").on("change",".codigo_foraneo",function(){
		traer_titulo_foraneo($(this));
	});
	function traer_titulo_foraneo(puntero){	
		tb_ac 				= puntero.parent().parent().attr("tb");
		var texto_ac 		= puntero.parent().children(".descripcion-codigo");
		$.ajax({
			type: 'POST',
			url: 'http://'+root+'/modulos/'+tb_ac+'/controlador.php',
			dataType: 'json',
			data: {codigo: puntero.val(), acc: '5'},
			success: function(res){
				if(res.codigo==1){
					texto_ac.html(res.mensaje);
				}else if(res.codigo==0){
					alert(res.mensaje);
				}		
			}
		});
	}
	$("body").on("click",".linea_busqueda", function(){
		var codigo 		= $(this).children(".cod").html();
		var descripcion = $(this).children(".texto").html();
		db_ac.children(".codigo").val(codigo);
		
		if(db_ac.children(".descripcion-codigo").length)
			db_ac.children(".descripcion-codigo").html(descripcion);
		else
			traer_datos_formulario(destino.parent().parent().parent());	
		$(".contenedor_buscador").html("");
		$(".contenedor_buscador").css("display","none");
	});

	$("body").on("change",".codigo_principal",function(){
		traer_datos_formulario($(this).parent().parent().parent());
	});
	
	function traer_datos_formulario(puntero){
		arr_datos 	= [];
		tb_ac 		= puntero.attr("tb");
		cod 		= puntero.children(".form-group").children(".con_codigo").children(".codigo").val()
		
		puntero.children(".form-group").each(function(){
			dato = $(this).children(".dato").children(".data"); 
			if(dato.length)
				arr_datos.push(dato.attr("id"));
		});
		
		$.ajax({
			type: 'POST',
			url: 'http://'+root+'/modulos/'+tb_ac+'/controlador.php',
			dataType: 'json',
			data: {estructura: arr_datos, codigo: cod, acc: '6'},
			success: function(res){
				if(res.codigo==1){
					mensaje = res.mensaje[0];
					puntero.children(".form-group").each(function(){
						if($(this).children(".dato").children(".data")){
							dato = $(this).children(".dato").children(".data"); 
							dato.val(res.mensaje[0][dato.attr("id")]) ;	
						}
					});
					if(typeof(mensaje['foraneo_multiple']) != "undefined"){
						for(j=0;j<mensaje['foraneo_multiple'].length;j++){
							tb = mensaje['foraneo_multiple'][j]['tb'];
							puntero.children(".foranea-multiple").each(function(){
								if($(this).attr("tb")==tb){
									foranea = $.map(mensaje['foraneo_multiple'][j], function(value, index) {
    												return [value];
    											});
									for(i=0;i<(foranea.length-1);i++){
										agregar_linea_foranea($(this),foranea[i][0]);
									}		
								}
							});	
						}
					}	
					puntero.children(".form-group").each(function(){
						if($(this).children(".linea-foranea").children(".codigo_foraneo").length){
							traer_titulo_foraneo($(this).children(".linea-foranea").children(".codigo_foraneo"));
						}
					});
				}else{
					alert(res.mensaje);
				}
			}
		});
	}
	$("body").on("click",".agregar_linea_foranea",function(){
		var padre = $(this).parent();
		agregar_linea_foranea(padre);
	});
	function agregar_linea_foranea(puntero,codigo){
		var codigo = typeof codigo !== 'undefined' ? codigo : "";
		$.ajax({
			type: 'POST',
			url: 'http://'+root+'/esqueletos_generales/linea_foranea.html',
			success: function(res){
				puntero.append(res);
				if(codigo != ""){
					puntero.children(".linea-foranea-multiple").last().children(".codigo_foraneo").val(codigo);
					traer_titulo_foraneo(puntero.children(".linea-foranea-multiple").last().children(".codigo_foraneo"));	
				}
			},error: function(){
				alert("error en pagina referencia");
			}
		});
	}
});