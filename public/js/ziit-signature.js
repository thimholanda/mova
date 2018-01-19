(function(){

	$origin = window.location.href;

	var jQuery;

	if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.7.1') {
	var script_tag = document.createElement('script');
	script_tag.setAttribute("type","text/javascript");
	script_tag.setAttribute("src",
	   "http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");
	if (script_tag.readyState) {
	 script_tag.onreadystatechange = function () { // For old versions of IE
	     if (this.readyState == 'complete' || this.readyState == 'loaded') {
	         scriptLoadHandler();
	     }
	 };
	} else { // Other browsers
	 script_tag.onload = scriptLoadHandler;
	}
	(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);    
	} else {    
	jQuery = window.jQuery;
	main(); //our main JS functionality
	}


	function scriptLoadHandler() {
	jQuery = window.jQuery.noConflict(true);

	main(); //our main JS functionality
	}

	function main() { 

		   

	   jQuery(document).ready(function($) {

		   	var obj = {};
		   	for (var i = 0; i < _ziitData.length; i++) {
		   	    var data = _ziitData[i];
		   	    obj[_ziitData[i][0]] = _ziitData[i][1];
		   	}

		   	var account = obj._setAccount;

		   jQuery.ajax({                                                                                                                                                                                                        
		       type: 'GET',                                                                                                                                                                                                 
		       url: 'http://ziitbusiness.com.br/dev/widget/initial',                                                                                                                                              
		       dataType: 'jsonp',
		       data: {'account': account, 'origin' : $origin},                                                                                                                                                                                                
		       success: function(data) 
				{
					if(jQuery('.zb-assinatura-ziit-embed').length >= 1)
					{
						console.log(data.html);
						jQuery('.zb-assinatura-ziit-embed').html(data.html);
					}
					else
					{
						console.log('inclua o container da assinatura.')
					}
				},                                                                                                                                                                                       
		       error: function() 
				{ 
					console.log('não foi possível carregar o script de assinatura'); 
				},
		       jsonp: 'jsonp'                                                                                                                                                
		   });

	   });
	}


	
	

})();