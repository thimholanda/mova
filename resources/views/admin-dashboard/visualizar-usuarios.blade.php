@extends('templates.admin-dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/administrador/configuracoes') }} ">Usuários</a> > {{ $user->name }}</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="zb-white-container">

                <div class="row">
                    <div class="col-md-12">
                        <label>Nome do usuário</label>
                        <div class="well well-sm">{{ $user->name }}</div>

                        <label>E-mail do usuário</label>
                        <div class="well well-sm">{{ $user->email }}</div>

                        <label>Perfil</label>
                        <div class="well well-sm">{{ $user->roles->first()->description }}</div>
                    </div>
                </div>               

            </div>
        </div>
        
    </div>

    <br>
    <br>

    <div class="row">

        <div class="col-md-12">

                <div class="row zb-dashboard-centered">

                    <a href="mailto:{{ $user->email }}?subject=[Ziit Business] Contato" class="btn btn-success" target="_self"><i class="fa fa-paper-plane" aria-hidden="true"></i> <strong>enviar email</strong></a>
                    <span>&nbsp;</span>

                    <form action="{{ route('excluir_usuario_action') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" data-title="Excluir Usuário" data-message="Você tem certeza que deseja excluir este usuário?"><i class="fa fa-times" aria-hidden="true"></i> <strong>excluir usuário</strong></button>
                    </form>
                    
                </div>

        </div>

    </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p></p>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success btn-ok">Confirmar</a>
            </div>
        </div>
    </div>
</div>

@endsection



