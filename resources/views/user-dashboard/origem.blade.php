@extends('templates.dashboard')

@section('title', 'Ziit Business - Origem de sua energia')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Origem de Sua Energia</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="zb-white-container">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Nome da Usina</th>
                            <th>Tipo de Energia</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @if($assinatura->usina)

                        <tr>
                            <td>{{ $assinatura->usina->nome }}</td>
                            <td>{{ $assinatura->usina->fonte_energia }}</td>
                            <td style="text-align: right"><a href="#" title="ver mais"><i class="fa fa-plus btn-dashboard-modal" aria-hidden="true"></i></a></td>
                        </tr>

                        @else
                            <tr>
                                <td>Nenhuma usina foi encontrada</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif

                    </tbody>

                </table>

                <div class="zb-dashboard-total">
                   <strong>Total de RECs utilizados: {{ $assinatura->rec_alocado->quantidade }} </strong>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="zb-white-container">

                <p>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <strong>Você deixou de emitir</strong>
                </p>

                <span class="zb-destaque">
                    @if($emissoes_evitadas != '')

                        {{ $emissoes_evitadas }} <small>tCO<sub>2</sub>/MWh</small>
                    @else
                        Não foi possível calcular
                    @endif 
                </span>
                <br>
                <p>
                    Parabéns, você está ajudando a transformar o planeta em um lugar melhor para todos nós!
                </p>

            </div>
        </div>
        
    </div>

    @cannot('is-premium')

    <div class="row">
        <br>
        <br>
    </div>

    <div class="row">

        <div class="col-md-12 zb-dashboard-centered">
            <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success zb-dashboard-activate"><i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Ative sua conta para poder escolher o tipo de energia</span></a>
        </div>

    </div>

    @endcannot

</section>

<div class="zb-dashboard-pano"></div>
<div class="zb-dashboard-modal">
    <button type="button" class="zb-close-dashboard-modal"><i class="fa fa-times" aria-hidden="true"></i></button>

    <div class="row">
        <div class="col-md-12">
            <span class="zb-title-dashboard-modal">{{ $assinatura->usina->nome }}</span>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <span class="zb-smalltitle-dashboard-modal">Endereço</span>
            <p>{{ $assinatura->usina->endereco }}</p>
        </div>

        <div class="col-md-6">
            <span class="zb-smalltitle-dashboard-modal">Fonte de Energia</span>
            <p>{{ $assinatura->usina->fonte_energia }}</p>
        </div>

    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="zb-map-origem" id="zb-map-origem"></div>
        </div>

    </div>

</div>

<script type="text/javascript">
    var lat = {{ $assinatura->usina->lat }};
    var lng = {{ $assinatura->usina->lng }};
</script>

@endsection



