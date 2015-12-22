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
			 		$marcasSuge.append('<li class="marca" id="'+ val.id +'" onclick="selectFacebook('+val.id+')"><figure><img src="'+val.picture.data.url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.name + '</span></li>')
				 
			 }
		});
	});
});

function selectFacebook(fbId){
	if(fbId!=""){
		$.getJSON( "search/results/resultFacebook.json", function( data ) {
			$.each(data.data, function(index, val) {
				if(val.id==fbId){
					Selection.push(val);
				}	 
			});
		});
	}else{
		Selection.push('N/A');
	}
	$tituloRedes.html(' <h3>Twitter</h3>');
	$noTengo.attr('onclick','selectTwitter()');
	$.getJSON( "search/results/resultTwitter.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$.each(data, function(index, val) {
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id +'" onclick="selectTwitter('+val.id+')"><figure><img src="'+val.profile_image_url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.screen_name + '</span></li>');
			}
		
		});
	});
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
	
}