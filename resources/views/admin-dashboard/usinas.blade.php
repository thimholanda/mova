@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Usinas/ RECs</h1>
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
                            <th>Nome da Usina</th>
                            <th>RECs Disponíveis</th>
                            <th>Fonte de Energia</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($usinas as $usina)

                        <tr>
                            <td>{{ $usina->id }}</td>
                            <td><a href="{{ url('/painel/administrador/usinas/visualizar', ['id' => $usina->id]) }}" title="visualizar usina">{{ $usina->nome }}</a></td>
                            <td>{{ $usina->recs_disponiveis }}</td>
                            <td>{{ $usina->fonte_energia }}</td>                           
                            <td class="{{ $usina->ativa ? 'zb-usina-ativa' : 'zb-usina-inativa' }}" >{{ $usina->ativa ? 'Ativa' : 'Inativa' }}</td>                           
                            <td style="text-align: right">

                            @can('administrador')

                                <a class="zb-btn-green" href="{{ url('painel/administrador/usinas/cadastro-recs', ['id' => $usina->id]) }}" title="adicionar RECs"><i class="fa fa-plus" aria-hidden="true"></i> adicionar RECs</a> &nbsp;&nbsp;&nbsp;&nbsp; 

                            @elsecan('editor')

                                <a class="zb-btn-green" href="{{ url('painel/administrador/usinas/cadastro-recs', ['id' => $usina->id]) }}" title="adicionar RECs"><i class="fa fa-plus" aria-hidden="true"></i> adicionar RECs</a> &nbsp;&nbsp;&nbsp;&nbsp; 

                            @endcan

                                <a class="zb-btn-green" href="{{ url('/painel/administrador/usinas/visualizar', ['id' => $usina->id]) }}" title="visualizar usina"><i class="fa fa-eye" aria-hidden="true"></i></a></td>                           
                        </tr>

                        @empty

                        <tr>
                            <td><strong>Nenhuma usina foi encontrada.</strong></td>
                            <td></td>
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

        <div class="col-md-12 zb-dashboard-centered zb-paginate-widget">
            {{ $usinas->links() }}
        </div>
        
    </div>

    <div class="row">
        <br>
        <br>
    </div>

    <div class="row">

        @can('administrador')

        <div class="col-md-12 zb-dashboard-centered">
            <a href="{{ url('painel/administrador/usinas/cadastro') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Cadastrar Usina</span></a>
        </div>

        @elsecan('editor')

        <div class="col-md-12 zb-dashboard-centered">
            <a href="{{ url('painel/administrador/usinas/cadastro') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Cadastrar Usina</span></a>
        </div>

        @endcan

    </div>

</section>

@endsection



