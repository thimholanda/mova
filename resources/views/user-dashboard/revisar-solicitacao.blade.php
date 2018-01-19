@extends('templates.dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/usuario/minha-conta') }} ">Minha Conta</a> > Revisar Solicitação</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default zb-status-auditoria">
              <div class="panel-body">
                @if($solicitacao->aprovado == 0)
                <p><strong>Status da auditoria:</strong> aguardando análise</p>

                @elseif($solicitacao->aprovado == 1)
                <p class="zb-green-color"><strong>Status da auditoria:</strong> aprovada</p>

                @elseif($solicitacao->aprovado == 2)
                <p class="zb-red-color"><strong>Status da auditoria:</strong> reprovada</p>
                @endif

                @if($solicitacao->mensagem)
                <br>
                <span><strong>Nota do auditor:</strong> {{ $solicitacao->mensagem }}</span>
                @endif

              </div>              

            </div>            
            
        </div>
    </div>

    <div class="row">

    	<div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger container-erros" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

    	<div class="col-md-12">
    		<div class="zb-white-container">
    			
    			@if($solicitacao->imagem)

    			<div class="row">
    			    <div class="col-md-12">
    			        <a href="{{ asset($solicitacao->imagem) }}" target="_blank" title="conta"><i class="fa fa-eye" aria-hidden="true"></i> ver imagem do histórico</a><br><br>
    			    </div>
    			</div>

    			@endif

			<form action="{{ route('atualizar_solicitacao') }}" method="post" enctype="multipart/form-data">

				@php $cf = 0; @endphp

                <input type="hidden" name="tipo" value="{{ $solicitacao->tipo }}">
                <input type="hidden" name="id_solicitacao" value="{{ $solicitacao->id }}">

    			@foreach($solicitacao->meses as $mes)

    			    <div class="row">

    			        <div class="col-md-12">
    			            <label {{ $mes->aprovado == 1 ? 'class=zb-green-color' : 'class=zb-red-color' }}>Mês {{ $mes->descricao }} ({{ $mes->aprovado == 1 ? 'aprovado' : 'reprovado' }}) &nbsp;</label>

    			                @if($mes->imagem)
    			                    <a href="{{ asset($mes->imagem) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> ver imagem da conta</a>
    			                @endif

    			            </label>
    			        </div>

    			    </div>

    			    <div class="row">
    			   
    			        @if($mes->aprovado == 2)
    			   			
    			   			<input type="hidden" name="meses_info[id][]" value="{{ $mes->id }}">
    			   			<input type="hidden" name="meses_info[desc][]" value="{{ $mes->descricao }}">

    			   			<div class="col-md-12">
	    			   			<div class="panel panel-default">
	    			   			  <div class="panel-body">

    			   			  	    <div class="well well-sm">{{ (int)$mes->kwh }} kWh</div>

    			   			  		<label>Motivo da reprovação</label>
    			   			  	    <div class="well well-sm">{{ $mes->mensagem }}</div>

	    			   			  	<hr>

	    			   			  	<h4>Por favor, atualize os dados deste mês</h4>

	    			   			  	<div class="form-group{{ $errors->has('mes_valor.'.$cf) ? ' has-error' : '' }}" >
	    			   			  		<label class="zb-orange-color">Consumo deste mês</label>
	    			   			  		<input class="form-control" type="number" name="mes_valor[]" placeholder="kWh" value="{{ old('mes_valor.'.$cf) }}">
	    			   			  	</div>

	    			   			  	@php $cf++; @endphp

	    			   			  	@if($solicitacao->tipo == 2)

	    			   			  	<br>	    			   			  	
	    			   			  	<label class="zb-orange-color">Selecione a imagem novamente</label>
	    			   			  	<input class="zb-input-contas" id="file_{{ $mes->descricao }}" type="file" name="imagem_{{ $mes->descricao }}" >
	    			   			  	<label for="file_{{ $mes->descricao }}"><span><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp;Escolha o arquivo</span></label>

	    			   			  	@endif
	    			   			  	
	    			   			  </div>
	    			   			</div>
	    			   		</div>
    			   			
    			   		@else

    			   			<div class="col-md-12">
    			   			    <div class="well well-sm">{{ (int)$mes->kwh }} kWh</div>
    			   			</div>

    			   		@endif    			        

    			    </div>

    			@endforeach  		


    			<br>
    			<div class="row zb-dashboard-centered">    		

    		    {{ csrf_field() }}                       
    		    <input type="hidden" name="_method" value="PUT">
    		    <button class="btn btn-success zb-btn-submit-pano" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> <strong>atualizar informações</strong></button>

    		</form>

    		</div>

    	</div>

    </div>

@endsection

@include('app.submit-loader')