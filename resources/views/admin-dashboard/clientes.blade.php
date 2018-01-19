@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Clientes</h1>
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
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>RECs alocados</th>
                            <th>Tipo da Conta</th>
                            <th>Status da Conta</th>
                            <th>Cliente desde</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $cl1 = false; @endphp

                        @foreach($users as $user)

                        @if($user->assinaturas && $user->assinaturas->count() >= 1)

                        @php $cl1 = true; @endphp

                        <?php

                            $assinatura = $user->assinaturas->filter(function ($value, $key) {
                                return $value->ativa == 1;
                            });
                        ?>

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('visualizar_cliente',  ['id' => $user->id]) }}" title="ver detalhes">{{ $user->name }}</a></td>
                            <td>{{ $user->recs_alocados->sum('quantidade') }}</td>
                            <td>{{ $assinatura->first()->tipo }}</td>
                            <td class="{{ $assinatura->first()->ativa ? 'zb-usina-ativa' : 'zb-usina-inativa' }}" >{{ $assinatura->first()->ativa ? 'Ativa' : 'Inativa' }}</td>                              
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>

                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_cliente',  ['id' => $user->id]) }}" title="ver detalhes"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>

                            <td style="text-align: right">

                                @can('administrador')

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

                                @endcan

                            </td>                            
                        </tr>

                        @endif

                        @endforeach

                        @if(!$cl1)

                        <tr>
                            <th><strong>Nenhum cliente foi encontrado</strong></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>

                        @endif


                    </tbody>

                </table>

            </div>
        </div>
        
    </div>

    <div class="row">
        <br>
        <br>
    </div>

    <div class="row">

        <div class="col-md-12">
            
            <h2><i class="fa fa-users" aria-hidden="true"></i> Clientes que não completaram o cadastro</h2>

            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Site</th>
                            <th>Responsável</th>
                            <th>Cadastrado desde</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $cl2 = false; @endphp

                        @foreach($users as $user)

                        @if($user->assinaturas && $user->assinaturas->count() == 0)

                        @php $cl2 = true; @endphp

                        <?php

                            $assinatura = $user->assinaturas->filter(function ($value, $key) {
                                return $value->ativa == 1;
                            });
                        ?>

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>                              
                            <td>{{ $user->email }}</td>                              
                            <td>{{ $user->userInfos->site_empresa }}</td>                              
                            <td>{{ $user->userInfos->nome_responsavel }}</td>                              
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>                            
                        </tr>                 

                        @endif

                        @endforeach

                        @if(!$cl2)

                        <tr>
                            <th><strong>Nenhum cliente foi encontrado</strong></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>

                        @endif


                    </tbody>

                </table>

            </div>
        </div>
        
    </div>

</section>

@endsection



