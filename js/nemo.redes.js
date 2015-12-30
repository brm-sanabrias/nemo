var Selection = new Array();
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
	   		selectFacebook(id);
	   		if(!$('.continuar').hasClass('blue'))
	   			$('.continuar').removeClass('orange darken-4').addClass('blue').html('Terminé <i class="right mdi-navigation-arrow-forward"></i>');
   		}else{
	   		unselectFacebook(id);
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
					//console.log(val.picture.data.url)
					Selection.push(val);
					//console.log($('.netbox-fb > img').length)
					if($('.netbox-fb > img').length<=6){
						$('.netbox-fb').append($('<img>',{class:'marca-seleccionada',src:val.picture.data.url}))
					}
				}	 
			});
		});
	}else{
		Selection.push('N/A');
	}

	/*$tituloRedes.html(' <h3>Twitter</h3>');
	$noTengo.attr('onclick','selectTwitter()');
	$.getJSON( "search/results/resultTwitter.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$.each(data, function(index, val) {
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id +'" onclick="selectTwitter('+val.id+')"><figure><img src="'+val.profile_image_url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.screen_name + '</span></li>');
			}
		
		});
	});*/
}
function unselectFacebook(fbId){
	console.log("unselectFacebook");
}
function selectTwitter(twId){
	if(twId!=""){
		$.getJSON( "search/results/resultTwitter.json", function( data ) {
			$.each(data, function(index, val) {
				if(val.id==twId){
					Selection.push(val);
				}	 
			});
		});
	}else{
		Selection.push('N/A');
	}
	$tituloRedes.html('<h3>Youtube</h3>');
	$noTengo.attr('onclick','endSteps();');
	$.getJSON( "search/results/resultYoutube.json", function( data ) {
		$marcasSuge.html('');
		$.each(data.items, function(index, val) {
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id.channelId +'" onclick="selectYoutube(\''+val.id.channelId+'\')"><figure><img src="'+val.snippet.thumbnails.default.url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.snippet.title + '</span></li>');
			 /* iterate through array or object */
			}
		});
	});
}
function selectYoutube(ytId){
	if(ytId!=""){
		$.getJSON( "search/results/resultYoutube.json", function( data ) {
			$marcasSuge.html('');
			$.each(data.items, function(index, val) {
				if(val.id.channelId==ytId){
					Selection.push(val);
				}
			});
		});	
	
		setTimeout(function(){ 	endSteps();}, 1000);
	}else{
		Selection.push('N/A');
	}

}
function endSteps(){
	var SelectionSerialize = JSON.stringify( Selection );
	$.ajax({
		url: 'saveData.php',
		type: 'POST',
		data: {datos:SelectionSerialize}
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
};

