@extends('templates.dashboard')

@section('title', 'Ziit Business - FAQ')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">FAQ</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="zb-white-container">

                <div class="zb-dashboard-accordion">

                    @forelse($perguntas as $pergunta)

                    <h2>{!! $pergunta->titulo !!}<span>+</span></h2>
                    <div class="zb-resposta-users">{!! $pergunta->resposta !!}</div>

                    @empty

                    <p>Nenhuma pergunta foi encontrada.</p>

                    @endforelse                    

                </div>

            </div>
        </div>
        
    </div>

</section>

<div class="zb-dashboard-pano"></div>
<div class="zb-dashboard-modal">
    <button type="button" class="zb-close-dashboard-modal"><i class="fa fa-times" aria-hidden="true"></i></button>

    <div class="row">
        <div class="col-md-12">
            <span class="zb-title-dashboard-modal">SPE Ninho da Águia S.A.</span>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <span class="zb-smalltitle-dashboard-modal">Endereço</span>
            <p>End: Rod. Itajuba – Delfim Moreira, s/n – KM 8 - Delfim Moreira / MG</p>
        </div>

        <div class="col-md-6">
            <span class="zb-smalltitle-dashboard-modal">Fonte de Energia</span>
            <p>Hídrica</p>
        </div>

    </div>

    <div class="row">

        <div class="col-md-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.912363594838!2d-45.35265618522427!3d-22.469927328076896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cc9e3b65637a0f%3A0x68cbda7542ca6a4a!2sRestaurante+Ninho+da+%C3%81guia!5e0!3m2!1spt-PT!2sbr!4v1495604782513" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

    </div>

</div>

@endsection



