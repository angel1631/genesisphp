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
});