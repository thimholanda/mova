@extends('templates.dashboard')

@section('title', 'Ziit Business - Contato')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Contato</h1>
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

            <form action="{{ route('contato_action') }}" method="post">

                {{ csrf_field() }}

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('assunto') ? ' has-error' : '' }}">

                            <label>Assunto</label>
                            <select class="form-control" name="assunto">
                              <option>Dúvida</option>
                              <option>Solicitação</option>
                              <option>Informar erro</option>
                              <option>Pagamento</option>
                              <option>Ativação da conta premium</option>
                            </select>

                        </div>

                    </div>

                </div>
                <br>
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('mensagem') ? ' has-error' : '' }}">

                            <label>Mensagem</label>
                            <textarea class="form-control" rows="5" name="mensagem">{{ old('mensagem') }}</textarea>
                        </div>
                    </div>

                </div>
                <br>
                <div class="row zb-dashboard-centered">

                    <button class="btn btn-success zb-btn-submit-pano" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> <strong>enviar mensagem</strong></button>

                </div>

            </form>

            </div>
        </div>
        
    </div> 

@if($contatos->count() > 0)

<br>
<br>

<div class="row">

    <div class="col-md-12">

        <h2>Respostas disponíveis</h2>

        <div class="zb-white-container">

            <table class="table">

                <thead>
                    <tr>
                        <th>Assunto</th>
                        <th>Mensagem</th>
                        <th>Resposta</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($contatos as $contato)

                    <tr>
                        <td>
                            {{ $contato->assunto }}
                        </td>
                        <td>
                            {{ substr($contato->mensagem, 0, 20) }}
                            @php
                                if( strlen($contato->mensagem) > 20 ) echo '...';
                            @endphp
                            
                        </td>

                        <td>
                            <a href="{{ route('resposta', ['id' => $contato->resposta->id]) }}" title="visualizar resposta">
                            {{ substr($contato->resposta->mensagem, 0, 20) }}
                            @php
                                if( strlen($contato->resposta->mensagem) > 20 ) echo '...';
                            @endphp
                            </a>
                        </td>

                        <td style="text-align: right"><a class="zb-btn-green" href="{{ route('resposta', ['id' => $contato->resposta->id]) }}" title="visualizar resposta"><i class="fa fa-eye" aria-hidden="true"></i></td> 
                    </tr>

                    @endforeach     
                </tbody>

            </table>                   

        </div>

    </div>        

</div>

@endif

@endsection

@include('app.submit-loader')



