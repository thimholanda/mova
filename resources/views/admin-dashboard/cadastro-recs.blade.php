@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/usinas') }} ">Usinas/ RECs ></a> <a class="zb-breadcrumbs" href=" {{ url('painel/administrador/usinas/visualizar', ['id' => $usina->id]) }} ">{{ $usina->nome }}</a> > Cadastrar RECs</h1>
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

        <div class="col-md-12">

            <div class="zb-white-container">

                <form action="{{ route('cadastro_recs_action' , ['id' => $usina->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('quantidade') ? ' has-error' : '' }}">
                                <label>Quantidade de RECs</label>
                                <input type="number" class="form-control" min="0" name="quantidade">
                            </div>

                        </div>
                    </div>

                    <br>

                    <div class="row zb-dashboard-centered">

                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>confirmar cadastro</strong></button>

                    </div>

                </form>

            </div>
        </div>
        
    </div>

</section>

@endsection



