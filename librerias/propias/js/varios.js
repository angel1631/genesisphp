
$('#enviar_suscripcion').click(function(){
	$.ajax({
		type: 'post',
		url: 'http://gtcompra.com/modulos/contacto/controlador.php',
		data: {correo: $("#correo_usuario").val(), acc: "2"},
		dataType: 'json',
		success: function(res){
			if(res.codigo=="1"){
				$(".sintio_notificacion").css("display","none");
				$.cookie('gtcompra_suscripcion','1',{expires: 365});
				alert(res.mensaje);
			}else{
				alert(res.mensaje);
			}
		}
	})
   
});
$(window).scroll(function(){
    if ($(this).scrollTop() > 300) {
    	if($.cookie('gtcompra_suscripcion')!='1')
    		$('.sintio_notificacion').fadeIn();	
    } else {
        $('.sintio_notificacion').fadeOut();
    }
});