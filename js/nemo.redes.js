var Selection = new Array();
var flag=0; //(0: Facebook , 1: Twitter , 2: Youtube)
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
			 		//$marcasSuge.append('<li class="marca" id="'+ val.id +'" ><figure><img src="'+val.picture.data.url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.name + '</span></li>')
				$marcasSuge.append('<li class="marca"  id="'+ val.id +'"><figure><span class="mdi-navigation-check hide"></span><img src="'+val.picture.data.url+'"  alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><p class="user"><span>'+ val.name + '</span><span class="num">9999</span></p></li>');
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

function selectFacebook(fbId){
	if(fbId!=""){
		$.getJSON( "search/results/resultFacebook.json", function( data ) {
			$.each(data.data, function(index, val) {
				if(val.id==fbId){
					Selection.push(val);
					if($('.netbox-fb > img').length<=6){
						$('.netbox-fb').append($('<img>',{class:'marca-seleccionada',src:val.picture.data.url,id:val.id}))
					}
				}	 
			});
		});
	}else{
		Selection.push('N/A');
	}
}
function unselectFacebook(fbId){
	console.log("unselectFacebook");
}
function finishFacebook(){
	flag=1;
	$('.netbox-tw').removeClass('u-inactivo');
	$.getJSON( "search/results/resultTwitter.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$.each(data, function(index, val) {
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id +'"><figure><span class="mdi-navigation-check hide"></span><img src="'+val.profile_image_url+'"  alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><p class="user"><span>@'+ val.screen_name  + '</span><span class="num">9999</span></p></li>');		
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
						$('.netbox-tw').append($('<img>',{class:'marca-seleccionada',src:val.profile_image_url,id:val.id}))

				}	 
			});
		});
	}else{
		Selection.push('N/A');
	}
	
}
function unselectTwitter(twId){

}
function finishTwitter(){
	flag=2;
	$('.netbox-yt').removeClass('u-inactivo');

	$.getJSON( "search/results/resultYoutube.json", function( data ) {
		$marcasSuge.html('');
		$.each(data.items, function(index, val) {
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id.channelId +'"><figure><span class="mdi-navigation-check hide"></span><img src="'+val.snippet.thumbnails.default.url+'"  alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><p class="user"><span>'+ val.snippet.title  + '</span><span class="num">9999</span></p></li>');		
			
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

				}
			});
		});			
	}else{
		Selection.push('N/A');
	}


}
function unselectYoutube(ytId){
}
function endSteps(){
	var SelectionSerialize = JSON.stringify( Selection );
	$.ajax({
		url: 'saveData.php',
		type: 'POST',
		data: {datos:SelectionSerialize}
	})
	.done(function() {
		window.location="web.php";
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
};