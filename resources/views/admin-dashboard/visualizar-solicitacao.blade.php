@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador') }}">Solicitação </a> > {{ $solicitacao->user->name}}</h1>
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

                @elseif($solicitacao->aprovado == 3)
                <p class="zb-red-color"><strong>Status da auditoria:</strong> aprovada com divergências</p>
                @endif

                @if($solicitacao->mensagem)
                <br>
                <p style="font-size: 1.4rem !important;"><strong>Mensagem de conclusão:</strong> {{ $solicitacao->mensagem }}</p>
                @endif

                @if($solicitacao->pagamento_status == 0)
                <hr>
                <p><strong>Status do pagamento:</strong> aguardando </p>
                <hr>

                @elseif($solicitacao->pagamento_status == 3)
                <hr>
                <p class="zb-green-color"><strong>Status do pagamento:</strong> confirmado </p>
                <hr>

                @endif


                @if($solicitacao->aprovado != 0)

                    @if($resultado > 0)

                        <p><strong>Totum deve emitir boleto no valor de:</strong> R$ {{ number_format($resultado, 2, ',', '.') }} </p>
                        <br>

                        @if(!$boleto->status_pagamento)

                        {{--  boleto não pago --}}

                        <form class="zb-confirmar-boleto-extra">

                            <div class="form-check form-check-inline">
                              <label class="form-check-label">
                                <input type="hidden" name="boleto_id" value="{{ $boleto->id }}">
                                <input style="-webkit-appearance: checkbox; -moz-appearance: checkbox; appearance: checkbox;" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1"> &nbsp; Marque esta opção para confirmar que o boleto foi pago.
                              </label>
                            </div>

                        </form>

                        @else

                        {{--  boleto pago --}}
                        <label class="zb-green-color">O boleto extra foi pago.</label>

                        @endif

                        <label class="zb-green-color zb-retorno-boleto" style="display: none;">O boleto extra foi pago.</label>

                        <hr>

                    @elseif($resultado < 0)

                        <p><strong>Totum deve reembolsar o valor de:</strong> R$ {{ number_format(abs($resultado), 2, ',', '.') }} </p>
                        <hr>

                    @endif

                @endif

                <span><strong>Total declarado pelo cliente:</strong> {{ ceil($solicitacao->simulacao->kwh) }} kWh/mês</span>

                <br>
                <span><strong>Valor a pagar:</strong> R$ {{ str_replace('.', ',', $solicitacao->simulacao->preco) }} </span>

                <br>
                <span><strong>Média baseada nos dados de consumo desta auditoria:</strong>  {{ $media_kwh }} kWh/mês</span>

                <br>
                <span><strong>Valor baseado nos dados de consumo desta auditoria: </strong> R$ {{ str_replace('.', ',', $preco->preco) }} </span>

              </div>
            </div>

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

        <div class="col-md-6">
            <h2><i class="fa fa-info-circle" aria-hidden="true"></i> Dados do usuário</h2>
            <div class="zb-white-container">

                <label>Nome do Usuário</label>
                <div class="well well-sm">{{ $solicitacao->user->name }}</div>

                <label>E-mail</label>
                <div class="well well-sm">{{ $solicitacao->user->email }}</div>

                <label>Nome do Responsável</label>
                <div class="well well-sm">{{ $solicitacao->user->userInfos->nome_responsavel }}</div>

                <label>Site da empresa</label>
                <div class="well well-sm">{{ $solicitacao->user->userInfos->site_empresa }}</div>

            </div>
        </div>

        <div class="col-md-6">
            <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Auditoria dos dados de consumo</h2>
            <div class="zb-white-container">

                @if($solicitacao->imagem)

                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ asset($solicitacao->imagem) }}" target="_blank" title="conta"><i class="fa fa-eye" aria-hidden="true"></i> ver imagem do histórico</a><br><br>
                    </div>
                </div>

                @endif

                @foreach($solicitacao->meses as $mes)

                    <div class="row">

                        <div class="col-md-12">
                            <label style="{{  $mes->atualizado == 1 ? 'color: #f08006;' : '' }}">{{ $mes->atualizado == 1 ? '(Atualizado) - ' : '' }} Mês {{ $mes->descricao }} </label>

                                @if($mes->imagem)
                                    <a href="{{ asset($mes->imagem) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> ver imagem da conta</a>
                                @endif

                            </label>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-9">
                            <div class="well well-sm">{{ (int)$mes->kwh }} kWh</div>
                        </div>

                        @if($solicitacao->aprovado == 0)

                        <div class="col-md-1">
                            <button data-mes="{{ $mes->id }}" type="button" class="zb-btn-auditoria zb-btn-auditoria-aprovacao {{ $mes->aprovado == 1 ? 'zb-green-color' : '' }}"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="zb-btn-auditoria zb-btn-auditoria-reprovacao {{ $mes->aprovado == 2 ? 'zb-red-color' : '' }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
                        </div>
                        <div style="{{ $mes->aprovado == 2 ? '' : 'display:none;' }}" class="zb-auditoria-resposta">

                            <div class="col-md-9">
                                <input type="text" style="{{ $mes->mensagem ? 'color:#ba2020 !important;' : '' }}" name="valor_retificado" value="{{ $mes->valor_retificado }}" placeholder="Insira o valor retificado do kWh" class="form-control">
                            </div>

                            <br>
                            <br>

                            <div class="col-md-9">
                                <input type="text" style="{{ $mes->mensagem ? 'color:#ba2020 !important;' : '' }}" name="motivo" value="{{ $mes->mensagem }}" placeholder="Insira o motivo da retificacão" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <button data-mes="{{ $mes->id }}" type="button" class="zb-confirmar-reprovacao">{{ $mes->aprovado == 2 ? 'atualizar' : 'confirmar' }}</button>
                            </div>

                        </div>

                        @endif

                        @if($solicitacao->aprovado == 3)

                        <div class="col-md-1">
                            {{-- <button style data-mes="{{ $mes->id }}" type="button" class="zb-btn-auditoria zb-btn-auditoria-aprovacao {{ $mes->aprovado == 1 ? 'zb-green-color' : '' }}"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button> --}}
                        </div>

                        <div class="col-md-1">
                            {{-- <button type="button" class="zb-btn-auditoria zb-btn-auditoria-reprovacao {{ $mes->aprovado == 2 ? 'zb-red-color' : '' }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button> --}}
                        </div>
                        <div style="{{ $mes->aprovado == 2 ? '' : 'display:none;' }}" class="zb-auditoria-resposta">

                            <div class="col-md-9">
                                <input type="text" style="{{ $mes->mensagem ? 'color:#ba2020 !important;' : '' }}" name="valor_retificado" value="{{ $mes->valor_retificado }}" placeholder="Insira o valor retificado do kWh" class="form-control">
                            </div>

                            <br>
                            <br>

                            <div class="col-md-9">
                                <input type="text" style="{{ $mes->mensagem ? 'color:#ba2020 !important;' : '' }}" name="motivo" value="{{ $mes->mensagem }}" placeholder="Insira o motivo da retificacão" class="form-control">
                            </div>

                            <div class="col-md-2">
                                {{-- <button data-mes="{{ $mes->id }}" type="button" class="zb-confirmar-reprovacao">{{ $mes->aprovado == 2 ? 'atualizar' : 'confirmar' }}</button> --}}
                            </div>

                        </div>

                        @endif



                    </div>

                @endforeach

                @if($solicitacao->aprovado == 0 || $solicitacao->aprovado == 2)

                <br>
                <div class="row zb-dashboard-centered">

                <form class="zb-loader-after-submit" action="{{ route('aprovar_solicitacao', ['id' => $solicitacao->id ]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    @can('administrador')

                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirm-delete" data-title="Aprovar Solicitação" data-message="Você tem certeza que deseja finalizar esta auditoria?"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>finalizar auditoria</strong></button>

                    <hr>

                    <div class="form-group{{ $errors->has('mensagem') ? ' has-error' : '' }}">
                        <label><i class="fa fa-comment" aria-hidden="true"></i> Mensagem de conclusão | será exibida ao cliente apenas em casos de divergências (opcional):</label>
                        <textarea class="form-control" name="mensagem">{{ $solicitacao->aprovado == 2 ? $solicitacao->mensagem : '' }} </textarea>
                    </div>

                    @elsecan('editor')

                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirm-delete" data-title="Aprovar Solicitação" data-message="Você tem certeza que deseja finalizar esta auditoria?"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>finalizar auditoria</strong></button>

                    <hr>

                    <div class="form-group{{ $errors->has('mensagem') ? ' has-error' : '' }}">
                        <label><i class="fa fa-comment" aria-hidden="true"></i> Mensagem de conclusão | será exibida ao cliente apenas em casos de divergências (opcional):</label>
                        <textarea class="form-control" name="mensagem">{{ $solicitacao->aprovado == 2 ? $solicitacao->mensagem : '' }} </textarea>
                    </div>

                    @endcan

                </form>

                @endif

            </div>

            {{-- @if($solicitacao->aprovado == 0)

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <br>
                    <form class="zb-loader-after-submit" action="{{ route('reprovar_solicitacao', ['id' => $solicitacao->id ]) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group{{ $errors->has('mensagem') ? ' has-error' : '' }}">
                            <label><i class="fa fa-comment" aria-hidden="true"></i> Mensagem de conclusão | será exibida ao cliente apenas em casos de divergências (opcional):</label>
                            <textarea class="form-control" name="mensagem">{{ $solicitacao->aprovado == 2 ? $solicitacao->mensagem : '' }} </textarea>
                            <br>
                            <div class="row zb-dashboard-centered">
                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirm-delete" data-title="Reprovar Solicitação" data-message="Você tem certeza que deseja reprovar esta solicitação?"><i class="fa fa-times" aria-hidden="true"></i> <strong>reprovar solicitação</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endif --}}

        </div>

    </div>

</section>

@include('app.confirm-modal')
@include('app.submit-loader')

@endsection
