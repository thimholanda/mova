@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('/painel/administrador/configuracoes') }}" title="Configurações">Configurações</a> > Criar usuário</h1>
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
    </div>

    <div class="row">

        <div class="zb-white-container">

            <div class="row">

                <div class="col-md-12">

                    <form action="{{ route('criar_usuario_action') }}" method="post">

                        {{  csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                    <label for="nome">Nome do usuário</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <label>Perfil</label>
                                <select class="form-control{{ $errors->has('perfil') ? ' has-error' : '' }}" name="perfil">
                                    <?php $opcoes = ['Editor' => 2, 'Consultor' => 6]; ?>

                                    @foreach($opcoes as $perfil => $valor)
                                      <option {{ old('perfil') ==  $valor ? 'selected' : ''}} value="{{ $valor }}">{{ $perfil }}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <br>

                        <div class="row zb-dashboard-centered">

                            <button class="btn btn-success zb-btn-submit-pano" type="submit"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>confirmar cadastro</strong></button>

                        </div>

                    </form>                    

                </div>

            </div>

        </div>        

    </div>

</section>


@include('app.submit-loader')

@endsection



