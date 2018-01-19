@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/usinas') }} ">Usinas/ RECs</a> > {{ $usina->nome }}</h1>
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

        <div class="col-md-6">

            <p>
                <i class="fa fa-info-circle" aria-hidden="true"></i> <strong>Dados da Usina</strong>
            </p>

            <div class="zb-white-container">

                <form action="{{ route('atualizar_usinas_action', ['id' => $usina->id]) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label>Nome da Usina</label>
                                <input type="text" class="form-control" value="{{ $usina->nome }}" name="nome">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('inicio_operacao') ? ' has-error' : '' }}">
                                <label>Quando começou a operar</label>
                                <input type="date" class="form-control" value="{{ $usina->inicio_operacao }}" name="inicio_operacao">
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <label>Fonte de Energia</label>
                            <select class="form-control{{ $errors->has('fonte_energia') ? ' has-error' : '' }}" name="fonte_energia">
                                <?php $opcoes = ['Eólica', 'Hídrica', 'Solar', 'Biomassa']; ?>

                                @foreach($opcoes as $opcao)
                                  <option {{ $opcao ==  $usina->fonte_energia ? 'selected' : '' }}>{{ $opcao }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control{{ $errors->has('endereco') ? ' has-error' : '' }}" placeholder="Adicione uma localização" value="{{ $usina->endereco }}" name="endereco">
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                <label>Latitude</label>
                                <input type="text" class="form-control" name="lat" value="{{ $usina->lat }}">
                            </div>

                        </div>
                    
                        <div class="col-md-6">

                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                <label>Longitude</label>
                                <input type="text" class="form-control" name="lng" value="{{ $usina->lng }}">
                            </div>

                        </div>

                    </div>

                    @can('administrador')

                        <div class="row zb-dashboard-centered">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary zb-btn-atualizar-mapa">Atualizar Mapa</button>
                            </div>
                        </div>

                    @elsecan('editor')

                        <div class="row zb-dashboard-centered">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary zb-btn-atualizar-mapa">Atualizar Mapa</button>
                            </div>
                        </div>

                    @endcan

                    <div class="row">
                        <br>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="zb-map-usina" id="zb-map-usina"></div>
                        </div>

                    </div>

                    <br>

                    @can('administrador')

                        <div class="row zb-dashboard-centered">
                            <button class="btn btn-success" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> <strong>atualizar dados</strong></button>
                        </div>

                    @elsecan('editor')

                        <div class="row zb-dashboard-centered">
                            <button class="btn btn-success" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> <strong>atualizar dados</strong></button>
                        </div>

                    @endcan

                    {{ csrf_field() }}
                    {{-- <input type="hidden" name="lat" value="{{ $usina->lat }}">
                    <input type="hidden" name="lng" value="{{ $usina->lng }}"> --}}

                </form>

            </div>
        </div>
        

        <div class="col-md-6">


            <p>
                <i class="fa fa-info-circle" aria-hidden="true"></i> <strong>RECs Alocados ({{ $rec_alocados->sum('quantidade') }})</strong>
            </p>

            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Nome do Usuário</th>
                            <th>RECs alocados</th>
                            <th>Lote Nº</th>
                            <th>Data de alocação dos RECs</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($rec_alocados as $rec)

                        <tr>
                            <td>{{ $rec->user->name }}</td>
                            <td>{{ $rec->quantidade }}</td>                  
                            <td>{{ $rec->rec_comprado_id }}</td>                  
                            <td>{{ $rec->created_at->format('d/m/Y') }}</td>                  
                        </tr>

                        @empty

                        <tr>
                            <td>Não existem RECs alocados</td>
                            <td></td>                  
                            <td></td>                  
                        </tr>

                        @endforelse
                    </tbody>

                </table>

            </div>
            <br>
            <p>

                <i class="fa fa-info-circle" aria-hidden="true"></i> <strong>RECs Cadastrados ({{ $usina->rec_comprados->sum('saldo') }})</strong>
            </p>
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Lote nº</th>
                            <th>Quant.</th>
                            <th>Saldo</th>
                            <th>Data</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>

                    <tbody>                        

                        @forelse($usina->rec_comprados->reverse() as $rec)

                            <tr>
                                <td>{{ $rec->id }}</td>
                                <td>{{ $rec->quantidade }}</td>
                                <td>{{ $rec->saldo }}</td>
                                <td>{{ Helper::dateFormat( $rec->created_at->todatestring() ) }}</td>
                                    {{-- <td>
                                    <form id="confirm-form" action="{{ route('excluir_recs_action', ['id_rec' => $rec->id, 'id_usina' => $usina->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button" title="excluir" data-toggle="modal" data-target="#confirm-delete" data-title="Excluir pacote de RECs" data-message="Você tem certeza que deseja excluir este pacote de RECs?"><i class="fa fa-times-circle zb-usina-inativa" aria-hidden="true"></i></button>
                                    </td> --}}
                                </form>                  
                                                 
                            </tr>

                        @empty

                            <tr>
                                <td>
                                    Não existem RECs cadastrados
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
            <br>
            <p>
                <i class="fa fa-info-circle" aria-hidden="true"></i> <strong>Saldo de RECs</strong>
            </p>
            <div class="zb-white-container">
                {{ $usina->recs_disponiveis }} RECs
            </div>
            <br>

            @can('administrador')

                @if($usina->ativa == 1)

                <form action="{{ route('inativar_usinas_action', ['id' => $usina->id]) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <label class="zb-usina-status-label zb-usina-status-label-green">Esta usina está <strong>ativa.</strong></label>
                    <button class="btn btn-danger" type="submit"><i class="fa fa-minus" aria-hidden="true"></i> <strong>inativar usina</strong></button>
                </form>

                @elseif($usina->ativa == 0)

                <form action="{{ route('ativar_usinas_action', ['id' => $usina->id]) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <label class="zb-usina-status-label zb-usina-status-label-red">Esta usina está <strong>inativa.</strong></label>
                    <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i> <strong>ativar usina</strong></button>
                </form>

                @endif

            @elsecan('editor')

                @if($usina->ativa == 1)

                <form action="{{ route('inativar_usinas_action', ['id' => $usina->id]) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <label class="zb-usina-status-label zb-usina-status-label-green">Esta usina está <strong>ativa.</strong></label>
                    <button class="btn btn-danger" type="submit"><i class="fa fa-minus" aria-hidden="true"></i> <strong>inativar usina</strong></button>
                </form>

                @elseif($usina->ativa == 0)

                <form action="{{ route('ativar_usinas_action', ['id' => $usina->id]) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <label class="zb-usina-status-label zb-usina-status-label-red">Esta usina está <strong>inativa.</strong></label>
                    <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i> <strong>ativar usina</strong></button>
                </form>

                @endif

            @endcan
            

        </div>


    </div>

    <br>
    <br>

    @can('administrador')

        <div class="row">

            <div class="col-md-12 zb-dashboard-centered">
                <a href="{{ url('painel/administrador/usinas/cadastro-recs', ['id' => $usina->id]) }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><span>Cadastrar RECs</span></a>
            </div>

        </div>

    @elsecan('editor')

        <div class="row">

            <div class="col-md-12 zb-dashboard-centered">
                <a href="{{ url('painel/administrador/usinas/cadastro-recs', ['id' => $usina->id]) }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><span>Cadastrar RECs</span></a>
            </div>

        </div>

    @endcan

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



