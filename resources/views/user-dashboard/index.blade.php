@extends('templates.dashboard')

@section('title', 'Ziit Business - Painel')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">

        <div class="col-md-4">
            
            <h2><i class="fa fa-clock-o" aria-hidden="true"></i> Tempo restante</h2>
            <span class="zb-destaque">

            @can('is-premium')
            Conta Premium
            @elsecannot('is-premium')

                @if(!$assinatura)
                Sua conta expirou
                @else

                    @if($solicitacao)

                       @if($solicitacao->count() > 0)

                        Aguardando ativação da conta Premium

                       @else

                        Ativar conta Premium

                       @endif

                    @else
                        Ativar conta Premium
                    @endif                


                @endif


                
            @endcannot

            </span>
            <p>
                sua assinatura expirará em <span class="zb-validade-count"></span>. @cannot('is-premium')<a href="{{ url('painel/usuario/minha-conta') }}" title="Ativar agora">Ativar agora</a>@endcannot
            </p>

        </div>

        <div class="col-md-4">

            <h2><i class="fa fa-battery-full" aria-hidden="true"></i> Tipo de energia utilizada</h2>
            <i class="zb-energy zb-{{ str_slug($assinatura->usina->fonte_energia) }}"></i><span class="zb-destaque">{{ $assinatura->usina->fonte_energia }}</span>
            <p>
                <a href="{{ url('painel/usuario/origem') }}" title="Clique aqui">Clique aqui</a> para ver de onde vem sua energia.
            </p>
           
        </div>

        <div class="col-md-4">
           
            <h2><i class="fa fa-tachometer" aria-hidden="true"></i> Você deixou de emitir</h2>
            <span class="zb-destaque">
                @if($emissoes_evitadas != '')

                    {{ $emissoes_evitadas }}<small>gCO<sub>2</sub></small>
                @else
                    Não foi possível calcular
                @endif
            </span>
            <p>
                Parabéns, você está ajudando a transformar o planeta em um lugar melhor para todos nós!
            </p>
            
        </div>

    </div>

    <div class="row">
        <br>
        <br>
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
                    Este script permite a inserção de uma assinatura em seu site que comprovará a utilização de energia de fontes renováveis pela sua empresa. Basta copiar e colar este script em seu site, diretamente no código HTML da página. <strong>Importante: </strong> não insira este script por meio de editores de textos. (solicite a inserção para o responsável da área técnica de sua empresa.) <a href="#" data-featherlight="{{ asset('img/exemplo-assinatura.gif') }}" alt="Exemplo de assinatua aplicada em site" title="veja um exemplo">veja um exemplo</a>
                </p>

            </div>
        </div>

        <div class="col-md-6">
            <h2><i class="fa fa-code" aria-hidden="true"></i> Script de assinatura premium (duração de 12 meses)</h2>
            <div class="zb-white-container">

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

    {{-- <script type="text/javascript"> 
    var _ziitData = _ziitData || [];
    _ziitData.push(['_setAccount', {{ $assinatura->id }}]);
    (function() {
          var zb = document.createElement('script');
          zb.type = 'text/javascript';
          zb.async = true;
          zb.src = ('http://127.0.0.1:8000/js/ziit-signature.js');
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(zb, s);

    })();
    </script>
    <div class="zb-assinatura-ziit-embed"></div> --}}


</section>

<script type="text/javascript">
    var dia = '{{ Helper::dateJs($assinatura->validade)->d }}';
    var mes = '{{ Helper::dateJs($assinatura->validade)->m }}';
    var ano = '{{ Helper::dateJs($assinatura->validade)->Y }}';
    var hora = '{{ Helper::dateJs($assinatura->validade)->H }}';
    var minuto = '{{ Helper::dateJs($assinatura->validade)->i }}';
    var segundo = '{{ Helper::dateJs($assinatura->validade)->s }}';
</script>

@endsection



