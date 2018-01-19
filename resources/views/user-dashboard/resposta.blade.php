@extends('templates.dashboard')

@section('title', 'Ziit Business - Contato')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/usuario/contato') }} ">Contato</a> > Resposta</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="zb-white-container">   

            	<label>Assunto de sua mensagem:</label>
                <div class="well well-sm">{{ $resposta->contato->assunto }}</div>

                	<label>Sua mensagem enviada em {{ $resposta->contato->created_at->format('d/m/Y') }}:</label>
                    <div class="well well-sm">{{ $resposta->contato->mensagem }}</div>


            	<label>Reposta enviada pelo administrador em {{ $resposta->created_at->format('d/m/Y') }}:</label>
                <div class="well well-sm">{{ $resposta->mensagem }}</div>             

            </div>
        </div>
        
    </div>

    <br>
    <br>

    <div class="row">   	

	        <div class="col-md-12 zb-dashboard-centered">
	        	<div class="zb-white-container">
	        		<h2>Ainda tem alguma dúvida ou deseja obter mais informações?</h2>
	        		<a href="{{ url('/painel/usuario/contato') }}" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i><span>Enviar nova mensagem</span></a>
	        	</div>
	        </div>       

    </div>

@endsection



