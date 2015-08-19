$(document).ready(function(){
	
	$(".slide-secundario").each(function(){
		var slide_secundario = new slide_basico($(this));
		slide_secundario.iniciar(7000);
	});
	$(".slide-primario").each(function(){
		var slide_secundario = new slide_basico($(this));
		slide_secundario.iniciar(10000);
	});
	//slide = new slide_basico($(".slide-secundario"));
	//slide.iniciar();

	function slide_basico(id_contenedor,titulo,descripcion){
		var that 		= this;
		this.contenedor = id_contenedor;
		this.imagenes 	= new Array();
		this.can_imagenes = 0;
		this.img_activa = 0;
		this.con_tit	= "";
		this.con_des 	= "";
		this.titulo 	= 1;
		this.pie		= 1;
		this.espera		= 0;
		this.titulo 	= typeof(titulo) != 'undefined' ? titulo : 0;
		this.descripcion = typeof(descripcion) != 'undefined' ? descripcion : 0;
		
		this.w_contenedor = id_contenedor.width();
		this.h_contenedor = id_contenedor.width()*0.40;
		
		//iniciarlo

		this.iniciar = function(espera){
			this.espera = typeof espera !== 'undefined' ? espera : 10000;;
			if(that.titulo>0){
				var con_tit = "<div class=con_tit><label></label></div>";
				that.contenedor.html(that.contenedor.html()+con_tit);
				that.con_tit = $(".con_tit");	
			}
			if(that.descripcion>0){
				var con_des = "<div class=con_des><label></label></div>"
				that.contenedor.html(that.contenedor.html()+con_des);
				that.con_des = $(".con_des");
			}
			
			that.contenedor.children('img').each(function(){
				that.can_imagenes = that.can_imagenes + 1;
				that.imagenes.push($(this));
			});
			that.contenedor.children('img').css("max-width","100%");
			that.contenedor.children('img').css("display","none");
			
			//iniciar la rotacion
			
			that.rotar();
			setInterval(function(){
				that.rotar();
			}, this.espera);
			
		}
		this.rotar = function(){
			if(that.can_imagenes>0){
				that.imagenes[that.img_activa].css("display","none");
				that.img_activa = that.img_activa+1;
				if(that.img_activa==that.imagenes.length)
					that.img_activa = 0;
				that.imagenes[that.img_activa].fadeIn("slow");
				if(that.titulo>0)
					that.set_titulo(that.imagenes[that.img_activa].attr("title"));
				if(that.descripcion>0)
					that.set_descripcion(that.imagenes[that.img_activa].attr("alt"));	
			}
			
		}
		this.set_titulo = function(string){
			
			if(string != null){
				that.con_tit.css("display","block");
				that.con_tit.children("label").html(string);
				
			}else{
				that.con_tit.css("display","none");		
			}
		}
		this.set_descripcion = function(string){
			
			if(string != null){
				that.con_des.css("display","block");
				that.con_des.children("label").html(string);	
			}
			else{
				that.con_des.css("display","none");	
			

			}	
			
		}
	};
});