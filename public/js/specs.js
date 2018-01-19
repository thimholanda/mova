$(document).ready(function() 
{	
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
 	});

 	if($('input[name=kwh]').length > 0)
 	{ 		
		$('input[name=kwh]').inputmask('decimal', {
	        'alias': 'numeric',
	        'groupSeparator': '.',
	        'autoGroup': true,
	        'digits': 0,
	        'radixPoint': ",",
	        'digitsOptional': false,
	        'allowMinus': false,
	        'sulfix': 'kWh ',
	        'placeholder': '',
	        'rightAlign': false,
	        'removeMaskOnSubmit': true,
	        'autoUnmask':true
	    });
 	}

 	if($('input[name=valor_retificado]').length > 0)
 	{ 		
		$('input[name=valor_retificado]').inputmask('decimal', {
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

 	if($('.mascara-input').length > 0)
 	{ 		
		$('.mascara-input').inputmask('decimal', {
	        'alias': 'numeric',
	        'groupSeparator': '.',
	        'autoGroup': true,
	        'digits': 0,
	        'radixPoint': ",",
	        'digitsOptional': false,
	        'allowMinus': false,
	        'sulfix': 'kWh ',
	        'placeholder': '',
	        'rightAlign': false,
	        'removeMaskOnSubmit': true,
	        'autoUnmask':true
	    });
 	}	

 	$('.zb-container-notifications').hover(function() 
 	{
 		$('.zb-list-notifications').fadeIn('fast');
 	}, function() 
 	{
 		$('.zb-list-notifications').fadeOut('fast');
 	});

 	$('.zb-button-user').hover(function() 
 	{
 		$('.zb-cascade-menu').fadeIn('fast');
 	}, function() 
 	{
 		$('.zb-cascade-menu').fadeOut('fast');
 	}); 	

 	$('html').on('click', '.zb-close-dashboard-modal, .zb-dashboard-pano', function(event) {
 		closeDashboardModal();
 	});

 	function closeDashboardModal()
 	{
 		$('.zb-dashboard-modal').fadeOut('fast', function() {
 			$('.zb-dashboard-pano').fadeOut('fast');
 		});
 	}

 	$('html').on('click', '.zb-dashboard-accordion h2', function(event) {

 		if($(this).next('.zb-resposta-users').is(':visible'))
 		{
 			$(this).find('span').html('+');
 		}
 		else
 		{
 			$(this).find('span').html('-');
 		}
 		
 		$(this).next('.zb-resposta-users').slideToggle(400); 		

 	});

 	$('html').on('click', '.zb-list-notifications button', function(event) {
 		event.preventDefault();

 		var button = $(this);
 		var dataID = button.attr('notification_id');

 		var visibleCount = $('.zb-list-notifications tr.zb-active:visible').length;

 		$.ajax({
 			url: '/painel/usuario/remove-notificacao',
 			type: 'POST',
 			data: {id: dataID},
 			beforeSend: function()
 			{
		 		button.closest('tr').fadeOut('slow', function()
				{
					
					switch(visibleCount)
					{
						case 2:
						$('.zb-list-notifications tr:visible').css('border-top', '0');
						break;

						case 1:
						$('.zb-no-notifications').fadeIn('slow');
						break;
					}

				});

				var visibleCount = $('.zb-list-notifications tr.zb-active:visible').length;

				$('.zb-badge').html(visibleCount - 1);

				if(visibleCount - 1 == 0)
				{
					$('.zb-badge').css('background-color', '#757678');
				}
 			}
 		})
 		
 	});

 	$('.zb-btn-atualizar-mapa').click(function(event) 
 	{
 		event.preventDefault();
 		initMap();
 	});

 	function initMap() 
 	{

 		var initLat = Number($('input[name=lat]').val());
 		var initLng = Number($('input[name=lng]').val());
 		var initParams = {
 			center: {lat: -15.4992667, lng: -55.7705798},
 			zoom: 4,
 			marker: true
 		};

 		if(initLat != '' && initLng != '')
 		{
 			initParams.center = {lat: initLat, lng: initLng};
 			initParams.zoom = 17;
 		}

 	    var map = new google.maps.Map(document.getElementById('zb-map-usina'),initParams);

 	    var initMarkerParams = {
 	    	map: map,
 	    	anchorPoint: new google.maps.Point(0, -29),
 		};

 		if(initLat != '' && initLng != '')
 		{
 			initMarkerParams.position = {lat: initLat, lng: initLng};
 			var marker = new google.maps.Marker(initMarkerParams);
 		}

 		if( $('#pac-input').length > 0)
 		{

	 	  	var input = document.getElementById('pac-input');

	 	  	var autocomplete = new google.maps.places.Autocomplete(input);

	 	  	autocomplete.bindTo('bounds', map);

	 	  	var marker = new google.maps.Marker(initMarkerParams);

	        autocomplete.addListener('place_changed', function() 
	        {
	        	marker.setVisible(false);
	        	var place = autocomplete.getPlace();

	        	var lat = place.geometry.location.lat();
	        	var lng = place.geometry.location.lng();

	        	$('input[name=lat]').val(lat);
	        	$('input[name=lng]').val(lng);

	        	console.log(lat);
	        	console.log(lng);

	        	if (!place.geometry) 
				{
					// User entered the name of a Place that was not suggested and
					// pressed the Enter key, or the Place Details request failed.
					window.alert("No details available for input: '" + place.name + "'");
					return;
				}

				if (place.geometry.viewport) 
				{
					map.fitBounds(place.geometry.viewport);
				} 
				else 
				{
					map.setCenter(place.geometry.location);
					map.setZoom(17);  // Why 17? Because it looks good.
				}
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);

	        });
	    }

 	}

 	if( $('#zb-map-usina').length >= 1 )
 	{
 		google.maps.event.addDomListener(window, "load", initMap);
 	}

 	$('.alert a').click(function(event) 
 	{
 		event.preventDefault();

 		$(this).closest('p').fadeOut('fast');
 	});

	$('#confirm-delete').on('show.bs.modal', function (e) {

	  $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-header p').text($title);

	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer .btn-ok').data('form', form);
	});

	$('#confirm-delete').find('.modal-footer .btn-ok').on('click', function(){
	 $(this).data('form').submit();
	});

	// Função timer

	if(typeof(ano) !== 'undefined')
	{
			timerHome(new Date(ano, mes-1, dia, hora, minuto, segundo), '.zb-validade-count');

		   function timerHome(date, el)
		   {
		   	$(el).countdown(date)
		   	.on('update.countdown', function(event) {
		   	  $(this).parent().find('.sh-label-info').html('encerrará em');
		   	  var format = '%H:%M:%S';
		   	  if(event.offset.totalDays > 0) {

		           if(event.offset.totalDays > 1) 
		           {
		             format = '%-D dias ' + format;
		           }

		           if(event.offset.totalDays == 1) 
		           {
		             format = '%-D dia ' + format;
		           }

		   	  }
		         
		   	  $(this).html(event.strftime(format));
		   	})
		   	.on('finish.countdown', function(event) {
		   	  $(this).html('sua assinatura expirou');
		   	});
		   }

	}

	$('html').on('click', '.btn-dashboard-modal', function(event) {
		event.preventDefault();
		
		$('.zb-dashboard-pano').fadeIn('fast', function() {
			$('.zb-dashboard-modal').fadeIn('fast', function(){
				initMapOrigem();
			});

		});

		
	});


	function initMapOrigem()
	{
		var initLat = Number( lat );
 		var initLng = Number( lng );
 		var initParams = {
 			center: {lat: initLat, lng: initLng},
 			zoom: 17,
 			marker: true
 		};

		var map = new google.maps.Map(document.getElementById('zb-map-origem'),initParams);

 	    var initMarkerParams = {
 	    	map: map,
 	    	anchorPoint: new google.maps.Point(0, -29),
 	    	position: {lat: initLat, lng: initLng}
 		};

 		var marker = new google.maps.Marker(initMarkerParams);
	}

	if( $('input[name=kwh]').val() != '' )
	{
		$('.zb-investimento-resultado').slideDown('fast');
	}

	$('input[name=kwh]').focusin(function(event) 
	{
		$(this).val('');
		$('.zb-investimento-resultado').slideUp('fast');
		$('.passo2').slideUp();
		$('.passo3-historico').slideUp();
		$('.passo3-contas').slideUp();
	});

	$('.btn-simular-usuario').click(function(event) 
	{
		event.preventDefault();

		var kwh = $('input[name=kwh]').val();

		$.ajax({
			url: '/simule-admin/' + kwh,
			type: 'GET',
			dataType: 'json',
		})

		.done(function(data) {
			
			if( typeof(data.erro) !== 'undefined' )
			{
				alert(data.erro);
			}
			else
			{
				$('input[name=simulacao_id]').val(data.simulacao_id);
				$('.zb-investimento-resultado').slideDown('fast');
				var preco = data.preco;
				$('.zb-investimento').find('strong').html( preco.toFixed(2).toString().replace(".", ",") );
			}
			
		})

		.fail(function() {
			console.log("insira um valor válido");
		});
	});

	$('.btn-prosseguir').click(function(event) 
	{
		event.preventDefault();

		$('.passo2').slideDown('fast', function(){
			var body = $("html, body");
			body.stop().animate({ scrollTop: $('.passo2').offset().top - 100}, '500', 'swing');
		});
	});

	$('.btn-historico').click(function(event) 
	{
		event.preventDefault();
		exibeHistorico();
	});

	$('.btn-contas').click(function(event) 
	{
		event.preventDefault();
		exibeContas();		
	});

	if ($('.container-erros').length > 1)
	{

		$('.passo2').slideDown();

		if($('input[name=old_tipo]').val() == 1)
		{
			// tipo histórico
			exibeHistorico();

			
		}
		else if($('input[name=old_tipo]').val() == 2)
		{
			// tipo contas
			exibeContas();
			
		}	

	}

	function exibeHistorico()
	{
		$('.btn-contas').addClass('zb-btn-inativo');
		$('.btn-historico').removeClass('zb-btn-inativo');

		$('.passo3-historico').slideDown('fast', function(){
			var body = $("html, body");
			body.stop().animate({ scrollTop: $('.passo3-historico').offset().top - 100}, '500', 'swing');
		});
		$('.passo3-contas').slideUp();

		
	}

	function exibeContas()
	{
		$('.btn-contas').removeClass('zb-btn-inativo');
		$('.btn-historico').addClass('zb-btn-inativo');

		$('.passo3-historico').slideUp();
		$('.passo3-contas').slideDown('fast', function(){
			var body = $("html, body");
			body.stop().animate({ scrollTop: $('.passo3-contas').offset().top - 100}, '500', 'swing');
		});

		
	}

	$.featherlight.prototype.afterContent = function() {
	  var caption = this.$currentTarget.attr('alt');
	  this.$instance.find('.caption').remove();
	  $('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
	};


	$('.zb-input-contas').change(function(event) 
	{
		$(this).fadeOut();

		var label = $(this).next('label');
		// label.fadeOut();
		var fileName = '';

		if( $(this)[0].files.length > 0)
		{
			fileName = $(this)[0].files[0].name;
			// label.find('span').html('<i class="fa fa-check" aria-hidden="true"></i> &nbsp;' + fileName);
			label.find('span').html('arquivo selecionado: ' + fileName);
			label.addClass('zb-green-input-file');
		}
		else if($(this)[0].files.length == 0)
		{	
			label.removeClass('zb-green-input-file');
			label.find('span').html('<i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp;clique aqui e selecione o arquivo</span>');
		}
	});


	$('.zb-btn-auditoria-aprovacao').click(function(event) 
	{
		var mes_id = $(this).attr('data-mes');
		$(this).parent().parent().find('.zb-auditoria-resposta').slideUp();
		$(this).addClass('zb-green-color');
		$(this).parent().parent().find('.zb-btn-auditoria-reprovacao').removeClass('zb-red-color');

		$.ajax({
			url: '/painel/administrador/aprovar-mes',
			type: 'PUT',
			dataType: 'json',
			data: {mes_id: mes_id},
		})
		.done(function(data) {
			console.log("success");
			console.log(data);
		})
		.fail(function() {
			alert('não foi possível aprovar este mês. Por favor, entre em contato com o desenvolvedor.')
		})
	});

	$('.zb-btn-auditoria-reprovacao').click(function(event) 
	{
		$(this).parent().parent().find('.zb-auditoria-resposta').slideDown();
		$(this).addClass('zb-red-color');
		$(this).parent().parent().find('.zb-btn-auditoria-aprovacao').removeClass('zb-green-color');
		$(this).parent().parent().find('input[name=motivo]').focus();
	});

	$('#inlineCheckbox1').click(function(event) 
	{
		confirm('Tem certeza que deseja confirmar o pagamento deste boleto? Esta ação não poderá ser desfeita.');
		console.log('confirmado');
		var data = $('.zb-confirmar-boleto-extra').serializeArray();
		// var mes_id = $(this).attr('data-mes');
		// $(this).parent().parent().find('.zb-auditoria-resposta').slideUp();
		// $(this).addClass('zb-green-color');
		// $(this).parent().parent().find('.zb-btn-auditoria-reprovacao').removeClass('zb-red-color');

		$.ajax({
			url: '/painel/administrador/atualizar-boleto-extra',
			type: 'POST',
			dataType: 'json',
			data: data,
		})
		.done(function(data) {
			$('.zb-confirmar-boleto-extra').fadeOut();
			$('.zb-retorno-boleto').fadeIn();
			console.log("success");
			console.log(data);
		})
		.fail(function() {
			alert('não foi possível realizar esta ação. Por favor, entre em contato com o desenvolvedor.')
		})
	});

	// $('input[name=motivo]').focusout(function(event) 
	// {
	// 	event.preventDefault();
	// 	var mes_id = $(this).parent().parent().find('button').attr('data-mes');
	// 	var input = $(this);
	// 	var mensagem = input.val();
	// 	var btn = $(this).parent().parent().find('button');

	// 	if(mensagem == '')
	// 	{
	// 		input.css('background-color', '#FFE9E9');
	// 		return;
	// 	}
	// 	else
	// 	{
	// 		input.css('background-color', 'white');
	// 	}

	// 	$.ajax({
	// 		url: '/painel/administrador/reprovar-mes',
	// 		type: 'PUT',
	// 		dataType: 'json',
	// 		data: {mes_id: mes_id, mensagem: mensagem},
	// 		beforeSend: function()
	// 		{
	// 			btn.css('opacity', '.5');
	// 		}
	// 	})
	// 	.done(function(data) {

	// 		btn.css('opacity', '1');
	// 		input.css('color', '#ba2020');

	// 		if(btn.html() == 'confirmar')
	// 		{
	// 			btn.html('atualizar');
	// 		}

	// 		else if(btn.html() == 'atualizar')
	// 		{
	// 			btn.html('atualizado');

	// 			setTimeout(function(){
	// 				btn.html('atualizar');
	// 			}, 2000)
	// 		}

	// 		console.log("success");
	// 		console.log(data);
	// 	})
	// 	.fail(function() {
	// 		alert('não foi possível aprovar este mês. Por favor, entre em contato com o desenvolvedor.')
	// 	})
	// });

	$('.zb-confirmar-reprovacao').click(function(event) 
	{
		var mes_id = $(this).attr('data-mes');
		var input = $(this).parent().parent().find('input[name=motivo]');
		var input_valor_retificado = $(this).parent().parent().find('input[name=valor_retificado]');
		var mensagem = input.val();
		var btn = $(this);

		if(input_valor_retificado.val() == '')
		{
			input_valor_retificado.css('background-color', '#FFE9E9');
			return;
		}
		else if(mensagem == '')
		{
			input.css('background-color', '#FFE9E9');
			input_valor_retificado.css('background-color', 'white');
			return;
		}
		else
		{
			input_valor_retificado.css('background-color', 'white');
			input.css('background-color', 'white');
		}

		$.ajax({
			url: '/painel/administrador/reprovar-mes',
			type: 'PUT',
			dataType: 'json',
			data: {mes_id: mes_id, mensagem: mensagem, valor_retificado: input_valor_retificado.val()},
			beforeSend: function()
			{
				btn.css('opacity', '.5');
			}
		})
		.done(function(data) {

			btn.css('opacity', '1');
			input.css('color', '#ba2020');
			input_valor_retificado.css('color', '#ba2020');

			if(btn.html() == 'confirmar')
			{
				btn.html('atualizar');
			}

			else if(btn.html() == 'atualizar')
			{
				btn.html('atualizado');

				setTimeout(function(){
					btn.html('atualizar');
				}, 2000)
			}

			console.log("success");
			console.log(data);
		})
		.fail(function() {
			alert('não foi possível aprovar este mês. Por favor, entre em contato com o desenvolvedor.')
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

 	if($('.zb-sortable-table').length > 0)
 	{	


	 	$('.zb-sortable-table').sortable({
	 		helper: "clone",
	 		update: function(event, ui)
	 		{
	 			var dataS = $(this).sortable('serialize');

	 			$.ajax({
	 				url: '/painel/administrador/faq/atualizar-posicao',
	 				type: 'PUT',
	 				// dataType: 'json',
	 				data: dataS,
	 			})
	 			.done(function(data) {
	 				if(data.msg == 'error')
	 				{
	 					alert('Não foi possível reordenar as peguntas. Por favor, tente novamente.');
	 				}
	 			})
	 			.fail(function() {
	 				alert('Não foi possível reordenar as peguntas. Por favor, tente novamente.');
	 			}) 			
	 		}
	 	});

	 }
	 if(typeof link_pagamento !== 'undefined')
	 {
	 	window.open(link_pagamento);
	 }

	 // $('#form-contas').submit(function(event) 
	 // {
	 // 	var form = $(this);	 	
	 // 	var elements = $(this).serializeArray();
	 // 	var check = false;

	 // 	$.each(elements, function(index, val) 
	 // 	{
	 // 		if(val.name == 'mes_conta[]')
	 // 		{
	 // 			if(val.value > 17000)
	 // 			{
	 // 				check = true;
	 // 			}
	 // 		}
	 		
	 // 	});

	 // 	if(check)
	 // 	{
	 // 		alert('Nosso produto disponibiliza no máximo 17.000 kWh/mês. Por favor, entre em contato para mais informações.');

	 // 		$('.zb-pano-submit').fadeOut();
	 // 		$('.zb-modal-submit').fadeOut();

	 // 		return false;
	 // 	}
	 // 	else
	 // 	{
	 // 		return true;
	 // 	}

	 // });

	  $('#form-contas .btn-submit-contas').click(function(event) 
	  {
	  	var form = $(this).parent().parent();
	  	console.log(form);
	  	var elements = form.serializeArray();
	  	var check = false;
	  	var sum = 0;

	  	var count = 0;

	  	$.each(elements, function(index, val) 
	  	{
	  		if(val.name == 'mes_conta[]')
	  		{
	  			if(val.value > 17000)
	  			{
	  				check = true;
	  			}

	  			if(val.value > 0)
	  			{
	  				count++;
	  			}

	  			if(!isNaN(parseInt(val.value)))
	  			{
	  				sum += parseInt(val.value);
	  			}
	  			
	  		}
	  		
	  	});

	  	if(check)
	  	{
	  		alert('Nosso produto disponibiliza no máximo 17.000 kWh/mês. Por favor, entre em contato para mais informações.');

	  		$('.zb-pano-submit').fadeOut();
	  		$('.zb-modal-submit').fadeOut();
	  		
	  		return false;
	  	}

	  	//atribuição da média baseada nos inputs
	  	var media = sum/count;

	  	// controle de quantidade
	  	if(count < 9)
	  	{
	  		alert('Os dados dos últimos 9 meses são obrigatórios');

	  		$('.zb-pano-submit').fadeOut();
	  		$('.zb-modal-submit').fadeOut();

	  		return false;
	  	}

	  	// requisicao do valor final
	  	$.ajax({
	 		url: '/simule-admin/' + media,
	 		type: 'GET',
	 		dataType: 'json',
	 		beforeSend: function()
	 		{
	 			$('.zb-pano-submit').fadeIn();
	 			$('.zb-modal-submit').fadeIn();
	 		}
	 	})

	 	.done(function(data) {

	 		$('.zb-pano-submit').fadeOut();
	 		$('.zb-modal-submit').fadeOut();
	 		
	 		var preco = data.preco;

	 		$('.zb-confirmacao-preco strong').html('R$ ' + preco.toFixed(2).toString().replace(".", ",") + ' por ano');
	 		$('.zb-confirmacao-consumo strong').html(Math.ceil(media) + ' kWh');

	 		$('.zb-confirmacao-meses').fadeIn('fast');
	 		$('.zb-pano-confirmacao-meses').fadeIn('fast');

	 		$('.zb-confirmacao-meses .zb-confirm').click(function(event) 
	 		{				
	 			$('.zb-confirmacao-meses').fadeOut('fast');
	 			$('.zb-pano-confirmacao-meses').fadeOut('fast');
	 			$('.zb-pano-submit').fadeIn();
	 			$('.zb-modal-submit').fadeIn();
	 			$('#form-contas').submit();
	 		});
	 		
	 	})

	 	.fail(function() {

	 		$('.zb-pano-submit').fadeOut();
	 		$('.zb-modal-submit').fadeOut();

	 		alert('Não foi possível completar esta requisição. Por favor, tente novamente.');

	 		return false;
	 	});

	  	return false;

	  });

	 $('#form-historico .btn-submit-contas').click(function(event) 
	 {
	 	var form = $(this).parent().parent();
	 	console.log(form);
	 	var elements = form.serializeArray();
	 	var check = false;
	 	var sum = 0;

	 	var count = 0;

	 	$.each(elements, function(index, val) 
	 	{
	 		if(val.name == 'mes[]')
	 		{
	 			if(val.value > 17000)
	 			{
	 				check = true;
	 			}

	 			if(val.value > 0)
	 			{
	 				count++;
	 			}

	 			if(!isNaN(parseInt(val.value)))
	 			{
	 				sum += parseInt(val.value);
	 			}
	 			
	 		}
	 		
	 	});

	 	if(check)
	 	{
	 		alert('Nosso produto disponibiliza no máximo 17.000 kWh/mês. Por favor, entre em contato para mais informações.');

	 		$('.zb-pano-submit').fadeOut();
	 		$('.zb-modal-submit').fadeOut();
	 		
	 		return false;
	 	}

	 	//atribuição da média baseada nos inputs
	 	var media = sum/count;

	 	// controle de quantidade
	 	if(count < 9)
	 	{
	 		alert('Os dados dos últimos 9 meses são obrigatórios');

	 		$('.zb-pano-submit').fadeOut();
	 		$('.zb-modal-submit').fadeOut();

	 		return false;
	 	}

	 	// requisicao do valor final
	 	$.ajax({
			url: '/simule-admin/' + media,
			type: 'GET',
			dataType: 'json',
			beforeSend: function()
			{
				$('.zb-pano-submit').fadeIn();
				$('.zb-modal-submit').fadeIn();
			}
		})

		.done(function(data) {

			$('.zb-pano-submit').fadeOut();
			$('.zb-modal-submit').fadeOut();
			
			var preco = data.preco;

			$('.zb-confirmacao-preco strong').html('R$ ' + preco.toFixed(2).toString().replace(".", ",") + ' por ano');
			$('.zb-confirmacao-consumo strong').html(Math.ceil(media) + ' kWh');

			$('.zb-confirmacao-meses').fadeIn('fast');
			$('.zb-pano-confirmacao-meses').fadeIn('fast');

			$('.zb-confirmacao-meses .zb-confirm').click(function(event) 
			{				
				$('.zb-confirmacao-meses').fadeOut('fast');
				$('.zb-pano-confirmacao-meses').fadeOut('fast');
				$('.zb-pano-submit').fadeIn();
				$('.zb-modal-submit').fadeIn();
				$('#form-historico').submit();
			});
			
		})

		.fail(function() {

			$('.zb-pano-submit').fadeOut();
			$('.zb-modal-submit').fadeOut();

			alert('Não foi possível completar esta requisição. Por favor, tente novamente.');

			return false;
		});

	 	return false;

	 });

	$('.btn-cancelar-solicitacao').click(function(event) 
	{
		$('.zb-confirmacao-meses').fadeOut('fast');
		$('.zb-pano-confirmacao-meses').fadeOut('fast');
	});
	 
});

