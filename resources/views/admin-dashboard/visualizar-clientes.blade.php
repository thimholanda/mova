@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/clientes') }} ">Clientes</a> > {{ $cliente->name }}</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="zb-white-container">

                <div class="row">
                    <div class="col-md-12">
                        <label>Nome do Cliente</label>
                        <div class="well well-sm">{{ $cliente->name }}</div>

                        <label>Nome do Responsável</label>
                        <div class="well well-sm">{{ $cliente->userInfos->nome_responsavel }}</div>

                        <label>E-mail</label>
                        <div class="well well-sm">{{ $cliente->email }}</div>

                        <label>Nome da empresa</label>
                        <div class="well well-sm">{{ $cliente->userInfos->nome_empresa }}</div>

                        <label>Site da empresa</label>
                        <div class="well well-sm">{{ $cliente->userInfos->site_empresa }}</div>

                        <label>Usuário desde</label>
                        <div class="well well-sm">{{ $cliente->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>               

            </div>
        </div>
        
    </div>

    <br>
    <br>

    <div class="row">

     <div class="col-md-12">

        <div class="zb-white-container">

        <div class="row">
            <div class="col-md-4">
                <label>Tipo da Conta</label>
                <div class="well well-sm">{{ title_case($cliente->assinatura_ativa->first()->tipo) }}</div>
            </div>

            <div class="col-md-4">
                <label>Energia Selecionada</label>
                <div class="well well-sm">{{ $cliente->assinatura_ativa->first()->usina->fonte_energia }}</div>
            </div>

            <div class="col-md-4">
                <label>Conta válida até</label>
                <div class="well well-sm">{{ Helper::dateTimeCreate($cliente->assinatura_ativa->first()->validade)->format('d/m/Y') }}</div>
            </div>

            <div class="col-md-6">
                <label>Quantidade de RECs alocados</label>
                <div class="well well-sm">{{ $cliente->recs_alocados->sum('quantidade') }}</div>
            </div>

            <div class="col-md-6">
                <label>Usina fornecedora dos RECs</label>
                <div class="well well-sm">{{ $cliente->assinatura_ativa->first()->usina->nome }}</div>
            </div>
        </div>

    </div>


    <br>
    <br>

    <div class="row">

        <div class="col-md-12">

                <div class="row zb-dashboard-centered">
                    <a href="mailto:{{ $cliente->email }}?subject=[Ziit Business] Contato" class="btn btn-success" target="_self"><i class="fa fa-paper-plane" aria-hidden="true"></i> <strong>enviar email</strong></a>
                    <span>&nbsp;</span>
                    <a href="{{ route('visualizar_logs', $cliente->id) }}" class="btn btn-success" target="_self"><i class="fa fa-eye" aria-hidden="true"></i> <strong>visualizar logs</strong></a>
                </div>

        </div>

    </div>

</section>

@endsection



