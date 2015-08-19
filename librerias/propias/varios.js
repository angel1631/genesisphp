$('#boton_ir_arriba').click(function(){
	    $('body,html').animate({scrollTop : 0}, 500);
	    return false;
	});
	$(window).scroll(function(){

	    if ($(this).scrollTop() > 300) {
	        $('#boton_ir_arriba').fadeIn();
	    } else {
	        $('#boton_ir_arriba').fadeOut();
	    }
	});