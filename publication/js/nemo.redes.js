var Selection = new Array();
var flag=0; //(0: Facebook , 1: Twitter , 2: Youtube)
var numMarcas=0;
$marcasSuge=$('.marcas-sugerencias');
$tituloRedes=$('.redes_sociales2');
$noTengo=$('.no-tengo');
jQuery(document).ready(function($) {
	
	$.getJSON( "search/results/resultFacebook.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$noTengo.attr('onclick','selectFacebook()');
		$.each(data.data, function(index, val) {
			 if(index<=5){
				var likes=numeral(val.likes).format('0.00a');
				$marcasSuge.append('<li class="marca"  id="'+ val.id +'"><figure><span class="mdi-navigation-check hide"></span><img src="'+val.picture.data.url+'"  alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><p class="user"><span>'+ val.name + '</span><span class="num">'+likes+'</span></p></li>');
			 }
		});
		$('.continuar').attr('onclick','finishFacebook()');

	});
	//cambio de click para hacer reveal card//
   	$(document).on('click', '.mostrar-keyb', function(e) {
   			$(this).addClass('disabled');
   		    $(this).parent().find('.card-panel').css('overflow', 'hidden');
   		    $(this).parent().find('.card-reveal').css({ display: 'block'}).velocity("stop", false).velocity({translateY: '-100%'}, {duration: 300, queue: false, easing: 'easeInOutQuad'});		    
   		    $(this).parent().find('.card-reveal input').focus();
   	});
	// Pintamos check sobre marcas seleccionadas
   	$(document).on('click',  '.marca' , function () {
   		var id=$(this).attr('id');
   		if ( $('.mdi-navigation-check', this).hasClass('hide') ) {
			$('.mdi-navigation-check', this).addClass('animated bounceIn');
	   		$('.mdi-navigation-check', this).removeClass('hide');
	   		$('.mostrar-keyb').addClass('disabled');
	   		//Lanzamos la funcion de selección
	   		switch(flag){
   				case 0:
	   				selectFacebook(id);
   				break;
   				case 1:
	   				selectTwitter(id);
   				break;
   				case 2:
	   				selectYoutube(id);
   				break;
   			}
	   		if(!$('.continuar').hasClass('blue'))
	   			$('.continuar').removeClass('orange darken-4').addClass('blue').html('Terminé <i class="right mdi-navigation-arrow-forward"></i>');
   		}else{
	
	   		switch(flag){
   				case 0:
	   				unselectFacebook(id);
   				break;
   				case 1:
	   				unselectTwitter(id);
   				break;
   				case 2:
	   				unselectYoutube(id);
   				break;
   			}
   			$('.mdi-navigation-check', this).removeClass('bounceIn');
	   		$('.mdi-navigation-check', this).addClass('hide'); 		
   		};
   		if ($('.marca .hide').length == $('.mdi-navigation-check').length ) {
   			$('.continuar').removeClass('blue').addClass('orange darken-4').html('No tengo cuenta aquí <i class="right mdi-navigation-close"></i>');
	   		$('.mostrar-keyb').removeClass('disabled');
   		};

   	});
});
function drawIcon(){
		var sn="";
		//console.log(flag);
		console.log(numMarcas);


		switch(flag) {
			case 0:
				sn="fb";
			break;
			case 1:
				sn="tw";
			break;
			case 2:
				sn="yt";
			break;
		}

		switch(numMarcas) {
		case 1:
			$('.netbox-'+sn+' > .marca-seleccionada').removeAttr("style");
			if(flag==0){
				$('.netbox-'+sn+' > .marca-seleccionada').css('max-width', '100%');
			}
			if(flag==1 || flag==2){
				$('.netbox-'+sn+' > .marca-seleccionada').css('max-width', '50%');

			}
		break;
		case 2:
			$('.netbox-'+sn+' > .marca-seleccionada').removeAttr("style");
			if(flag==0){
				$('.netbox-'+sn+' > .marca-seleccionada').css('max-width', '100%');
			}
			if(flag==1 || flag==2){
				$('.netbox-'+sn+' > .marca-seleccionada').css('max-width', '50%');

			}
			$('.netbox-'+sn+' > .marca-seleccionada:first-child').css({
				marginLeft: '-3.6rem'
			});

		break;
		case 3:
			$('.netbox-'+sn+' > .marca-seleccionada').removeAttr("style");
			$('.netbox-'+sn).css({
				width: ' 10rem',
			});
			$('.netbox-'+sn+' > .marca-seleccionada:nth-child(3)').css('max-width', '8rem');
		break;
		case 4:
			$('.netbox-'+sn+' > .marca-seleccionada').removeAttr("style");
		break;
		}
}
function selectFacebook(fbId){
	if(fbId!=""){
		$.getJSON( "search/results/resultFacebook.json", function( data ) {
			$.each(data.data, function(index, val) {
				if(val.id==fbId){
					Selection.push(val);
					if($('.netbox-fb > img').length<=6){
						numMarcas=numMarcas+1;
						var porc=parseFloat((1/3)*(numMarcas/6));
						pintarProg(barraProgreso, porc, barraText);
						$('.netbox-fb').append($('<img>',{class:'marca-seleccionada',src:val.picture.data.url,id:val.id}))

					}
				}	 
			});
			drawIcon();
			///Pone el tamaño
			
		});
	}else{
		Selection.push('N/A');
	}
}
function unselectFacebook(fbId){
	for (i = 0; i < Selection.length; i++) {
        if (Selection[i].id == fbId) {
			//console.log(".netbox-fb >#"+Selection[i].id);
			$(".netbox-fb >#"+Selection[i].id).remove();
			numMarcas=numMarcas-1;
			var porc=parseFloat((1/3)*(numMarcas/6));
			pintarProg(barraProgreso, porc, barraText);
			drawIcon();

            Selection.splice(i,1);
        }
    }
}
function finishFacebook(){
	numMarcas=0;
	flag=1;
	$('.netbox-tw').removeClass('u-inactivo');
	$.getJSON( "search/results/resultTwitter.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$.each(data, function(index, val) {
			val.profile_image_url=val.profile_image_url.replace("_normal","");
			var followers=numeral(val.followers_count).format('0.00a');
			
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id +'"><figure><span class="mdi-navigation-check hide"></span><img src="'+val.profile_image_url+'"  alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><p class="user"><span>@'+ val.screen_name  + '</span><span class="num">'+followers+'</span></p></li>');		
						pintarProg(barraProgreso, parseFloat(1/3), barraText);
				
			}	
		});
	});
	$('.continuar').attr('onclick','finishTwitter()');

}
function selectTwitter(twId){
	if(twId!=""){
		$.getJSON( "search/results/resultTwitter.json", function( data ) {
			$.each(data, function(index, val) {
				if(val.id==twId){
					Selection.push(val);
			val.profile_image_url=val.profile_image_url.replace("_normal","");

						$('.netbox-tw').append($('<img>',{class:'marca-seleccionada',src:val.profile_image_url,id:val.id}))
										numMarcas=numMarcas+1;
						var porc=parseFloat((1/3)+((1/3)*(numMarcas/6)));
						pintarProg(barraProgreso, porc, barraText);

				}	 
			});
		drawIcon();
		
		});
	}else{
		Selection.push('N/A');
	}
	
}
function unselectTwitter(twId){
	for (i = 0; i < Selection.length; i++) {
        if (Selection[i].id == twId) {
			$(".netbox-tw >#"+Selection[i].id).remove();
			numMarcas=numMarcas-1;
			var porc=parseFloat((1/3)+((1/3)*(numMarcas/6)));
			pintarProg(barraProgreso, porc, barraText);
			drawIcon();			
            Selection.splice(i,1);
        }
    }
}
function finishTwitter(){
	flag=2;
	numMarcas=0;
	$('.netbox-yt').removeClass('u-inactivo');

	$.getJSON( "search/results/resultYoutube.json", function( data ) {
		$marcasSuge.html('');
		$.each(data.items, function(index, val) {

			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id.channelId +'"><figure><span class="mdi-navigation-check hide"></span><img src="'+val.snippet.thumbnails.default.url+'"  alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><p class="user"><span>'+ val.snippet.title  + '</span><span class="num hide">9999</span></p></li>');		
						pintarProg(barraProgreso, parseFloat(2/3), barraText);
				
			}
		});
	});
	$('.continuar').attr('onclick','endSteps()');

}
function selectYoutube(ytId){
	if(ytId!=""){
		$.getJSON( "search/results/resultYoutube.json", function( data ) {		
			$.each(data.items, function(index, val) {
				if(val.id.channelId==ytId){
					Selection.push(val);
						$('.netbox-yt').append($('<img>',{class:'marca-seleccionada',src:val.snippet.thumbnails.default.url,id:val.id.channelId}))
						numMarcas=numMarcas+1;
						var porc=parseFloat((2/3)+((1/3)*(numMarcas/6)));
						pintarProg(barraProgreso, porc, barraText);

				}
			});
			drawIcon()
		});			
	}else{
		Selection.push('N/A');
	}


}
function unselectYoutube(ytId){
	for (i = 0; i < Selection.length; i++) {
        if (Selection[i].id.channelId== ytId) {
			$(".netbox-yt >#"+Selection[i].id.channelId).remove();
			numMarcas=numMarcas+1;
			var porc=parseFloat((2/3)+((1/3)*(numMarcas/6)));
			pintarProg(barraProgreso, porc, barraText);
			drawIcon();
            Selection.splice(i,1);
        }
    }
}
function endSteps(){
						pintarProg(barraProgreso, parseFloat(3/3), barraText);
setLoader()
	var SelectionSerialize = JSON.stringify( Selection );
	$.ajax({
		url: 'saveData.php',
		type: 'POST',
		data: {datos:SelectionSerialize}
	})
	.done(function() {
		window.setTimeout(function () {
		window.location="web.php";
		console.log("success");
		},1000);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
};