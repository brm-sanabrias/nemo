var numPag=0;
//Pintamos check sobre web seleccionadas
$(document).on('click',  '.screen' , function () {
	 if ( $('.mdi-navigation-check', this).hasClass('hide') ) {
	 	console.log("entre");
		$('.mdi-navigation-check', this).addClass('animated bounceIn');
		$('.mdi-navigation-check', this).removeClass('hide');
		$('.mostrar-keyb').addClass('disabled');
		numPag++;
		var porc=parseFloat(numPag*(2/10));
		pintarProg(barraProgreso, porc, barraText);
		if(!$('.continuar-bottom').hasClass('blue')){
			$('.continuar-bottom').removeClass('orange darken-4').addClass('blue').html('Terminé <i class="right mdi-navigation-arrow-forward"></i>')};
	}else{
		numPag--;
		var porc=parseFloat(numPag*(2/10));
	
		pintarProg(barraProgreso, porc, barraText);
		$('.mdi-navigation-check', this).removeClass('bounceIn');
		$('.mdi-navigation-check', this).addClass('hide');
	};
	if ($('.screen .hide').length == $('.mdi-navigation-check').length ) {
		$('.continuar-bottom').removeClass('blue').addClass('orange darken-4').html('No tengo sitio web <i class="right mdi-navigation-close"></i>');
		$('.mostrar-keyb').removeClass('disabled');
	};
});

$(document).on('click', '.mostrar-keyb', function(e) {
		$(this).addClass('disabled');
		$(".mask").addClass('animated flipOutX');
		window.setTimeout(function() {
			$(".mask").addClass('hide');
			$(".ingresar-url").removeClass('hide');
			$('.keyboard-input').focus();
		}, 500);
		$(".ingresar-url").addClass('flipInX');
		$(this).parent().parent().addClass('hide');
});
$(document).on('click', '.continuaruno', function(event) {
	event.preventDefault();
	/* Act on the event */
	var selector = $('.mdi-navigation-check');
	var webs = new Array();
	for (var i = 0; i < selector.length; i++) {
		if ($(selector[i]).hasClass('hide')){
		}else{
			var web=$(selector[i]).parent().siblings('p').text();
			var split = web.split("'");
			webs.push(split[1]);
		}
	} 
	if (webs.length >0) {
		webss=JSON.stringify(webs);
		$.ajax({
		url:'saveData.php',
		dataType:'json',
		type:'POST',
		data:{data:webss},
		succes:function(data){
			console.log(data);
			$('.mask').hide();
			$('.analytics').show();
		//	window.location="graphs.php";
		}
	}).done(function(){
		$('.mask').hide();
		$('.ingresar-url').hide();
		$('.botonera').hide();
	
		var formulario =$('#analytics');
		$(formulario).prepend();
		for (var i = 0; i < webs.length; i++) {
			
			
			if ( webs.length == 1 ) {
				
				
				$(formulario).append('<div class="col l12"><div class="card card-panel"><div class="row"><div class="input-field "><i class="mdi-action-account-circle prefix"></i><input type="hidden" value="'+webs[i]+'"><input type="text" name="usuario" class="validate keyboard-input"><label for="usuario">Usuario '+webs[i]+'</label></div></div><div class="row"><div class="input-field "><i class="mdi-action-lock-outline prefix"></i><input type="text" name="pass" class="validate keyboard-input pass"><label for="pass">Contraseña</label></div></div></div></div>');
				
			}else if ( webs.length == 2 ){
				
					$(formulario).append('<div class="col l6"><div class="card card-panel"><div class="row"><div class="input-field "><i class="mdi-action-account-circle prefix"></i><input type="hidden" value="'+webs[i]+'"><input type="text" name="usuario" class="validate keyboard-input"><label for="usuario">Usuario '+webs[i]+'</label></div></div><div class="row"><div class="input-field "><i class="mdi-action-lock-outline prefix"></i><input type="text" name="pass" class="validate keyboard-input pass"><label for="pass">Contraseña</label></div></div></div></div>');
				
			}else if ( webs.length == 3 ){
				$(formulario).append('<div class="col l4"><div class="card card-panel"><div class="row"><div class="input-field "><i class="mdi-action-account-circle prefix"></i><input type="hidden" value="'+webs[i]+'"><input type="text" name="usuario" class="validate keyboard-input"><label for="usuario">Usuario '+webs[i]+'</label></div></div><div class="row"><div class="input-field "><i class="mdi-action-lock-outline prefix"></i><input type="text" name="pass" class="validate keyboard-input pass"><label for="pass">Contraseña</label></div></div></div></div>');
			}else if( webs.length >= 4 ){
				
				$(formulario).append('<div class="col l6"><div class="card card-panel"><div class="row"><div class="input-field "><i class="mdi-action-account-circle prefix"></i><input type="hidden" value="'+webs[i]+'"><input type="text" name="usuario" class="validate keyboard-input"><label for="usuario">Usuario '+webs[i]+'</label></div></div><div class="row"><div class="input-field "><i class="mdi-action-lock-outline prefix"></i><input type="text" name="pass" class="validate keyboard-input pass"><label for="pass">Contraseña</label></div></div></div></div>');
				
			}
		
			
		};
			//$(formulario).append('<div class="row"><div class="input-field col l12"><button type="submit" name="" class="btn green waves-effect waves-light right"><i class="mdi-content-send"></i></button></div></div>');
			$('.analytics').removeClass('hide').show();
		
	});
	}else{
		window.location="graphs.php";
	}
	//
});
$(document).on('click','.continuar',function(){
	if (!$(this).hasClass('continuaruno')) {
		var webs = new Array();
		var linea='';
		$('form#analytics :input').each(function(index){
			var nom=''; // estoy buscando el poruqe no agrega el nombre del arreglo dinamicamente
			if ($(this).attr('type')=='hidden') {
			
				linea+=':)'+$(this).val();
			}else{
				linea+=':('+$(this).val();
			}
		});
		console.log(linea);
		$.ajax({
			url:'saveData.php',
			dataType:'json',
			type:'POST',
			data:{
				analytics:linea
			},
			success:function(data){
				window.location="graphs.php";
			}
		});
		
		//window.location="graphs.php";
	}
	
});