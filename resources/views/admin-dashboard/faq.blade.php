@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - FAQ')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">FAQ</h1>
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
                            <th>Título da pergunta</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="zb-sortable-table">

                        @forelse($perguntas as $pergunta)

                        <tr id="faq_{{ $pergunta->id }}">
                            <td><a style="text-decoration: none; font-weight: 400" href="{!! url('/painel/administrador/faq/atualizar', ['id' => $pergunta->id]) !!}" title="{{ $pergunta->titulo }}">{!! $pergunta->titulo !!}</a></td>
                            <td style="text-align: right">
                                <a class="zb-btn-green" href="{{ url('/painel/administrador/faq/atualizar', ['id' => $pergunta->id]) }}" title="visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>

                            @can('administrador')

                                <td>
                                    <form id="confirm-form" action="{{ route('excluir_faq_action', ['id' => $pergunta->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button" title="excluir" data-toggle="modal" data-target="#confirm-delete" data-title="Excluir pergunta" data-message="Você tem certeza que deseja excluir esta pergunta?"><i class="fa fa-times-circle zb-usina-inativa" aria-hidden="true"></i></button>
                                    </form>
                                </td>

                            @elsecan('editor')

                                <td>
                                    <form id="confirm-form" action="{{ route('excluir_faq_action', ['id' => $pergunta->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button" title="excluir" data-toggle="modal" data-target="#confirm-delete" data-title="Excluir pergunta" data-message="Você tem certeza que deseja excluir esta pergunta?"><i class="fa fa-times-circle zb-usina-inativa" aria-hidden="true"></i></button>
                                    </form>
                                </td>

                            @endcan

                        </tr>

                        @empty                        

                        <tr>
                            <td><strong>Nenhuma pergunta foi encontrada.</strong></td>
                            <td></td>
                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>
        </div>
        
    </div>

    <div class="row">
        <br>
        <br>
    </div>

    @can('administrador')

        <div class="row">

            <div class="col-md-12 zb-dashboard-centered">
                <a href="{{ url('/painel/administrador/faq/cadastro') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Cadastrar Pergunta</span></a>
            </div>

        </div>

    @elsecan('editor')

        <div class="row">

            <div class="col-md-12 zb-dashboard-centered">
                <a href="{{ url('/painel/administrador/faq/cadastro') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Cadastrar Pergunta</span></a>
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



