@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Mensagens</h1>
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
                            <td><a href="{{ url('/painel/administrador/mensagens/visualizar', ['id' => $mensagem->id]) }}" title="{{ $mensagem->user->name }}">{{ $mensagem->user->name }}</a> &nbsp; {{ $mensagem->resposta ? '(respondida)' : '' }}</td>
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
                            </td>   --}}                         
                        </tr>
                        
                        @empty

                        <tr>
                            <th><strong>Nenhuma mensagem foi encontrada.</strong></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
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



