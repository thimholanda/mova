@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Logs')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/clientes') }} ">Clientes ></a>  <a class="zb-breadcrumbs" href="{{ route('visualizar_cliente', $cliente->id) }} ">{{ $cliente->name }}</a> > Logs</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="zb-white-container">

                <div class="row">
                    <div class="col-md-12">
                        
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>Ação</th>
                                    <th>URL de referência</th>
                                    <th>Data</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($logs as $log)

                                <tr>
                                    <td><strong>{!! $log->mensagem !!}</strong></td>
                                    <td>

                                        @if($log->url)
                                            <a style="font-weight: normal;" href="{{ $log->url }}" title="{{ $log->url }}">{{ $log->url }}</a>
                                        @else
                                            --
                                        @endif

                                        

                                    </td>
                                    <td>{{ $log->created_at->format('d/m/Y - H:i:s') }}</td>
                                </tr>

                                @empty

                                <tr>Nenhum registro foi encontrado</tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>
                </div>               

            </div>
        </div>
        
    </div>

</section>

@endsection



