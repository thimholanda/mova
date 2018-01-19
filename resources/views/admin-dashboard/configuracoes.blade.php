@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

@php

    $aprovados = $logotipos->filter(function ($value, $key) {
        return $value->aprovado == 1;
    });

    $reprovados = $logotipos->filter(function ($value, $key) {
        return $value->aprovado == 2;
    });

    $nao_avaliados = $logotipos->filter(function ($value, $key) {
        return $value->aprovado == 0;
    });

@endphp

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Configurações</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
          </div>
        </div>

        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <p>
                <i class="fa fa-file-image-o" aria-hidden="true"></i> <strong>Gerenciamento de usuários administrativos</strong>
            </p>

            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Nome do Usuário</th>
                            <th>E-mail</th>
                            <th>Perfil</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>
                                <td>
                                    <a href="{{ route('visualizar_usuario', $user->id) }}" title="{{ $user->name }}">{{ $user->name }}</a>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->roles->first()->description }}
                                </td>
                                <td class="{{ $user->ativo ? 'zb-usina-ativa' : 'zb-usina-inativa' }}">
                                    {{ $user->ativo ? 'ativo' : 'inativo' }}
                                </td>
                                <td style="text-align: right">
                                    <a class="zb-btn-green" href="{{ route('visualizar_usuario', $user->id) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                                <td style="text-align: right">

                                    @if($user->ativo)

                                    <form method="POST" action="{{ route('desativar_cliente') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="zb-btn-red" href="#" title="inativar cliente"><i class="fa fa-minus-circle" aria-hidden="true"></i></button> 
                                    </form>

                                    @else

                                    <form method="POST" action="{{ route('ativar_cliente') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="zb-btn-green" href="#" title="ativar cliente"><i class="fa fa-plus-circle" aria-hidden="true"></i></button> 
                                    </form>

                                    @endif

                                </td>                            
                            </tr>

                        @empty

                            <tr>
                                <td>
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>


                        @endforelse

                        

                    </tbody>

                </table>

                <br>

                <div class="row zb-dashboard-centered">
                    <a class="btn btn-success" href="{{ route('criar_usuario') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> <strong>Criar Usuário</strong></a>
                </div>

            </div>

        </div>

    </div>

    <br>
    <br>

    <div class="row">

        @if($logotipos->count() == 0)

            <div class="col-md-6">

                <p>
                    <i class="fa fa-file-image-o" aria-hidden="true"></i> <strong>Nenhum logotipo foi encontrado</strong>
                </p>

            </div>

        @endif

        @if($nao_avaliados->count() > 0)
        
            <div class="col-md-6">

                <p>
                    <i class="fa fa-file-image-o" aria-hidden="true"></i> <strong>Logotipos não avaliados</strong>
                </p>

                <div class="zb-white-container">             

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Nome da Empresa</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($nao_avaliados as $nao_avaliado)

                            <td>
                                {{ $nao_avaliado->user->name }}
                            </td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_logotipo', $nao_avaliado->id) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>      

                            @empty

                            <tr>Nenhum registro foi encontrado</tr>

                            @endforelse

                        </tbody>                 

                </div>
            </div>

        @endif

        @if($reprovados->count() > 0)
        
            <div class="col-md-6">

                <p>
                    <i class="fa fa-file-image-o" aria-hidden="true"></i> <strong style="color: #ba2020;">Logotipos reprovados</strong>
                </p>

                <div class="zb-white-container">             

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Nome da Empresa</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($reprovados as $nao_avaliado)

                            <td>
                                {{ $nao_avaliado->user->name }}
                            </td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_logotipo', $nao_avaliado->id) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>      

                            @empty

                            <tr>Nenhum registro foi encontrado</tr>

                            @endforelse

                        </tbody>                 

                </div>
            </div>
            
        @endif

        @if($aprovados->count() > 0)
        
            <div class="col-md-6">

                <p>
                    <i class="fa fa-file-image-o" aria-hidden="true"></i> <strong style="color: #449d44;">Logotipos Aprovados</strong>
                </p>

                <div class="zb-white-container">             

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Nome da Empresa</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($aprovados as $nao_avaliado)

                            <td>
                                {{ $nao_avaliado->user->name }}
                            </td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_logotipo', $nao_avaliado->id) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>      

                            @empty

                            <tr>Nenhum registro foi encontrado</tr>

                            @endforelse

                        </tbody>                 

                </div>
            </div>
            
        @endif

    </div>

</section>

@endsection



