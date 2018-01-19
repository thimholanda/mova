@extends('templates.dashboard')

@section('title', 'Ziit Business - Meus Produtos')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title">Meus Produtos</h1>
        </div>
    </div>

   @can('is-premium')

    <div class="row">
        
    <div class="col-md-12">
            <h2><i class="fa fa-code" aria-hidden="true"></i> Script de assinatura premium (duração de 12 meses)</h2>
            <div class="zb-white-container">

                <span>

                    &lt;script type="text/javascript"&gt; 
                    var _ziitData = _ziitData || [];
                    _ziitData.push(['_setAccount', {{ $assinatura->id }}]);
                    (function() {
                          var zb = document.createElement('script');
                          zb.type = 'text/javascript';
                          zb.async = true;
                          zb.src = ("{{ url('/') }}/js/ziit-signature.js");
                          var s = document.getElementsByTagName('script')[0];
                          s.parentNode.insertBefore(zb, s);

                    })();
                    &lt;/script&gt;
                    &lt;div class="zb-assinatura-ziit-embed"&gt;&lt;/div&gt;

                </span>

                <p class="zb-info">
                    Este script permite a inserção de uma assinatura em seu site que comprovará a utilização de energia de fontes renováveis pela sua empresa. Basta copiar e colar este script em seu site, diretamente no código HTML da página. <strong>Importante: </strong> não insira este script por meio de editores de textos. (solicite a inserção para o responsável da área técnica de sua empresa.) <a href="#" data-featherlight="{{ asset('img/exemplo-assinatura.gif') }}" alt="Exemplo de assinatua aplicada em site" title="veja um exemplo">veja um exemplo</a>

                </p>

            </div>
        </div>

    </div>

    @endcan

    @cannot('is-premium')

    <div class="row">

        <div class="col-md-6">
            <h2><i class="fa fa-code" aria-hidden="true"></i> Script de assinatura gratuito (duração de 3 meses)</h2>
            <div class="zb-white-container">

                <span>

                    &lt;script type="text/javascript"&gt; 
                    var _ziitData = _ziitData || [];
                    _ziitData.push(['_setAccount', {{ $assinatura->id }}]);
                    (function() {
                          var zb = document.createElement('script');
                          zb.type = 'text/javascript';
                          zb.async = true;
                          zb.src = ("{{ url('/') }}/js/ziit-signature.js");
                          var s = document.getElementsByTagName('script')[0];
                          s.parentNode.insertBefore(zb, s);

                    })();
                    &lt;/script&gt;
                    &lt;div class="zb-assinatura-ziit-embed"&gt;&lt;/div&gt;

                </span>

                <p class="zb-info">
                    Este script permite a inserção de uma assinatura em seu site que comprovará a utilização de energia de fontes renováveis pela sua empresa. Basta copiar e colar este script em seu site, diretamente no código HTML da página. <strong>Importante: </strong> não insira este script por meio de editores de textos. (solicite a inserção para o responsável da área técnica de sua empresa.) <a href="#" data-featherlight="{{ asset('img/exemplo-assinatura.gif') }}" alt="Exemplo de assinatua aplicada em site" title="veja um exemplo">veja um exemplo
                </p>

            </div>
        </div>

        <div class="col-md-6">
            <h2><i class="fa fa-code" aria-hidden="true"></i> Script de assinatura premium (duração de 12 meses)</h2>
            <div class="zb-white-container">

                <p>
                    Para ter acesso a este modelo de aplicação você precisa ativar a conta premium.
                </p>

                <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ativar conta premium</a>

                <p class="zb-info">
                    Este script também permite a inserção de uma assinatura em seu site. O principal benefício é que a assinatura tem validade de 12 meses.
                </p>


            </div>
        </div>
        
    </div>

    @endcannot

    <div class="row">
        <br>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <h2><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Certificado em PDF</h2>
            <div class="zb-white-container">

                @cannot('is-premium')

                <p>
                    Para ter acesso a este modelo de aplicação você precisa ativar a conta premium.
                </p>

                <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ativar conta premium</a>



                <p class="zb-info">
                    Este certificado comprova que sua empresa utiliza energia de fontes renováveis. <a href="#" data-featherlight="{{ asset('img/ziit-business-certificado.jpg') }}" alt="Exemplo de certificado que comprova o uso de energia renovável" title="veja um exemplo">veja um exemplo</a>
                </p>

                @endcannot

                @can('is-premium')

                    <p>
                        Clique no botão abaixo para fazer o download.
                    </p>

                    <a href="http://ziitbusiness.com.br/dev/certificado" target="_blank" class="btn btn-success"><i class="fa fa-cloud-download" aria-hidden="true"></i> fazer download</a>



                    <p class="zb-info">
                        Este certificado comprova que sua empresa utiliza energia de fontes renováveis. <a href="#" data-featherlight="{{ asset('img/ziit-business-certificado.jpg') }}" alt="Exemplo de certificado que comprova o uso de energia renovável" title="veja um exemplo">veja um exemplo</a>
                    </p>

                @endcan

            </div>
        </div>

        <div class="col-md-6">
            <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Versões gráficas do selo para aplicação em materiais impressos</h2>
            <div class="zb-white-container">

                @cannot('is-premium')

                <p>
                    Para ter acesso a este modelo de aplicação você precisa ativar a conta premium.
                </p>

                <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ativar conta premium</a>

                <p class="zb-info">
                    As versões gráficas do selo podem ser utilizadas em seus materiais impressos ou em ambientação.<a href="#" data-featherlight="{{ asset('img/exemplo-graficos.jpg') }}" title="veja um exemplo" alt="Utilize o selo em diversas aplicações impressas">veja um exemplo</a>
                </p>

                @endcannot

                @can('is-premium')

                    <p>
                        Clique no botão abaixo para fazer o download.
                    </p>

                    <a href="http://ziitbusiness.com.br/dev/public/material/selo-vetor/{{ str_slug($assinatura->usina->fonte_energia) }}.zip"  target="_blank" class="btn btn-success"><i class="fa fa-cloud-download" aria-hidden="true"></i> fazer download</a>



                    <p class="zb-info">
                        As versões gráficas do selo podem ser utilizadas em seus materiais impressos ou em ambientação.<a href="#" data-featherlight="{{ asset('img/exemplo-graficos.jpg') }}" title="veja um exemplo" alt="Utilize o selo em diversas aplicações impressas">veja um exemplo</a>
                    </p>

                @endcan

            </div>
        </div>

        <div class="col-md-6">
            <h2><i class="fa fa-envelope-o" aria-hidden="true"></i> Assinatura de e-mail</h2>
            <div class="zb-white-container">

                @cannot('is-premium')

                <p>
                    Para ter acesso a este modelo de aplicação você precisa ativar a conta premium.
                </p>

                @if($solicitacao)

                   @if($solicitacao->count() > 0)

                    <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> aguardando ativação da conta premium</a>

                   @else

                    <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ativar conta premium</a>

                   @endif

                @else
                    <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ativar conta premium</a>
                @endif 

                <p class="zb-info">
                    A assinatura de e-mail poderá ser incluída em todos os e-mails de sua empresa. <a href="#" data-featherlight="{{ asset('img/frame-email.jpg') }}" alt="O selo poderá fazer parte de sua assinatura de e-mail">veja um exemplo</a>
                </p>

                @endcannot

                @can('is-premium')

                    <p>
                        Clique no botão abaixo para fazer o download.
                    </p>

                    <a href="http://ziitbusiness.com.br/dev/img/assinaturas/premium/{{ str_slug($assinatura->usina->fonte_energia) }}.zip"  target="_blank" class="btn btn-success"><i class="fa fa-cloud-download" aria-hidden="true"></i> fazer download</a>



                    <p class="zb-info">
                        A assinatura de e-mail poderá ser incluída em todos os e-mails de sua empresa. <a href="#" data-featherlight="{{ asset('img/frame-email.jpg') }}" alt="O selo poderá fazer parte de sua assinatura de e-mail">veja um exemplo</a>
                    </p>

                @endcan

            </div>
        </div>

    </div>

    @cannot('is-premium')

    <div class="row">
        <br>
        <br>
    </div>

    <div class="row">

        <div class="col-md-12 zb-dashboard-centered">
            <a href="{{ url('painel/usuario/minha-conta') }}" class="btn btn-success zb-dashboard-activate"><i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Ative sua conta para ter acesso a todos os produtos</span></a>
        </div>

    </div>

    @endcannot

</section>

@endsection



