@extends('templates.dashboard')

@section('title', 'Ziit Business - Minha Conta')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Minha conta</h1>
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
                <div class="alert alert-danger container-erros" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-md-6">

            <div class="zb-white-container">

            <form action="{{ route('atualizar_dados') }}" method="post">

                {{  csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="row">

                    <div class="col-md-12">

                        <label>Site da empresa</label>
                        <div class="well well-sm">{{ $user->userInfos->site_empresa }}</div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('nome_empresa') ? ' has-error' : '' }}">
                            <label for="nome_empresa">Nome da empresa</label>
                            <input type="text" class="form-control" id="nome_empresa" value="{{ $user->userInfos->nome_empresa }}" name="nome_empresa">
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('nome_responsavel') ? ' has-error' : '' }}">
                            <label for="nome_responsavel">Nome do responsável</label>
                            <input type="text" class="form-control" id="nome_responsavel" value="{{ $user->userInfos->nome_responsavel }}" name="nome_responsavel">
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email_responsavel">E-mail</label>
                            <input type="email" class="form-control" id="email_responsavel" value="{{ $user->email }}" name="email">
                        </div>

                    </div>

                </div>

                <br>
                <div class="row zb-dashboard-centered">

                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> <strong>atualizar informações</strong></button>

                </div>

            </form>

            </div>
        </div>

        <div class="col-md-6">

            <div class="zb-white-container">

                @cannot('is-premium')

                    @if($solicitacao)

                        @if($solicitacao->pagamento_status != 3)

                        <p><strong>Você possui uma solicitação para ativação de conta premium. Ela será auditada após o pagamento.</strong></p>

                        @endif

                        <p><strong>Investimento:</strong> R$ {{ str_replace('.', ',', $solicitacao->simulacao->preco) }}</p>

                        <div class="panel panel-default zb-panel-retorno-solicitacao">
                            <div class="panel-body">

                                @if(!$solicitacao->pagamento_status)
                                    <form action="{{ route('pagar_solicitacao', ['id' => $solicitacao->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <a class="btn btn-success btn-pagamento-pagseguro" type="submit" href="{{ $solicitacao->pagamento_link }}" target="_blank"><i class="fa fa-check" aria-hidden="true"></i> <strong>Pagar agora</strong></a>
                                    </form>
                                @else

                                    @php

                                        switch ($solicitacao->pagamento_status) {
                                            case 0:
                                                echo '<span><strong class="zb-green-color">Aguardando Pagamento</strong></span><i>Efetue o pagamento para que sua solicitação seja auditada.</i><br>';
                                                break;

                                            case 1:
                                                echo '<span><strong class="zb-green-color">Aguardando Pagamento</strong></span><i>Efetue o pagamento para que sua solicitação seja auditada.</i><br>';
                                                break;

                                            case 2:
                                                echo '<span><strong class="zb-green-color">Pagamento em Análise</strong></span><i>Seu pagamento está em análise.</i><br>';
                                                break;

                                            case 3:
                                                echo '<span><strong class="zb-green-color">Pagamento Confirmado</strong></span><i>Sua solicitação foi encaminhada para auditoria.</i><br>';
                                                break;

                                            case 7:
                                                echo '<span><strong class="zb-green-color">Pagamento Cancelado</strong></span><i>Sua solicitação será encaminhada para auditoria após o pagamento.</i><br>';
                                                break;
                                        }

                                    @endphp

                                @endif

                            </div>
                        </div>


                        @if($solicitacao->aprovado == 0)


                        <div class="panel panel-default zb-panel-retorno-solicitacao">
                          <div class="panel-body">
                            <span><strong>Status da solicitação:</strong> aguardando análise</span>


                            @php

                                switch ($solicitacao->pagamento_status) {
                                    case 0:
                                        echo '<i>Sua solicitação será encaminhada para auditoria após o pagamento.</i>';
                                        break;

                                    case 1:
                                        echo '<i>Sua solicitação será encaminhada para auditoria após o pagamento.</i>';
                                        break;

                                    case 2:
                                        echo '<i>Sua solicitação será encaminhada para auditoria após o análise de seu pagamento.</i>';
                                        break;

                                    case 3:
                                        echo '<i>Sua solicitação foi encaminhada para auditoria.</i>';
                                        break;

                                    case 7:
                                        echo '<i>Sua solicitação será encaminhada para auditoria após o pagamento.</i>';
                                        break;
                                }

                            @endphp

                          </div>
                        </div>



                        @elseif($solicitacao->aprovado == 1 || $solicitacao->aprovado == 3)

                        <div class="panel panel-default zb-panel-retorno-solicitacao">
                          <div class="panel-body">

                            <span class="zb-green-color">
                                <strong>Status da solicitação:</strong>

                                @if($solicitacao->aprovado == 1)
                                    <br>
                                    aprovada
                                @else
                                    <br>
                                    <div style="font-size: 1.5rem;">aprovada com divergências</div>
                                @endif

                                @if($solicitacao->mensagem)
                                  <div style="font-size: 1.5rem; color: #616263; margin-top: 10px;"><strong>Mensagem do auditor: </strong>{{$solicitacao->mensagem}}</div>
                                @endif

                            </span>

                            {{-- @if($solicitacao->aprovado == 3) --}}

                                @if($resultado > 0)

                                    @if($boleto)

                                        @if(!$boleto->status_pagamento)

                                            <p style="text-align: center;"><strong class="zb-orange-color" style="font-size: 1.8rem;">Você deve pagar a diferença no valor de:</strong> <strong style="font-size: 1.8rem;">R$ {{ number_format($resultado, 2, ',', '.') }}</strong>
                                            <br>Enviaremos o boleto por e-mail.</p>

                                        @else

                                            <p style="text-align: center;"><strong class="zb-green-color" style="font-size: 1.8rem;">O pagamento do boleto extra no valor de: R$ {{ number_format($resultado, 2, ',', '.') }} foi confirmado.</strong><br>

                                        @endif

                                    @else

                                        <p style="text-align: center;"><strong class="zb-orange-color" style="font-size: 1.8rem;">Você deve pagar a diferença no valor de:</strong> <strong style="font-size: 1.8rem;">R$ {{ number_format($resultado, 2, ',', '.') }}</strong>
                                        <br>Enviaremos o boleto por e-mail.</p>

                                    @endif

                                @elseif($resultado < 0)

                                    <p style="text-align: center;"><strong>Devemos reembolsar o valor de:</strong> R$ {{ number_format(abs($resultado), 2, ',', '.') }}.<br> Entraremos em contato em breve.</p>
                                    <hr>

                                @endif

                                {{-- <span>
                                    <strong>Conclusão da auditoria:</strong><br>
                                    <div style="font-size: 1.5rem;">{{ $solicitacao->mensagem }}</div>
                                </span>

                                <span>
                                    <div style="font-size: 1.5rem;">Você receberá um boleto no valor de R$ 00,00</div>
                                </span> --}}

                            {{-- @endif --}}

                            @if($solicitacao->pagamento_status == 3)

                                @if($boleto)

                                    @if($boleto->status_pagamento)
                                        <br>
                                        <strong>Escolha o tipo de energia para ativar sua conta:</strong>
                                        <hr>

                                        <div class="zb-escolha-energia">

                                            @forelse($usinas as $usina)

                                            <form action="{{ route('ativar_conta_premium') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="tipo" value="{{ str_slug($usina->fonte_energia) }}">
                                                <input type="hidden" name="quantidade_recs" value="{{ $recs }}">
                                                <label>{{ $usina->fonte_energia }}</label>
                                                <button type="submit"><i class="zb-energy zb-{{ str_slug($usina->fonte_energia) }}"></i></button>
                                            </form>

                                            @empty

                                            <p>Nenhuma Usina está disponível no momento</p>

                                            @endforelse

                                        </div>

                                    @endif

                                @endif

                            @else

                                Você poderá ativar sua conta premium após a confirmação do pagamento.

                            @endif


                        </div>


                        @elseif($solicitacao->aprovado == 2)

                        <div class="panel panel-default zb-panel-retorno-solicitacao">
                          <div class="panel-body">
                            <span class="zb-red-color"><strong>Status da solicitação:</strong> reprovada</span>
                            <a href="{{ route('revisar_solicitacao', ['id' => $solicitacao->id ]) }}" class="btn btn-primary">Revisar solicitação</a>
                          </div>
                        </div>

                        @endif

                    @else
                    <a href="{{ route('ativar_premium') }}" class="btn btn-success zb-btn-dashboard-call"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ativar conta premium</a>
                    @endif

                @endcannot

                @can('is-premium')

                <div class="panel panel-default zb-panel-retorno-solicitacao">
                    <div class="panel-body">
                        <span><strong>Sua conta Premium está ativada.</strong></span>
                        <p style="text-align: center;">Sua assinatura expirará em: {{ Helper::dateTimeCreate($assinatura->validade)->format('d/m/Y - H:i:s') }}</p>
                        <p style="text-align: center;"><strong>A fonte de energia selecionada é:</strong></p>
                        <div class="zb-icone-selecionado-user">
                            <i class="zb-energy zb-{{ str_slug($assinatura->usina->fonte_energia) }}"></i>
                            <p>{{ $assinatura->usina->fonte_energia }}</p>
                        </div>

                    </div>
                </div>


                @endcan

                </div>

            </div>

        </div>

    </div>

    <br>
    <br>

    <div class="row">

        <div class="col-md-6">

            <div class="zb-white-container">
                <label>Insira o logotipo de sua empresa. Ele poderá ser exibido na página inicial do Mova.</label>
                <br>
                <br>
                <form action="{{ route('adicionar_logotipo') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input class="zb-input-contas" id="conta" type="file" name="logotipo">
                    <label for="conta"><span><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp;clique aqui e selecione o arquivo</span></label>

                    @if($logotipo)

                    <img style="max-width: 100%; border: 1px solid #ddd;" src="{{  asset($logotipo->logotipo) }}" alt="">

                    @endif

                    <br>
                    <br>
                    <div class="row zb-dashboard-centered">
                        <button class="btn btn-success zb-btn-submit-pano" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> <strong>{{ !$logotipo ? 'adicionar logotipo' : 'atualizar logotipo' }}</strong></button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</section>

@include('app.submit-loader')

<script type="text/javascript">

    @if( Session::has('link_pagamento') )

    var link_pagamento = "{{ Session::get('link_pagamento') }}"

    @endif

</script>

@endsection
