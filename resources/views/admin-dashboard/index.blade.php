@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">

        <div class="col-md-4">
            
            <h2><i class="fa fa-users" aria-hidden="true"></i> Clientes</h2>
            <span class="zb-destaque">{{ $count_usuarios }}</span>
            {{-- <p>
                <a href="{{ url('painel/usuario/minha-conta') }}" title="Ativar agora">Ver todos</a> os clientes. 
            </p> --}}

        </div>

        <div class="col-md-4">

            <h2><i class="fa fa-bolt" aria-hidden="true"></i> RECs alocados</h2>
            <span class="zb-destaque">{{ $rec_alocados->sum('quantidade') }}</span>
            {{-- <p>
                <a href="{{ url('painel/usuario/minha-conta') }}" title="Ativar agora">Ver todos</a> os RECs.
            </p> --}}
           
        </div>

        <div class="col-md-4">
           
            <h2><i class="fa fa-tachometer" aria-hidden="true"></i> Emissões Evitadas</h2>
            <span class="zb-destaque">

            @if($emissoes_evitadas != '')
                {{ $emissoes_evitadas }}<small>gCO<sub>2</sub></small>
            @else
                Não foi possível calcular
            @endif

            </span>
            
        </div>

    </div>

    <div class="row">
        <br>
        <br>
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

        @php

        $aguardando_itens = $solicitacoes->filter(function ($value)
        {
            return $value->aprovado == 0;
        });

        $aprovado_itens = $solicitacoes->filter(function ($value)
        {
            return $value->aprovado == 1;
        });

        $aprovado_divergente_itens = $solicitacoes->filter(function ($value)
        {
            return $value->aprovado == 3;
        });

        $reprovado_itens = $solicitacoes->filter(function ($value)
        {
            return $value->aprovado == 2;
        });

        @endphp


        @if($aguardando_itens->count() > 0)
        <div class="col-md-12">
            <h2><i class="fa fa-ticket" aria-hidden="true"></i> Solicitações de assinatura Premium - Aguardando Análise</h2>
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @forelse($aguardando_itens as $solicitacao)

                        <tr>
                            <td>{!! $solicitacao->atualizada ? '<span class=zb-orange-color>(Atualizada)</span> ' : '' !!}<a href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="{{ $solicitacao->user->name }}">{{ $solicitacao->user->name }}</a></td>
                            <td>R$ {{ str_replace('.', ',', $solicitacao->simulacao->preco) }}</td>
                            <td class="{{ $solicitacao->ativa ? 'zb-usina-ativa' : 'zb-usina-inativa' }}">{{ $solicitacao->ativa ? 'Ativa' : 'Inativa' }}</td>
                            <td>
                                    
                                @php

                                    switch ($solicitacao->pagamento_status) {
                                        case 0:
                                            echo 'aguardando';
                                            break; 

                                        case 1:
                                            echo 'aguardando';
                                            break;   

                                        case 2:
                                            echo 'em análise';
                                            break;

                                        case 3:
                                            echo 'aprovado';
                                            break;

                                        case 7:
                                            echo 'cancelado';
                                            break;                                  
                                    }

                                @endphp

                            </td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>                  
                        </tr>
                        
                        @empty

                        <tr>
                            <td>Nenhuma solicitação foi encontrada.</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>
        </div>
        @endif

        @if($reprovado_itens->count() > 0)
        <div class="col-md-12">
            <h2><i class="fa fa-ticket" aria-hidden="true"></i> Solicitações de assinatura Premium - <span class="zb-red-color">Reprovadas</span></h2>
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @forelse($reprovado_itens as $solicitacao)

                        <tr>
                            <td><a href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="{{ $solicitacao->user->name }}">{{ $solicitacao->user->name }}</a></td>
                            <td>R$ {{ str_replace('.', ',', $solicitacao->simulacao->preco) }}</td>
                            <td class="{{ $solicitacao->ativa ? 'zb-usina-ativa' : 'zb-usina-inativa' }}">{{ $solicitacao->ativa ? 'Ativa' : 'Inativa' }}</td>
                            <td>
                                    
                                @php

                                    switch ($solicitacao->pagamento_status) {
                                        case 0:
                                            echo 'aguardando';
                                            break; 

                                        case 1:
                                            echo 'aguardando';
                                            break;   

                                        case 2:
                                            echo 'em análise';
                                            break;

                                        case 3:
                                            echo 'aprovado';
                                            break;

                                        case 7:
                                            echo 'cancelado';
                                            break;                                  
                                    }

                                @endphp

                            </td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>                  
                        </tr>
                        
                        @empty

                        <tr>
                            <td>Nenhuma solicitação foi encontrada.</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>
        </div>
        @endif

        @if($aprovado_itens->count() > 0)
        <div class="col-md-12">
            <h2><i class="fa fa-ticket" aria-hidden="true"></i> Solicitações de assinatura Premium - <span class="zb-green-color">Aprovadas</span></h2>
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @forelse($aprovado_itens as $solicitacao)

                        <tr>
                            <td><a href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="{{ $solicitacao->user->name }}">{{ $solicitacao->user->name }}</a></td>
                            <td>R$ {{ str_replace('.', ',', $solicitacao->simulacao->preco) }}</td>
                            <td class="{{ $solicitacao->ativa ? 'zb-usina-ativa' : 'zb-usina-inativa' }}">{{ $solicitacao->ativa ? 'Ativa' : 'Inativa' }}</td>
                            <td>
                                    
                                @php

                                    switch ($solicitacao->pagamento_status) {
                                        case 0:
                                            echo 'aguardando';
                                            break; 

                                        case 1:
                                            echo 'aguardando';
                                            break;   

                                        case 2:
                                            echo 'em análise';
                                            break;

                                        case 3:
                                            echo 'aprovado';
                                            break;

                                        case 7:
                                            echo 'cancelado';
                                            break;                                  
                                    }

                                @endphp

                            </td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>                  
                        </tr>
                        
                        @empty

                        <tr>
                            <td>Nenhuma solicitação foi encontrada.</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>
        </div>
        @endif

        @if($aprovado_divergente_itens->count() > 0)
        <div class="col-md-12">
            <h2><i class="fa fa-ticket" aria-hidden="true"></i> Solicitações de assinatura Premium - <span class="zb-green-color">Aprovadas com divergências</span></h2>
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @forelse($aprovado_divergente_itens as $solicitacao)

                        <tr>

                            <td>
                                <a href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="{{ $solicitacao->user->name }}">{{ $solicitacao->user->name }}</a>
                            </td>


                            <td>
                                R$ {{ str_replace('.', ',', $solicitacao->simulacao->preco) }}

                                @if($solicitacao->boleto)
                                    | boleto extra ({{ $solicitacao->boleto->status_pagamento ? 'pago' : 'pendente'  }}) R$ {{ str_replace('.', ',', $solicitacao->boleto->valor) }}
                                @endif
                                
                            </td>


                            <td class="{{ $solicitacao->ativa ? 'zb-usina-ativa' : 'zb-usina-inativa' }}">{{ $solicitacao->ativa ? 'Ativa' : 'Inativa' }}</td>
                            <td>
                                    
                                @php

                                    switch ($solicitacao->pagamento_status) {
                                        case 0:
                                            echo 'aguardando';
                                            break; 

                                        case 1:
                                            echo 'aguardando';
                                            break;   

                                        case 2:
                                            echo 'em análise';
                                            break;

                                        case 3:
                                            echo 'aprovado';
                                            break;

                                        case 7:
                                            echo 'cancelado';
                                            break;                                  
                                    }

                                @endphp

                            </td>

                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ route('visualizar_solicitacao', ['id' => $solicitacao->id ] ) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>                       
                        </tr>
                        
                        @empty

                        <tr>
                            <td>Nenhuma solicitação foi encontrada.</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>
        </div>
        @endif

        <div class="col-md-12">
            <h2><i class="fa fa-comment" aria-hidden="true"></i> Mensagens</h2>
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Assunto</th>
                            <th>Data</th>
                            <th></th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>

                    <tbody>


                        @forelse($mensagens as $mensagem)

                        <tr>
                            <td><a href="{{ url('/painel/administrador/mensagens/visualizar', ['id' => $mensagem->id]) }}" title="{{ $mensagem->user->name }}">{{ $mensagem->user->name }}</a>&nbsp; {{ $mensagem->resposta ? '(respondida)' : '' }}</td>
                            <td>{{ $mensagem->assunto }}</td>
                            <td>{{ $mensagem->created_at->format('d/m/Y - H:i:s') }}</td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ url('/painel/administrador/mensagens/visualizar', ['id' => $mensagem->id]) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                            {{-- <td>
                                <form id="confirm-form" action="{{ route('excluir_mensagem_action', ['id' => $mensagem->id]) }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" title="excluir" data-toggle="modal" data-target="#confirm-delete" data-title="Excluir mensagem" data-message="Você tem certeza que deseja excluir esta mensagem?"><i class="fa fa-times-circle zb-usina-inativa" aria-hidden="true"></i></button>
                                </form>
                            </td>        --}}                    
                        </tr>
                        
                        @empty

                        <tr>
                            <td>Nenhuma mensagem foi encontrada.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>
        </div>
        
    </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p></p>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success btn-ok">Confirmar</a>
            </div>
        </div>
    </div>
</div>

@endsection



