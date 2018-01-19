@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/usinas') }} ">Usinas/ RECs</a> > Cadastrar Usina</h1>
        </div>
    </div>

    <div class="row">

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

        <div class="col-md-12">

            <p>
                <i class="fa fa-info-circle" aria-hidden="true"></i> <strong>Dados da Usina</strong>
            </p>

            <div class="zb-white-container">

                <form class="zb-loader-after-submit" method="post" action"{{ route('cadastro_usinas_action') }}">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label>Nome da Usina</label>
                                <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('inicio_operacao') ? ' has-error' : '' }}">
                                <label>Quando começou a operar</label>
                                <input type="date" class="form-control" name="inicio_operacao" value="{{ old('inicio_operacao') }}">
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <label>Fonte de Energia</label>
                            <select class="form-control{{ $errors->has('fonte_energia') ? ' has-error' : '' }}" name="fonte_energia">
                              <option>Eólica</option>
                              <option>Hídrica</option>
                              <option>Solar</option>
                              <option>Biomassa</option>                           
                            </select>

                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                <label>Endereço</label>
                                <input type="text" class="form-control" placeholder="Adicione uma localização" name="endereco">
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                <label>Latitude</label>
                                <input type="text" class="form-control" name="lat">
                            </div>

                        </div>
                    
                        <div class="col-md-6">

                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                <label>Longitude</label>
                                <input type="text" class="form-control" name="lng">
                            </div>

                        </div>

                    </div>

                    <div class="row zb-dashboard-centered">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary zb-btn-atualizar-mapa">Atualizar Mapa</button>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="zb-map-usina" id="zb-map-usina"></div>
                        </div>

                    </div>

                    <br>

                    <div class="row zb-dashboard-centered">

                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>confirmar cadastro</strong></button>

                    </div>
{{-- 
                    <input type="hidden" name="lat" value="">
                    <input type="hidden" name="lng" value=""> --}}

                </form>

            </div>
        </div>
        
    </div>

</section>

@include('app.submit-loader')

@endsection



