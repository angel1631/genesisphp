$(document).ready(function(){
	var estado_menu = 0;
	$(".invoca-menu").click(function(){
		if(estado_menu==0){
			$("nav").css("display","block");
			estado_menu = 1;
		}else{
			$("nav").css("display","none");
			estado_menu = 0;
		}
		
	});
	profundidad_menu = 0;
	count_profundo = 0;
	ultimo = "";
	$(".listado_opciones").click(function(){
		if($(this).children(ultimo))
		valor = $(this).attr("nivel");
		if(valor == 1){
			$(this).children(".listado_opciones").css("background","rgb(175,225,90)");
		}else{
			$(this).children(".listado_opciones").css("background","rgb(151,202,65)");
		}
		$(this).children(".listado_opciones").css("display","block");
		

	});
});