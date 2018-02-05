@extends('layouts.app')

    @section('title', 'Definir Senha')

    @section('content')

    <section class="zb-regular-section">

        <div class="zb-content" style="text-align: center; padding: 0 3%;">
        <h1 class="zb-regular-title">Defina sua senha</h1>
        <p class="lead">
            Defina sua senha abaixo para começar usar <strong>o Mova</strong>.
        </p>
            
            <div class="zb-container-form">
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
                        <form class="form-horizontal zb-loader-after-submit" role="form" method="POST" action="{{ route('action-criar-senha') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Senha</label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                               
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="control-label">Confirme a senha</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>Definir Senha</strong>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>        

    </section>

    
    @include('app.submit-loader')
    	

    @endsection