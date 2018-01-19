@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('/painel/administrador/configuracoes') }}" title="Configurações">Configurações</a> > Logotipo ({{ $logotipo->user->name }})</h1>
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

        <div class="zb-white-container">

            <div class="row zb-dashboard-centered">
                <div class="col-md-12">
                    <img style="width: 50%; border: 1px solid #ddd;" src="{{ asset($logotipo->logotipo) }}" alt="">
                    <br>
                    <br>

                    @if($logotipo->aprovado == 0)

                        <form action="{{ route('atualizar_logotipo') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="logotipo_id" value="{{ $logotipo->id }}">
                            <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i> <strong>Aprovar</strong></button>
                        </form>

                        <form action="{{ route('atualizar_logotipo') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="status" value="2">
                            <input type="hidden" name="logotipo_id" value="{{ $logotipo->id }}">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-times" aria-hidden="true"></i> <strong>Reprovar</strong></button>
                        </form>

                    @elseif($logotipo->aprovado == 1)

                        <form action="{{ route('atualizar_logotipo') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="status" value="2">
                            <input type="hidden" name="logotipo_id" value="{{ $logotipo->id }}">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-times" aria-hidden="true"></i> <strong>Reprovar</strong></button>
                        </form>

                    @elseif($logotipo->aprovado == 2)

                        <form action="{{ route('atualizar_logotipo') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="logotipo_id" value="{{ $logotipo->id }}">
                            <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i> <strong>Aprovar</strong></button>
                        </form>

                    @endif

                </div>
            </div>

        </div>

        

    </div>

</section>

@endsection



