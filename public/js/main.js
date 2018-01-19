$(document).ready(function() 
{
	if($(window).scrollTop() > $(this).height())
	{
		$('.zb-second-header').addClass('zb-second-header-active');
	}
	else
	{
		$('.zb-second-header').removeClass('zb-second-header-active');
	}

	$(window).scroll(function(event) 
	{
		if($(this).scrollTop() > $(this).height() - 5)
		{
			$('.zb-second-header').addClass('zb-second-header-active');
		}
		else
		{
			$('.zb-second-header').removeClass('zb-second-header-active');
		}

	});

	$('.zb-container-slider').slick({
		dots: true,
		autoplay: true,
	});

	$('.zb-container-main-slider').slick({
		dots: true,
		autoplay: true,
		autoplaySpeed: 6000,
		pauseOnHover: false,
		pauseOnFocus: false,
		arrows: false,
	});

	$('.zb-slider-mobile').slick({
		dots: false,
		autoplay: false,
		arrows: false,
	});

	$('.zb-container-main-slider').slickAnimation();

	$('.zb-slider-mobile').slickAnimation();

	$('.zb-slider-clientes').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		arrows: true,
	});

	if($('input[name=watt_hora]').length > 0)
	{
		$('input[name=watt_hora]').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 0,
                'radixPoint': ",",
                'digitsOptional': false,
                'allowMinus': false,
                'sulfix': 'R$ ',
                'placeholder': '',
                'rightAlign': false,
                'removeMaskOnSubmit': true,
                'autoUnmask':true
	    });
	}

	

	$('.zb-btn-simule').click(function(event) 
	{
		event.preventDefault();

		var kwh = $('input[name=watt_hora]').val();

		console.log(kwh);

		$.ajax({
			url: '/simule/' + kwh,
			type: 'GET',
			dataType: 'json',
			beforeSend: function()
			{
				$('input[name=watt_hora]').css('background', 'white');
			}
		})
		.done(function(data) {

			if( typeof(data.erro) !== 'undefined' )
			{
				alert(data.erro);
			}
			else
			{
				var preco = data.preco;
				$('input[name=investimento]').val(data.preco);
				$('.zb-wrap-result').slideDown();
				$('.zb-investimento').find('strong').html( preco.toFixed(2).toString().replace(".", ",") );

				var body = $("html, body");
				body.stop().animate({ scrollTop: $('.zb-row-investimento').offset().top - 400}, '500', 'swing');
			}
		})
		.fail(function() {
			console.log("error");
			$('input[name=watt_hora]').css('background', '#fdc276');
		})
		.always(function() {
			console.log("complete");
		});		

	});

	$('input[name=watt_hora]').focusin(function(event)
	{
		$('.zb-wrap-result').slideUp();
		$(this).val('');
		$('input[name=investimento]').val('');
		$('.zb-investimento').find('strong').html('');
	});

	$('.zb-button-solar').click(function(event) 
	{
		event.preventDefault();

		h1 = 'Energia<br/> Solar.';

		if($(window).width()<1000)
		{
			icon = '-210px center';
		}
		else
		{
			icon = '-600px center';
		}

		inlineText = 'A <strong>energia solar</strong> é aquela proveniente da luz e do calor do Sol, sendo utilizada por meio de diferentes tecnologias. No Brasil é ultilizada a energia solar fotovoltaica.';
		inlineButton = 'Comece a usar energia solar';
		background = '#ec1c1a';
		tipo = solar;

		showSlider(h1, icon, inlineText, inlineButton, background, tipo);

	});

	$('.zb-button-biomassa').click(function(event) 
	{
		event.preventDefault();

		h1 = 'Energia<br/> Biomassa.';

		if($(window).width()<1000)
		{
			icon = '-70px center';
		}
		else
		{
			icon = '-200px center';
		}
		
		inlineText = 'A <strong>energia biomassa</strong> é aquela gerada por meio da decomposição de materiais orgânicos (esterco, restos de alimentos, resíduos agrícolas que produzem o gás metano). Para sua geração, são utilizados materiais como biomassa arborícola, sobra de serragem, vegetais e frutas, bagaço de cana e alguns tipos de esgotos. Ela é transformada em energia por meio dos processos de combustão, gaseificação, fermentação ou na produção de substâncias líquidas.';
		inlineButton = 'Comece a usar energia biomassa';
		background = '#08da00';
		tipo = biomassa;

		showSlider(h1, icon, inlineText, inlineButton, background, tipo);

	});

	$('.zb-button-hidrica').click(function(event) 
	{
		event.preventDefault();

		h1 = 'Energia<br/> Hídrica.';

		if($(window).width()<1000)
		{
			icon = '-140px center';
		}
		else
		{
			icon = '-400px center';
		}

		inlineText = 'A <strong>energia hídrica</strong> de PCH é produzida por uma usina hidrelétrica de pequeno porte, cuja capacidade instalada seja superior a 1 MW e inferior a 30 MW (em alguns casos, 50 MW). Além disso, a área do reservatório deve ser inferior a 3 km².';
		inlineButton = 'Comece a usar energia hídrica';
		background = '#0025e0';
		tipo = hidrica;

		showSlider(h1, icon, inlineText, inlineButton, background, tipo);

	});

	$('.zb-button-eolica').click(function(event) 
	{
		event.preventDefault();

		h1 = 'Energia<br/> Eólica.';
		icon = '0 center';
		inlineText = 'A <strong>energia eólica</strong> é produzida a partir da força dos ventos. Grandes turbinas (aerogeradores), em formato de cata-vento, são colocadas em locais abertos e com boa quantidade de vento. Através de um gerador, o movimento destas turbinas produz energia elétrica. Mapa das usinas geradoras.';
		inlineButton = 'Comece a usar energia eólica';
		background = '#b366ff';
		tipo = eolica;

		showSlider(h1, icon, inlineText, inlineButton, background, tipo);

	});

	function showSlider(h1, icon, inlineText, inlineButton, background, tipo)
	{
		$('.zb-slider-energia').css('background', background);
		$('.zb-slider-energia').find('h1').html(h1);
		$('.zb-slider-energia').find('.zb-icon-energia').css('background-position', icon);
		$('.zb-slider-energia').find('.zb-inline-text').html(inlineText);
		$('.zb-slider-energia').find('.zb-regular-inline-button').html(inlineButton);

		$('.zb-slider-energia').show("slide", { direction: "left" }, 500);
		initMap(tipo);
	}


	$('.zb-slider-energia .zb-button-voltar').click(function(event) 
	{
		event.preventDefault();
		$('.zb-slider-energia').hide("slide", { direction: "left" }, 500);
	});

	function initMap(tipo) 
	{

	  map = new google.maps.Map(document.getElementById('map'),{
	    center: {lat: -16.257, lng: -58.440},
	    zoom: 4,
	    disableDefaultUI: true,
	    styles: [
	          {
	              "featureType": "all",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                  {
	                      "saturation": 36
	                  },
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 40
	                  }
	              ]
	          },
	          {
	              "featureType": "all",
	              "elementType": "labels.text.stroke",
	              "stylers": [
	                  {
	                      "visibility": "on"
	                  },
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 16
	                  }
	              ]
	          },
	          {
	              "featureType": "all",
	              "elementType": "labels.icon",
	              "stylers": [
	                  {
	                      "visibility": "off"
	                  }
	              ]
	          },
	          {
	              "featureType": "administrative",
	              "elementType": "geometry.fill",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 20
	                  }
	              ]
	          },
	          {
	              "featureType": "administrative",
	              "elementType": "geometry.stroke",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 17
	                  },
	                  {
	                      "weight": 1.2
	                  }
	              ]
	          },
	          {
	              "featureType": "landscape",
	              "elementType": "geometry",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 25
	                  }
	              ]
	          },
	          {
	              "featureType": "poi",
	              "elementType": "geometry",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 21
	                  }
	              ]
	          },
	          {
	              "featureType": "road.highway",
	              "elementType": "geometry.fill",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 17
	                  }
	              ]
	          },
	          {
	              "featureType": "road.highway",
	              "elementType": "geometry.stroke",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 29
	                  },
	                  {
	                      "weight": 0.2
	                  }
	              ]
	          },
	          {
	              "featureType": "road.arterial",
	              "elementType": "geometry",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 18
	                  }
	              ]
	          },
	          {
	              "featureType": "road.local",
	              "elementType": "geometry",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 16
	                  }
	              ]
	          },
	          {
	              "featureType": "transit",
	              "elementType": "geometry",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 19
	                  }
	              ]
	          },
	          {
	              "featureType": "water",
	              "elementType": "geometry",
	              "stylers": [
	                  {
	                      "color": "#000000"
	                  },
	                  {
	                      "lightness": 17
	                  }
	              ]
	          }
	      ]
	  });
	
	var markers = [];
	var infoWindows = [];

	 $.each(tipo, function(index, val) 
	 {
	 	var data = new Date(val.inicio_operacao);
	 	var dia = data.getDate();
	 	var mes = data.getMonth()+1;
	 	var ano = data.getFullYear();

 	    if (dia.toString().length == 1) dia = "0"+dia; 	    
 	    if (mes.toString().length == 1) mes = "0"+mes;
 	      
 	    var dataFinal = dia+"/"+mes+"/"+ano;

	 	markers[index] = new google.maps.Marker({
	 	  position: {lat: Number(val.lat), lng: Number(val.lng)},
	 	  map: map
	 	});

	 	infoWindows[index] = new google.maps.InfoWindow;

	 	markers[index].addListener('click', function() {
	 	    infoWindows[index].setContent('<h1><strong>' + val.nome +'</strong></h1><br><p>' + val.endereco + '</p><p><strong>Em operação desde: </strong>' + dataFinal + '</p>');
	 	    infoWindows[index].open(map, markers[index]);
	 	  });
	 }); 

	}

	$('.zb-btn-faca-simulacao').click(function(event) 
	{
		event.preventDefault();
		var top = $('#simulacao').offset().top;
		var body = $("html, body");
		body.stop().animate({ scrollTop: top }, '500', 'swing');
	});

	$('.zb-container-btn-simulacao button').click(function(event) 
	{
		event.preventDefault();
		var top = $('#formas-aderir').offset().top;
		var body = $("html, body");
		body.stop().animate({ scrollTop: top }, '500', 'swing');
	});


	$('.zb-btn-comece-agora').click(function(event) 
	{
		event.preventDefault();

		$('.zb-pano-modal').fadeIn('fast', function(){
			$('.zb-modal').fadeIn();
		});

	});

	$('.zb-close-modal, .zb-btn-fechar').click(function(event) 
	{
		event.preventDefault();

		$('.zb-form-grauito-response').fadeOut('fast', function(){
			$('.zb-content-form-gratuito').fadeIn();
			$('.zb-close-modal').fadeIn();
		});

		$('.zb-modal').fadeOut('fast', function(){
			$('.zb-pano-modal').fadeOut();
		});

	});

	$('.zb-btn-formas-aderir').click(function(event) 
	{
		event.preventDefault();

		var top = $('#formas-aderir').offset().top;
		var body = $("html, body");
		body.stop().animate({ scrollTop: top }, '500', 'swing');	

	});

	$('.zb-main-header nav .zb-anchor-link-inline , .zb-second-header nav .zb-anchor-link-inline, .zb-footer-menu .zb-anchor-link-inline, .zb-anchor-link').click(function(event) 
	{
		event.preventDefault();

		scrollToAnchor($(this).attr('href'));

	});

	$('.zb-menu-energias button').click(function(event) 
	{
		scrollToAnchor('#tipos-energia');
	});

	$('header h1').click(function(event) {
		var body = $("html, body");
		body.stop().animate({ scrollTop: 0 }, '500', 'swing');
	});


	function scrollToAnchor(target)
	{
		if(target != "#")
		{
			var top = $(target).offset().top;
			var body = $("html, body");
			body.stop().animate({ scrollTop: top }, '500', 'swing');
		}
	}

	$('.zb-section-faq h2').click(function(event) {
		event.preventDefault();

		target = $(this).parent().find('.zb-resposta');

		if( target.is(':visible') )
		{
			target.slideUp('fast');
			target.parent().find('.zb-accordion-icon').html('+');
		}
		else
		{
			target.slideDown('fast');
			target.parent().find('.zb-accordion-icon').html('-');
		}
		
	});

	$('.zb-close-modal-termos').click(function(event) 
	{
		event.preventDefault();
		$('.zb-modal-termos').fadeOut('fast');
		if( !$('.zb-modal').is(':visible') )
		{
			$('.zb-pano-modal').fadeOut('fast');
		}
	});

	$('.zb-btn-termos').click(function(event) 
	{
		event.preventDefault();

		$('.zb-modal-termos').fadeIn('fast');

		if(!$('.zb-pano-modal').is(':visible'))
		{
			$('.zb-pano-modal').fadeIn('fast');
		}
	});

	$('.zb-btn-menu-mobile').click(function(event) 
	{
		event.preventDefault();

		$('.zb-nav-mobile').stop();
		$('.zb-mobile-header .fa').stop();

		if($('.zb-nav-mobile').is(':visible'))
		{
			$('.zb-nav-mobile').slideUp('slow');
			$('.zb-mobile-header .fa-close').fadeOut('fast', function()
			{
				$('.zb-mobile-header .fa-bars').fadeIn('fast');
			})

		}
		else
		{
			$('.zb-nav-mobile').slideDown('slow');
			$('.zb-mobile-header .fa-bars').fadeOut('fast', function()
			{
				$('.zb-mobile-header .fa-close').fadeIn('fast');
			})
		}

	});

	$('.zb-nav-mobile li .zb-anchor-link-inline').click(function(event) {
		
		isThis = $(this);
		event.preventDefault();

		$('.zb-nav-mobile').slideUp('slow');
		$('.zb-mobile-header .fa-close').fadeOut('fast', function()
		{
			$('.zb-mobile-header .fa-bars').fadeIn('fast');
			scrollToAnchor(isThis.attr('href'));
		})

		
	});

	$('.zb-exibir-mapa').click(function(event) 
	{
		event.preventDefault();

		$('.zb-map-container').fadeIn('fast',function(){
			$('.zb-fechar-mapa').fadeIn();
		});
		initMap(tipo);

	});

	$('.zb-fechar-mapa').click(function(event) {
		event.preventDefault();
		$('.zb-map-container').fadeOut();
		$('.zb-fechar-mapa').fadeOut();
	});

	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('.zb-modal .zb-regular-button').click(function(event) 
	{
		event.preventDefault();

		var data = $('#zb-register-form').serialize();

		console.log(data);

		$.ajax({
			url: '/create/user',
			method: 'POST',
			data: data,
			dataType: 'json',
			beforeSend: function()
			{
				$('.zb-form-grauito-response').find('p').html('por favor, aguarde...');
				$('.zb-form-grauito-response').find('.zb-loader').fadeIn('20');
				$('.zb-form-grauito-response').find('button').fadeOut();

				$('.zb-content-form-gratuito').fadeOut('fast', function(){
					$('.zb-close-modal').fadeOut();
					$('.zb-form-grauito-response').fadeIn();
										
				});
				

			},
			error: function(data)
			{
				var response = data.responseJSON;
				var str = '';
				$.each(response.errors, function(index, val) {
					 str += val[0] + '<br>';
				});

				$('.zb-form-grauito-response').find('.zb-loader').fadeOut('fast', function(){
					$('.zb-form-grauito-response').find('p').html(str);
					$('.zb-form-grauito-response').find('.zb-btn-ok').fadeIn();
				});
				

			},
			success: function(data)
			{				
				$('.zb-form-grauito-response').find('.zb-loader').fadeOut('fast', function(){
					$('.zb-form-grauito-response').find('p').html('<strong>Seu cadastro foi realizado com sucesso!</strong><br> Você receberá um e-mail com instruções para definição de sua senha. Caso não receba o e-mail em até 24 horas, por favor, entre em contato conosco. Obs.: verifique sua caixa de spam.');
					$('.zb-form-grauito-response').find('.zb-btn-fechar').fadeIn();
				});
			}
		})

	});

	$('.zb-form-grauito-response button').click(function(event) 
	{
		$('.zb-form-grauito-response').fadeOut('fast', function(){
			$('.zb-content-form-gratuito').fadeIn();
			$('.zb-close-modal').fadeIn();
		});

	});

	$('.zb-btn-premium-form').click(function(event) 
	{
		event.preventDefault();

		var data = $('#zb-register-premium-form').serialize();

		console.log(data);

		$.ajax({
			url: '/create/user',
			method: 'POST',
			data: data,
			dataType: 'json',
			beforeSend: function()
			{	
				$('.zb-modal-premium .zb-form-grauito-response').fadeIn('fast');

				$('.zb-pano-modal').fadeIn('fast', function(){
					$('.zb-modal-premium').fadeIn('fast');
				});

				$('.zb-modal-premium .zb-form-grauito-response').find('p').html('por favor, aguarde...');
				$('.zb-modal-premium .zb-form-grauito-response').find('.zb-loader').fadeIn();
				$('.zb-modal-premium .zb-form-grauito-response').find('button').fadeOut();			

			},
			error: function(data)
			{
				console.log('erro');
				console.log(data);
				var response = data.responseJSON;
				var str = '';
				$.each(response.errors, function(index, val) {
					 str += val[0] + '<br>';
				});

				$('.zb-modal-premium .zb-form-grauito-response').find('.zb-loader').fadeOut('fast', function(){
					$('.zb-modal-premium .zb-form-grauito-response').find('p').html(str);
					$('.zb-modal-premium .zb-form-grauito-response').find('.zb-btn-ok-premium').fadeIn();
				});
				

			},
			success: function(data)
			{				
				console.log('sucesso');
				console.log(data);

				$('.zb-modal-premium .zb-form-grauito-response').find('.zb-loader').fadeOut('fast', function(){
					$('.zb-modal-premium .zb-form-grauito-response').find('p').html('<strong>Seu cadastro foi realizado com sucesso!</strong><br> Você receberá um e-mail com instruções para definição de sua senha. Caso não receba o e-mail em até 24 horas, por favor, entre em contato conosco. Obs.: verifique sua caixa de spam.');
					$('.zb-modal-premium .zb-form-grauito-response').find('.zb-btn-ok-premium').fadeIn();
				});


				// $('.zb-form-grauito-response').find('.zb-loader').fadeOut('fast', function(){
				// 	$('.zb-form-grauito-response').find('p').html('<strong>Seu cadastro foi realizado com sucesso!</strong><br> Você receberá um e-mail com instruções para definição de sua senha.');
				// 	$('.zb-form-grauito-response').find('.zb-btn-fechar').fadeIn();
				// });
			}
		})

	});

	function exibePanoLoader()
	{
		$('.zb-pano-submit').fadeIn('50');
		$('.zb-modal-submit').fadeIn('100');
	}

 	$('.zb-btn-submit-pano').click(function(event) 
 	{
 		exibePanoLoader();
 	});

 	$('.zb-loader-after-submit').submit(function(event) 
 	{
 		event.preventDefault();

 		var form = $(this);

 		$('.zb-pano-submit').fadeIn('100', function(){
 			$('.zb-modal-submit').fadeIn('100', function(){
 				setTimeout(function(){form.unbind('submit').submit(); }, 500);

 			});
 		})
 		
 	});

	$('.zb-btn-ok-premium').click(function(event) {
		event.preventDefault();
		$('.zb-modal-premium').fadeOut('fast', function(){
			$('.zb-pano-modal').fadeOut('fast');
		});
	});
	
	$.featherlight.prototype.afterContent = function() {
	  var caption = this.$currentTarget.attr('alt');
	  this.$instance.find('.caption').remove();
	  $('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
	};	
	
	

});