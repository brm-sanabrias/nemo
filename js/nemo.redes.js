var Selection = new Array();
$marcasSuge=$('.marcas-sugerencias');

jQuery(document).ready(function($) {
	$.getJSON( "search/results/resultFacebook.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$.each(data.data, function(index, val) {
			 /* iterate through array or object */
			 if(index<=5){
			 	 items.push( "<li class='marca' id='" + val.id + "'>" + val.name + "</li>" );
			 }
			 $marcasSuge.append('<li class="marca" id="'+ val.id +'" onclick="selectFacebook('+val.id+')"><figure><img src="'+val.picture.data.url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.name + '</span></li>')
		});
	});
});

function selectFacebook(fbId){
	$.getJSON( "search/results/resultFacebook.json", function( data ) {
		$.each(data.data, function(index, val) {
			if(val.id==fbId){
				Selection.push(val);
			}	 
		});
	});
	$.getJSON( "search/results/resultTwitter.json", function( data ) {
		$marcasSuge.html('');
		var items = [];
		$.each(data, function(index, val) {
			//console.log(val);
			if(index<=5){
			$marcasSuge.append('<li class="marca" id="'+ val.id +'" onclick="selectTwitter('+val.id+')"><figure><img src="'+val.profile_image_url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.screen_name + '</span></li>');

			 /* iterate through array or object */
			}
		
		});
	});
}
function selectTwitter(twId){
	$.getJSON( "search/results/resultTwitter.json", function( data ) {
		$.each(data, function(index, val) {
			if(val.id==twId){
				Selection.push(val);
			}	 
		});
	});
	$.getJSON( "search/results/resultYoutube.json", function( data ) {
		$marcasSuge.html('');
		$.each(data.items, function(index, val) {
			console.log(val.snippet.title);	
			console.log(val.snippet.thumbnails.default.url);
			if(index<=5){
				$marcasSuge.append('<li class="marca" id="'+ val.id +'" onclick="selectYoutube('+val.id+')"><figure><img src="'+val.snippet.thumbnails.default.url+'" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1" width="200" height="200"></figure><span class="user">'+ val.snippet.title + '</span></li>');
			 /* iterate through array or object */
			}
		});
	});
}