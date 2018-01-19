@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - FAQ')

@section('script')

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=oqe50whydl1v7eae2vni8mylqz7m899ymdzbqovr35odq6a7"></script>
<script>tinymce.init({ selector:'textarea', menubar:false, toolbar: 'bold,italic,underline' });</script>

@endsection

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/faq') }} ">FAQ</a> > Cadastrar Pergunta</h1>
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

            <div class="zb-white-container">

                <form class="zb-loader-after-submit" method="post" action"{{ route('cadastro_faq_action') }}">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                <label>Título da Pergunta</label>
                                <textarea class="form-control" name="titulo" rows="4">{{ old('titulo') }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('resposta') ? ' has-error' : '' }}">
                                <label>Resposta</label>
                                <textarea class="form-control" name="resposta" rows="10">{{ old('resposta') }}</textarea>
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

@include('app.submit-loader')

@endsection



