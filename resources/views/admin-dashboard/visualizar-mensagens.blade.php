@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/mensagens') }} ">Mensagens</a> > Mensagem {{ $mensagem->id }}</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="zb-white-container">

                <label>Nome do Cliente</label>
                <div class="well well-sm">{{ $mensagem->user->name }}</div>

                <label>Nome do Responsável</label>
                <div class="well well-sm">{{ $mensagem->user->userInfos->nome_responsavel }}</div>

                <label>E-mail</label>
                <div class="well well-sm">{{ $mensagem->user->email }}</div>

                <label>Assunto</label>
                <div class="well well-sm">{{ $mensagem->assunto }}</div>

                <label>Mensagem</label>
                <div class="well well-lg">{{ $mensagem->mensagem }}</div>

            </div>
        </div>
        
    </div>

    <br>
    <br>

    <div class="row">

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

        <div class="col-md-12">
          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
          </div>
        </div>

        @can('administrador')

            <div class="col-md-12">

                <div class="zb-white-container">

                    @if(!$mensagem->resposta)

                    <form action="{{ route('responder_cliente') }}" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="contato_id" value="{{ $mensagem->id }}">
                        <input type="hidden" name="user_id" value="{{ $mensagem->user->id }}">
                        <div class="form-group{{ $errors->has('resposta') ? ' has-error' : '' }}">
                            <label for="resposta">Utilize o campo abaixo para responder a esta mensagem</label>
                            <textarea id="resposta" name="resposta" rows="7" class="form-control"></textarea>
                        </div>
                        <br>
                        <div class="row zb-dashboard-centered">
                            <button class="btn btn-success zb-btn-submit-pano" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> <strong>responder mensagem</strong></button>
                        </div>

                    </form>

                    @else

                    <label>Resposta enviada ao cliente</label>
                    <div class="well well-sm">{{ $mensagem->resposta->mensagem }}</div>

                    @endif

                </div>

            </div>

        @elsecan('editor')

            <div class="col-md-12">

                <div class="zb-white-container">

                    @if(!$mensagem->resposta)

                    <form action="{{ route('responder_cliente') }}" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="contato_id" value="{{ $mensagem->id }}">
                        <input type="hidden" name="user_id" value="{{ $mensagem->user->id }}">
                        <div class="form-group{{ $errors->has('resposta') ? ' has-error' : '' }}">
                            <label for="resposta">Utilize o campo abaixo para responder a esta mensagem</label>
                            <textarea id="resposta" name="resposta" rows="7" class="form-control"></textarea>
                        </div>
                        <br>
                        <div class="row zb-dashboard-centered">
                            <button class="btn btn-success zb-btn-submit-pano" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> <strong>responder mensagem</strong></button>
                        </div>

                    </form>

                    @else

                    <label>Resposta enviada ao cliente</label>
                    <div class="well well-sm">{{ $mensagem->resposta->mensagem }}</div>

                    @endif

                </div>

            </div>

        @endcan

    </div>

</section>

@include('app.submit-loader')

@endsection



