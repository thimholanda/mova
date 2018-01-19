<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Mova</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/style.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
             <p class="browserupgrade">Você está utilizando um browser<strong>desatualizado</strong>. Por favor, <a href="http://browsehappy.com/">atualize seu browser</a> para melhorar sua experiência.</p>
        <![endif]-->

        <header class="zb-mobile-header">
            <h1><span>Mova</span></h1>
            <button type="button" class="zb-btn-menu-mobile">
                <i class="fa fa-bars" aria-hidden="true"></i>
                <i class="fa fa-close" style="display: none;" aria-hidden="true"></i>
            </button>
        </header>

        <nav class="zb-nav-mobile">
            <ul>
                <li><a class="zb-anchor-link-inline" href="#o-que-e" title="O QUE É?">O QUE É?</a></li>
                <li><a class="zb-anchor-link-inline" href="#formas-aderir" title="CONTRATE">CONTRATE</a></li>
                <li><a class="zb-anchor-link-inline" href="#porque-contratar" title="POR QUE CONTRATAR?">POR QUE CONTRATAR?</a></li>
                <li><a class="zb-anchor-link-inline" href="#tipos-energia" title="TIPOS DE ENERGIA">TIPOS DE ENERGIA</a></li>
                <li><a class="zb-anchor-link-inline" href="#faq" title="FAQ">FAQ</a></li>
                <li><a class="zb-anchor-link-inline" href="#clientes" title="CLIENTES">CLIENTES</a></li>
                <li><a class="login" href="{{ url('login')}}" title="LOGIN">LOGIN</a></li>
            </ul>
        </nav>

        <header class="zb-main-header">
            <h1><span>Mova</span></h1>
            <nav>
                <ul>
                    <li><a class="zb-anchor-link-inline" href="#o-que-e" title="O QUE É?">O QUE É?</a></li>
                    <li><a class="zb-anchor-link-inline" href="#formas-aderir" title="CONTRATE">CONTRATE</a></li>
                    <li><a class="zb-anchor-link-inline" href="#porque-contratar" title="POR QUE CONTRATAR?">POR QUE CONTRATAR?</a></li>
                    <li><a class="zb-anchor-link-inline" href="#tipos-energia" title="TIPOS DE ENERGIA">TIPOS DE ENERGIA</a></li>
                    <li><a class="zb-anchor-link-inline" href="#faq" title="FAQ">FAQ</a></li>
                    <li><a class="zb-anchor-link-inline" href="#clientes" title="CLIENTES">CLIENTES</a></li>
                    <li><a class="login" href="{{ url('login')}}" title="LOGIN">LOGIN</a></li>
                </ul>
            </nav>
        </header>

        <header class="zb-second-header">
            <h1><span>Mova</span></h1>
            <nav>
                <ul>
                    <li><a class="zb-anchor-link-inline" href="#o-que-e" title="O QUE É?">O QUE É?</a></li>
                    <li><a class="zb-anchor-link-inline" href="#formas-aderir" title="CONTRATE">CONTRATE</a></li>
                    <li><a class="zb-anchor-link-inline" href="#porque-contratar" title="POR QUE CONTRATAR?">POR QUE CONTRATAR?</a></li>
                    <li><a class="zb-anchor-link-inline" href="#tipos-energia" title="TIPOS DE ENERGIA">TIPOS DE ENERGIA</a></li>
                    <li><a class="zb-anchor-link-inline" href="#faq" title="FAQ">FAQ</a></li>
                    <li><a class="zb-anchor-link-inline" href="#clientes" title="CLIENTES">CLIENTES</a></li>
                    <li><a class="login" href="{{ url('login')}}" title="LOGIN">LOGIN</a></li>
                </ul>
            </nav>
        </header>

        <section class="zb-section-slider">

            <div class="zb-container-main-slider">

                <div class="zb-slide zb-slide-eolica">

                    <div data-animation-in="fadeInLeft" class="zb-slider-mask zb-slider-mask-eolica"></div>
                    <div data-animation-in="fadeIn" data-delay-in="1" class="zb-slider-icon zb-slider-icon-eolica"></div>

                    <div class="zb-container-content">
                        <h1 data-animation-in="fadeInLeft" data-delay-in="1.2">Sua <br/>empresa movida a energia<br/> <span>eólica.</span></h1>
                        <h2 data-animation-in="fadeInLeft" data-delay-in="1.6"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>
                    </div>

                     <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

                </div>

                <div class="zb-slide zb-slide-biomassa">

                    <div data-animation-in="fadeInLeft" class="zb-slider-mask zb-slider-mask-biomassa"></div>
                    <div data-animation-in="fadeIn" data-delay-in="1" class="zb-slider-icon zb-slider-icon-biomassa"></div>

                    <div class="zb-container-content">
                        <h1 data-animation-in="fadeInLeft" data-delay-in="1.2">Sua <br/>empresa movida a energia<br/> <span>biomassa.</span></h1>
                        <h2 data-animation-in="fadeInLeft" data-delay-in="1.6"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>
                    </div>

                    <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

                </div>

                <div class="zb-slide zb-slide-hidrica">

                    <div data-animation-in="fadeInLeft" class="zb-slider-mask zb-slider-mask-hidrica"></div>
                    <div data-animation-in="fadeIn" data-delay-in="1" class="zb-slider-icon zb-slider-icon-hidrica"></div>

                    <div class="zb-container-content">
                        <h1 data-animation-in="fadeInLeft" data-delay-in="1.2">Sua <br/>empresa movida a energia<br/> <span>hídrica.</span></h1>
                        <h2 data-animation-in="fadeInLeft" data-delay-in="1.6"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>
                    </div>

                    <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

                </div>

                <div class="zb-slide zb-slide-solar">

                    <div data-animation-in="fadeInLeft" class="zb-slider-mask zb-slider-mask-solar"></div>
                    <div data-animation-in="fadeIn" data-delay-in="1" class="zb-slider-icon zb-slider-icon-solar"></div>

                    <div class="zb-container-content">
                        <h1 data-animation-in="fadeInLeft" data-delay-in="1.2">Sua <br/>empresa movida a energia<br/> <span>solar.</span></h1>
                        <h2 data-animation-in="fadeInLeft" data-delay-in="1.6"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>
                    </div>

                    <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

                </div>

            </div>

            <div class="zb-container-btn-simulacao">
                <p>Use energia renovável no seu negócio.</p>
                <button type="button">Comece <strong>agora</strong></button>
            </div>

        </section>

        <section class="zb-slider-mobile">


            <div class="zb-slider zb-slider-eolica">

                <div class="zb-container-infos">

                    <div data-animation-in="fadeIn" class="zb-slider-icon zb-slider-icon-eolica"></div>

                    <div class="zb-centered-content">

                        <h1 data-animation-in="fadeInDown" data-delay-in=".4">Sua <br/>empresa movida a energia<br/> <span>eólica.</span></h1>
                        <h2 data-animation-in="fadeInDown" data-delay-in=".8"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>

                        <div  class="zb-container-btn-simulacao">
                            <p data-animation-in="fadeInDown" data-delay-in="1.2">Use energia renovável no seu negócio.</p>
                            <button data-animation-in="fadeInDown" data-delay-in="1.2" type="button">Comece <strong>agora</strong></button>
                        </div>

                    </div>

                </div>

                <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

            </div>


            <div class="zb-slider zb-slider-biomassa">

                <div class="zb-container-infos">

                    <div data-animation-in="fadeIn" class="zb-slider-icon zb-slider-icon-biomassa"></div>

                    <div class="zb-centered-content">

                        <h1 data-animation-in="fadeInDown" data-delay-in=".4">Sua <br/>empresa movida a energia<br/> <span>biomassa.</span></h1>
                        <h2 data-animation-in="fadeInDown" data-delay-in=".8"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>

                        <div  class="zb-container-btn-simulacao">
                            <p data-animation-in="fadeInDown" data-delay-in="1.2">Use energia renovável no seu negócio.</p>
                            <button data-animation-in="fadeInDown" data-delay-in="1.2" type="button">Comece <strong>agora</strong></button>
                        </div>

                    </div>

                </div>

                <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

            </div>


            <div class="zb-slider zb-slider-hidrica">

                <div class="zb-container-infos">

                    <div data-animation-in="fadeIn" class="zb-slider-icon zb-slider-icon-hidrica"></div>

                    <div class="zb-centered-content">

                        <h1 data-animation-in="fadeInDown" data-delay-in=".4">Sua <br/>empresa movida a energia<br/> <span>hídrica.</span></h1>
                        <h2 data-animation-in="fadeInDown" data-delay-in=".8"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>

                        <div  class="zb-container-btn-simulacao">
                            <p data-animation-in="fadeInDown" data-delay-in="1.2">Use energia renovável no seu negócio.</p>
                            <button data-animation-in="fadeInDown" data-delay-in="1.2" type="button">Comece <strong>agora</strong></button>
                        </div>

                    </div>

                </div>

                <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

            </div>

            <div class="zb-slider zb-slider-solar">

                <div class="zb-container-infos">

                    <div data-animation-in="fadeIn" class="zb-slider-icon zb-slider-icon-solar"></div>

                    <div class="zb-centered-content">

                        <h1 data-animation-in="fadeInDown" data-delay-in=".4">Sua <br/>empresa movida a energia<br/> <span>solar.</span></h1>
                        <h2 data-animation-in="fadeInDown" data-delay-in=".8"><strong>Mova</strong>, energia <strong>renovável</strong> para <strong>sua empresa</strong>. Em qualquer lugar que ela esteja.</h2>

                        <div  class="zb-container-btn-simulacao">
                            <p data-animation-in="fadeInDown" data-delay-in="1.2">Use energia renovável no seu negócio.</p>
                            <button data-animation-in="fadeInDown" data-delay-in="1.2" type="button">Comece <strong>agora</strong></button>
                        </div>

                    </div>

                </div>

                <div data-animation-in="fadeIn" data-delay-in="3" class="zb-image-slider"></div>

            </div>




        </section>

        <section id="o-que-e" class="zb-section-como-funciona">

            <h1>Como <br/>funciona</h1>

            <div class="zb-text-container">

                <p class="zb-featured-text">
                    Já pensou se a <strong>sua empresa</strong> pudesse usar apenas energia vinda de <strong>fontes certificadas</strong>, fizesse parte de uma comunidade que incentiva a produção de <strong>energia renovável</strong> no país, e pudesse contar isso para todo o mercado, especialmente os seus consumidores?
                </p>
                <p>
                    É isso que <strong>Mova</strong> proporciona. Através da compra de <strong>REC (Certificado de Energia Renovável)</strong> a energia elétrica usada na sua empresa é compensada pela produção da mesma quantidade de <strong>kWh</strong> vinda de fontes renováveis.
                </p>
                <p>
                    Ao contratar <strong>Mova</strong> você recebe um certificado e um selo que atestam que sua empresa usa energia gerada por fontes renováveis. Esse selo pode ser usado em todos os seus
                    canais de comunicação como site, embalagens, pontos de venda e etc.
                </p>

            </div>

            <img class="zb-helice" src="img/helice.png">

            <span class="zb-selo-energia-renovavel"></span>

        </section>

        <section id="formas-aderir" class="zb-section-formas-aderir">
            <div class="zb-content">
                <h1 class="zb-h1-blue">Formas de aderir</h1>
                <h2>Que ótimo, você quer transformar o planeta. Escolha uma das opções abaixo:</h2>

                <div class="zb-box-container zb-box-container-gray">

                    <div class="zb-container-beneficios">
                        <h3>BENEFÍCIOS</h3>
                        <ul>
                            <li><span class="zb-list-align"><strong>Certificado</strong> em formato PDF disponível para impressão. <a href="#" data-featherlight="{{ asset('img/ziit-business-certificado.jpg') }}" alt="Exemplo de certificado que comprova o uso de energia renovável" class="zb-veja-aqui">veja aqui</a></span><br/><span class="zb-obs">Somente para <strong>versão Premium</strong></span></li>
                            <li><span class="zb-list-align">Script de programação para inclusão de imagem dinâmica do Selo em seu <strong>site</strong> de internet. <a href="#" data-featherlight="{{ asset('img/exemplo-assinatura-gratuita-home.gif') }}" alt="Exemplo de assinatura aplicada em site" class="zb-veja-aqui">veja aqui</a></span><br/><span class="zb-obs"><strong>Versão Premium: </strong>período de 1 ano</span><span class="zb-obs"><strong>Versão Gratuita: </strong>período de 3 meses</span></li>
                            <li><span class="zb-list-align">Script de programação para inclusão da assinatura do Selo em <strong>e-mails</strong>. <a href="#" data-featherlight="img/frame-email.jpg" alt="O selo poderá fazer parte de sua assinatura de e-mail"class="zb-veja-aqui">veja aqui</a></span><br/><span class="zb-obs">Somente para <strong>versão Premium</strong></span></li>
                            <li><span class="zb-list-align"><strong>Versões gráficas</strong> do Selo e instruções de uso da marca para aplicação do Selo em materiais impressos. <a href="#" class="zb-veja-aqui" data-featherlight="{{ asset('img/exemplo-graficos.jpg') }}" alt="Utilize o selo em diversas aplicações impressas">veja aqui</a></span><br/><span class="zb-obs">Somente para <strong>versão Premium</strong></span></li>
                            <li><span class="zb-list-align">Escolha do <strong>tipo de energia</strong> que será utilizada.<a href="#" data-featherlight="img/ziit-business-tipos-energias.jpg" class="zb-veja-aqui" alt="Escolha o tipo de energia que deseja usar">veja aqui</a></span><br/><span class="zb-obs">Somente para <strong>versão Premium</strong></span></li>
                            <li><span class="zb-list-align"><strong>Energia Renovável</strong></span><br/><span class="zb-obs zb-red-color-light"><strong>Versão Gratuita: </strong>limitada a 1000kWh</span><span class="zb-obs"><strong>Versão Premium: </strong>100% de seu consumo</span></li>
                        </ul>

                        <div class="zb-container-buttons">
                            <button class="zb-btn-comece-agora" type="button"><strong>COMECE</strong> AGORA</button>
                            <button class="zb-btn-faca-simulacao" type="button">FAÇA UMA <strong>SIMULAÇÃO</strong></button>
                        </div>

                    </div>

                    <div class="zb-container-list-beneficios">
                        <div class="zb-selo-beneficio zb-selo-beneficio-gratuito"></div>
                        <h3>TESTE POR <strong>3 MESES</strong></h3>
                        <ul>
                            <li><span class="zb-icon-beneficios zb-icon-no"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-yes"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-no"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-no"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-no"></span></li>
                            <li class="zb-item-beneficio zb-red-color-light">limitada a 1000kWh</span></li>
                        </ul>
                        <button class="zb-btn-comece-agora" type="button"><strong>COMECE</strong> AGORA</button>
                    </div>

                    <div class="zb-container-list-beneficios">
                        <div class="zb-selo-beneficio zb-selo-beneficio-premium"></div>
                        <h3>VERSÃO <strong>PREMIUM</strong></h3>
                        <ul>
                            <li><span class="zb-icon-beneficios zb-icon-yes"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-yes"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-yes"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-yes"></span></li>
                            <li><span class="zb-icon-beneficios zb-icon-yes"></span></li>
                            <li class="zb-item-beneficio">100% de seu consumo</li>
                        </ul>
                        <button class="zb-btn-faca-simulacao" type="button">FAÇA UMA <strong>SIMULAÇÃO</strong></button>
                    </div>

                </div>

            </div>
        </section>

        <section id="simulacao" class="zb-section-numeros">

             <div class="zb-content">

                <h1 class="zb-h1-blue">Vamos falar de números?</h1>

                <div class="zb-box-container zb-box-container-blue">

                    <div class="zb-container-form">

                        <form id="zb-register-premium-form">

                            <div class="row">

                                <label for="email">Primeiro, abra um canal de comunicação com a gente, pode ser seu e-mail?</label>
                                <input type="text" name="email" placeholder="E-MAIL">

                            </div>

                            <div class="row">

                                <label for="site">Queremos saber um pouco mais sobre sua empresa.</label>
                                <input type="text" name="site_empresa" placeholder="SITE DA EMPRESA">
                                <input type="text" name="nome_empresa" placeholder="NOME DA EMPRESA">
                                <input type="text" name="nome_responsavel" placeholder="NOME DO RESPONSÁVEL">

                            </div>

                            <div class="row">

                                <label for="watt_hora">Quantos <strong>kWh</strong> (quilo Watt hora) sua empresa usa por mês? <a data-featherlight="{{ asset('img/img-simulacao.jpg') }}" href="#" title="ver como" alt="" class="zb-ver-como">ver como<i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
                                <input type="text" name="watt_hora" placeholder="kWh">
                            </div>

                            <button class="zb-regular-button zb-btn-simule" type="button"><strong>SIMULE</strong> AGORA | <strong>VERSÃO PREMIUM</strong></button>

                            <div class="zb-wrap-result">

                                <div class="row zb-row-investimento">

                                    <label>O investimento estimado será de:</label>
                                    <div class="zb-investimento">R$ <strong>XX,XX</strong> POR ANO</div>
                                    <input type="hidden" name="investimento" value="">

                                </div>

                                 <div class="row zb-row-container-checkbox">

                                    <div class="zb-container-checkbox">
                                        <input type="checkbox" name="aceite" value="0"><label></label>
                                    </div>

                                    <p>Li e aceito os <a class="zb-btn-termos" href="#" title="termos de uso">termos de uso</a></p>

                                </div>

                                <button class="zb-regular-button zb-btn-premium-form" type="submit"><strong>ASSINE</strong> JÁ | <strong>VERSÃO PREMIUM</strong></button>

                            </div>

                        </form>

                    </div>

                    <div class="zb-container-slider">

                        <div>
                            <img src="./img/ziit-solar-inline-1.jpg" alt="Ziit Energia Eólica" title="Ziit Energia Solar">
                            <span class="zb-description">exemplo de aplicação impressa do selo</span>
                        </div>

                        <div>
                            <img src="./img/ziit-eolica-inline-1.jpg" alt="Ziit Energia Eólica" title="Ziit Energia Eólica">
                            <span class="zb-description">exemplo de aplicação impressa do selo</span>
                        </div>

                        <div>
                            <img src="./img/ziit-biomassa-inline-1.jpg" alt="Ziit Energia Eólica" title="Ziit Energia Biomassa">
                            <span class="zb-description">exemplo de aplicação impressa do selo</span>
                        </div>

                        <div>
                            <img src="./img/ziit-aplicacao-site.jpg" alt="Ziit Energia Eólica" title="Ziit - Aplicação Site">
                            <span class="zb-description">exemplo de aplicação digital do selo (site)</span>
                        </div>

                        <div>
                            <img src="./img/ziit-hidrica-inline-1.jpg" alt="Ziit Energia Eólica" title="Ziit - Instituto Totum">
                            <span class="zb-description">exemplo de aplicação impressa do selo</span>
                        </div>

                    </div>

                </div>

             </div>

        </section>

        <section id="porque-contratar" class="zb-section-motivos">

            <h1>Quer os motivos?<br/>A gente fala.</h1>

            <div class="zb-text-container">

                <p class="zb-featured-text">
                    Investir em sustentabilidade é ótimo para o Planeta e também muito bom para os negócios.
                </p>

                <p>
                    Quando você usa o <strong>Mova</strong> o planeta agradece, porque ao usar e incentivar a produção de energia renovável, você contribui para a preservação do meio ambiente e dos recursos naturais.
                </p>
                <p>
                    <strong>Mova</strong>  também é ótimo para o seu negócio, uma vez que adotar medidas sustentáveis gera mais valor para a sua empresa e para os seus clientes.
                </p>

            </div>

            <img src="img/painel-solar.png">

        </section>

        <section id="tipos-energia" class="zb-section-energias">

            <div class="zb-content">

                <h1>De onde vem<br/>a sua energia?</h1>

                <nav class="zb-menu-energias">
                    <ul>
                        <li class="animated"><button class="zb-button-eolica" type="button"></button></li>
                        <li><button class="zb-button-biomassa" type="button"></button></li>
                        <li><button class="zb-button-hidrica" type="button"></button></li>
                        <li><button class="zb-button-solar" type="button"></button></li>
                    </ul>
                </nav>

                <p class="zb-main-text">Com <strong>Mova</strong> você pode escolher qual fonte de energia que sua empresa vai usar e promover. Saiba um pouco mais sobre cada tipo e onde encontrar as Usinas Geradoras Certificadas.</p>

            </div>

            <div class="zb-slider-energia">

                <div class="zb-content">

                    <div class="zb-wrap-infos">

                        <h1></h1>
                        <span class="animated infinite pulse zb-icon-energia"></span>
                        <p class="zb-inline-text"></p>
                        <button class="zb-regular-inline-button zb-btn-formas-aderir"></button>
                        <button class="zb-button-voltar"><span>VOLTAR</span></button>
                        <button class="zb-exibir-mapa">Exibir mapa</button>

                    </div>

                </div>
                <button style="display: none;" class="zb-fechar-mapa">X | fechar mapa</button>
                <div id="map" class="zb-map-container"></div>


            </div>

        </section>

{{--         <section class="zb-section-video">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/gDF9f2uz8No" frameborder="0" allowfullscreen></iframe>
        </section>
 --}}
        <section id="faq" class="zb-section-faq">

            <h1 class="zb-h1-blue">Perguntas Frequentes</h1>

            <div class="zb-content">

                @forelse($perguntas as $pergunta)

                <div class="zb-container-pergunta">
                    <h2>
                        {!! $pergunta->titulo !!}
                        <span class="zb-accordion-icon">+</span>
                    </h2>
                    <div class="zb-resposta">
                        <p>
                            {!! $pergunta->resposta !!}
                        </p>
                    </div>

                </div>

                @empty

                <div class="zb-container-pergunta">
                    <h2>
                        Não existem perguntas cadastradas.
                    </h2>
                </div>

                @endforelse

            </div>

        </section>



        <section class="zb-section-clientes" id="clientes">

            <span class="zb-stripe"></span>

            <div class="zb-content">

                <h1>Clientes</h1>

                @if($logotipos->count() > 0)

                    <div class="zb-slider-clientes">

                        @foreach($logotipos as $logotipo)

                            <div class="zb-single-slide-cliente">
                                <img style="height: 171px; display: inline-block;" src="{{ $logotipo->logotipo }}" alt="">
                                <span style="width: 100%; display: inline-block; font-size: 2.2rem; letter-spacing: 1; vertical-align: top; margin-top: 10px; font-weight: 400;">{!!  title_case($logotipo->user->name) !!}</span>
                            </div>

                        @endforeach

                    </div>

                @else
                    <strong style="display: inline-block; width: 100%; text-align: center; font-size: 2rem; padding: 40px 0 60px 0">Seja o primeiro cliente.</strong>
                @endif

            </div>

            <div class="zb-watts">

                <div class="zb-content">


                    <div class="zb-half-content">

                        <div class="zb-wrap-text">
                            <p>Confira quantos <strong>kWh</strong> de <strong>energia<br/>&nbsp;&nbsp;&nbsp;renovável</strong> nossos clientes já garantiram</p>
                        </div>

                        <div class="zb-full-wrap-text">
                            @if($total_kwh != '')
                                <p class="zb-featured-text"><strong>{{ $total_kwh }}</strong><span>kWh</span></p>
                            @else
                                <p class="zb-featured-text"><strong>--</strong></p>

                            @endif

                        </div>

                    </div>

                    <div class="zb-half-content">

                        <div class="zb-wrap-text">
                            <p>Isso <strong>equivale</strong> a</p>
                        </div>

                        <div class="zb-full-wrap-text">
                            <p class="zb-featured-text">
                            @if($emissoes_evitadas != '')

                                <strong>{{ $emissoes_evitadas }}</strong><span>gCO<sub>2</sub></span>
                            @else
                               <strong>--</strong>
                            @endif
                            </p>
                        </div>

                        <div class="zb-wrap-text">
                            <p>de <strong>emissões evitadas</strong></p>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <footer>

            <div class="zb-content">

                <div class="zb-wrap-content-third">

                    <nav class="zb-footer-menu">
                        <ul>
                            <li><a href="#o-que-e" title="O QUE É?">O QUE É?</a></li>
                            <li><a href="#formas-aderir" title="CONTRATE">CONTRATE</a></li>
                            <li><a href="#porque-contratar" title="POR QUE CONTRATAR?">POR QUE CONTRATAR?</a></li>
                            <li><a href="#tipos-energia" title="TIPOS DE ENERGIA">TIPOS DE ENERGIA</a></li>
                            <li><a href="#faq" title="FAQ">FAQ</a></li>
                            <li><a href="#clientes" title="CLIENTES">CLIENTES</a></li>
                        </ul>
                    </nav>

                </div>

                <div class="zb-wrap-content-third">
                    <span class="zb-email">contato@movaenergia.com.br</span>
                </div>

                <div class="zb-wrap-content-third">
                    <h1><span>Mova</span></h1>
                </div>

            </div>

        </footer>


        <div class="zb-pano-modal"></div>

        <div class="zb-modal">

            <button type="button" class="zb-close-modal">X</button>

            <form id="zb-register-form" method="POST" {{-- action="{{ route('create') }}" --}}>

                {{ csrf_field() }}

                <div class="zb-form-grauito-response">
                    <span class="zb-loader"></span>
                    <p>Por favor, aguarde...</p>
                    <button class="zb-btn-ok" type="button">OK</button>
                    <button class="zb-btn-fechar" type="button">FECHAR</button>
                </div>

                <div class="zb-content-form-gratuito">

                    <h1>Versão Gratuita</h1>

                    <div class="row">

                        <label for="email">Primeiro, abra um canal de comunicação com a gente, pode ser seu e-mail?</label>
                        <input type="text" name="email" placeholder="E-MAIL">

                    </div>

                    <div class="row">

                        <label for="site">Queremos saber um pouco mais sobre sua empresa.</label>
                        <input type="text" name="site_empresa" placeholder="SITE DA EMPRESA">
                        <input type="text" name="nome_empresa" placeholder="NOME DA EMPRESA">
                        <input type="text" name="nome_responsavel" placeholder="NOME DO RESPONSÁVEL">

                    </div>

                     <div class="row zb-row-container-checkbox">

                        <div class="zb-container-checkbox">
                            <input type="checkbox" name="aceite" value="0"><label></label>
                        </div>

                        <p>Li e aceito os <a class="zb-btn-termos" href="#" title="termos de uso">termos de uso</a></p>

                    </div>



                    <button class="zb-regular-button" type="submit"><strong>COMEÇAR</strong> AGORA*</button>

                    <div class="row">
                        <p><sup>*</sup>Este plano tem duração de três meses a partir da data de cadastro.</p>
                    </div>

                </div>

            </form>

        </div>


        <div class="zb-modal-termos">
            <button type="button" class="zb-close-modal-termos">X</button>
            <h1>Termos de Uso de Aplicativo e Política de Privacidade</h1>
            <div class="zb-text-scroll">

                <p>Bem-vindo! Estes são os Termos de Uso do site Mova e Política de Privacidade do site Mova. O Usuário do site Mova deve ler com atenção os Termos abaixo antes de acessá-lo ou usá-lo, pois o acesso ou uso deste implica em concordância com tais Termos.</p>

                <p>Assim, a seguir estão descritas as regras aplicáveis à utilização do site Mova. Ao realizar o cadastro para adesão ao selo Mova, o Usuário se submeterá automaticamente às regras e condições destes Termos de Uso (“Termos”), assumindo as responsabilidades, deveres e obrigações decorrentes deste.</p>

                <p>Estes Termos constituem um contrato de adesão para o Usuário e regulam a utilização do Selo Mova, nas condições aqui expressas.</p>

                <p>Ao entrar no site para fazer seu registro e adesão, o Usuário reconhece que leu, compreendeu e concorda em estar vinculado e cumprir estes Termos de Uso de Aplicativo e Política de Privacidade. Caso o Usuário não concorde com estes Termos, deve imediatamente cessar o acesso ao serviço.</p>

                <p>Os desenvolvedores do Mova se reservam ao direito de alterar estes Termos ou modificar quaisquer características dos serviços a qualquer momento, a seu exclusivo critério, sendo assim, é atribuição do Usuário consultar estes Termos periodicamente para obter ciência de tais alterações. Ainda, quaisquer alterações nos Termos poderão ser efetivadas imediatamente ou conforme cronograma estabelecido pelos desenvolvedores do site, afetando parte ou totalidade dos Usuários. A versão mais atual dos Termos será sempre referenciada em link específico desse site. O uso continuado dos serviços em todas as atualizações para os Termos a seguir será considerado aceitação dos Termos atualizados.</p>

                <p>Para os fins desse documento, a expressão "força maior" significa circunstâncias além do controle razoável dos desenvolvedores do site, incluindo, sem limitação, atos da natureza, atos de governo, inundações, incêndios, terremotos, agitação civil, atos de terror, greves, crises de fornecimento de energia ou outros problemas ou falhas de provedor de serviço de internet, telefonia móvel ou rede de dados ou atrasos.</p>

                <p>Explicita-se que os serviços consistem na aquisição, por parte dos desenvolvedores do site, de Certificados de Energia Renovável (RECs), estes emitidos pelos produtores de energia renovável, em quantidade pelo menos igual ao consumo de energia estimado das empresas participantes ou ao consumo declarado das empresas participantes. Quando o consumo é simplesmente declarado pela empresa, o Selo a que a empresa terá direito representa a aquisição de RECs na quantidade declarada pela empresa. Quando o consumo é estimado, caberá à empresa fornecer evidência de seu consumo de energia dos últimos 12 meses e esse consumo será considerado como base para estimativa do consumo dos próximos 12 meses e consequente aquisição de RECs na quantidade estimada. Nesse caso, o Selo fornecido atestará que a empresa utiliza somente energia renovável do tipo escolhido no ato do registro inicial. <p>

                <p>O Selo INCENTIVO decorrente de auto-declaração está disponível para as empresas durante o período máximo de três meses, isento de pagamento de taxas; após este período, a empresa que desejar continuar a utilizar o Mova deverá efetuar um upgrade para a categoria do Selo 100%, mediante pagamento das taxas previstas no site do Mova. Após upgrade, o Selo 100% estará disponível para o Usuário pelo período de mais 12 meses. <p>

                <p>No caso do Selo 100%, o usuário poderá escolher o tipo de energia renovável (REC), dentre as disponíveis no site, com a qual pretende abater seu consumo estimado, e caberá ao Mova adquirir a quantidade e tipo de RECs necessários para no mínimo cobrir o consumo estimado. O usuário será cobrado conforme tabela de preços disponível no próprio site. Neste tipo de Selo (100%), cada REC adquirido pelo Mova para cobertura do consumo estimado é de uso exclusivo do Usuário. <p>

                <p>No caso do Selo Incentivo, a escolha do tipo de energia renovável (REC) é feita pelo Mova, dentre as disponíveis no site, para abater seu consumo declarado, e caberá ao Mova adquirir a quantidade de RECs necessários para no mínimo cobrir o consumo declarado. Neste tipo de Selo (Incentivo), um mesmo REC cadastrado poderá ser compartilhado por diversos Usuários até que o REC seja totalmente consumido. <p>

                <p>O Selo sempre é concedido para uma empresa (CNPJ), válido para os endereços declarados ou para os endereços devidamente comprovados pelas respectivas contas de energia. O uso do Selo em endereços não declarados ou de consumos não comprovados representa uma infração grave aos Termos de Uso do Selo, e poderá acarretar em penalidades e cancelamento do uso do Selo. <p>

                <p>A escolha e disponibilidade dos RECs aptos a serem utilizados pelo Usuário são definidas pelo Mova em função da oferta existente no território nacional, podendo variar em estoque e categoria (fonte de energia). Os custos com a aquisição de energia elétrica utilizada para a empresa operar suas atividades devem ser bancados pela própria empresa e o aplicativo não arca nem arcará com essa despesa, não tendo qualquer responsabilidade ou ingerência sobre isto. <p>

                <p>Esclarece-se que os RECs alocam o atributo ambiental da “renovação de energia ou renovabilidade” da fonte de energia diretamente à empresa que faz seu cadastro junto ao Site Mova.</p>

                <p>Após contratado o serviço do Selo, no eventual cancelamento ou impossibilidade de aquisição de RECs conforme critérios de escolha do Usuário, Mova fará a substituição por RECs de outras fontes e informará ao Usuário, que poderá, a seu critério, desistir do Selo recebendo valores de ressarcimento proporcionais ao período de utilização do Selo. <p>

                <p><strong>A aquisição de RECs pelo Usuário, por meio do Mova, apoia a produção de eletricidade renovável no Brasil.</strong> Para o total de consumo anual estimado ou declarado pela empresa, na unidade kWh (quilowatt hora), uma quantidade equivalente de REC é adquirida em nome da empresa. A aquisição de REC também ajuda a construir um mercado de eletricidade renovável. Geração de eletricidade renovável e aumento da sua demanda ajuda a reduzir a geração de eletricidade não renovável (fontes fósseis) no Brasil. RECs também, via de regra, possuem outros benefícios ambientais locais e globais, que podem incluir redução de poluição atmosférica regional ou dióxido de carbono (minimizando o “efeito estufa”).</p>

                <p>O cadastro para uso do Selo é realizado no ato de registro por parte do Usuário (empresa) no site do Mova, que deverá escolher uma das modalidades de planos disponíveis.</p>

                <p>Será permitido um único cadastramento por empresa (Usuário), devendo o acesso, visualização e uso da área restrita do site ser feito pelo representante da empresa em caráter pessoal e intransferível. <p>

                <p>É proibida a realização de mais de um cadastro por empresa, bem como, o Usuário se utilizar do cadastro de outro Usuário (e outra empresa).</p>

                <p>O uso do Mova é restrito para empresas localizadas no território nacional. <p>

                <p><strong>Mova não gera nem distribui eletricidade</strong>. Ao optar pelo registro no site e uso de um dos Selos disponíveis, o Usuário reconhece e concorda que o Mova não é parte em qualquer tipo de transação ou relação comercial existente entre o Gerador de Energia, Transmissor de Energia, Distribuidor de Energia e o Usuário / Empresa. Nesse sentido, o Mova e seus desenvolvedores não assumem nenhuma responsabilidade e não terão responsabilidade de qualquer tipo em relação ao relacionamento da empresa com qualquer distribuidor de energia incluindo, mas não se limitando, à entrega de eletricidade e energia, pagamentos, avisos, atrasos, falta de energia. Tais eventos são responsabilidade do Gerador de Energia, Transmissor de Energia e Distribuidor de Energia, e Mova não participa de forma alguma dessa relação. <p>

                <p><strong>Mova se utiliza de estimativas para computar o consumo de energia da empresa que deseja o Selo</strong>. O Usuário reconhece que o cálculo é estimado em função do consumo anual passado devidamente comprovado ou em função da autodeclaração de consumo anual passado da Empresa. O consumo real dos 12 meses contados a partir da concessão do Selo não necessariamente segue o consumo passado e todas as Partes concordam que ambos os Selos representam uma estimativa do consumo real que será compensado com a aquisição de RECs. <p>

                <p>Após doze meses de uso do Selo 100%, o Mova será renovado automaticamente, mediante emissão de nova cobrança ao Usuário referente ao próximo período de doze meses. Após pagamento da renovação, o Usuário terá um prazo de três meses para fornecer os dados dos últimos doze meses de consumo, momento no qual o Zitt Business fará um comparativo entre a energia efetivamente utilizada e o estimado no período anterior; caso haja diferença, o Mova poderá compensar o saldo faltante no plano do próximo período, emitindo uma cobrança adicional do valor deste saldo. Caso no prazo de três meses o Usuário não tenha fornecido os dados do consumo dos últimos doze meses, o Mova poderá proceder com o cancelamento ou suspensão do uso do Selo pelo Usuário, conforme condições estipuladas neste Termo. <p>

                <p>Quaisquer discrepâncias ou litígios relativos à precisão da conta de energia do Distribuidor de Energia do Usuário devem ser abordados diretamente pelo Usuário e Distribuidor de Energia, sem qualquer tipo de participação ou responsabilização do Mova. <p>

                <p>Mova e a empresa usuário (ou Usuário) concordam em utilizar esforços comercialmente razoáveis para fornecer cálculos, evidências de consumo e estimativas em tempo hábil, com informações precisas dentro das hipóteses assumidas pelo Selo. O Usuário também concorda que o Mova e seus desenvolvedores não serão responsabilizados por quaisquer atrasos, falta de entrega, ou erro de contabilização ou por quaisquer ações tomadas ou não tomadas pelo Usuário ou qualquer terceiro na dependência dos cálculos ou contabilizações de energia e respectivos RECs.</p>

                <p>O uso do site e o uso do Selo não alteram quaisquer responsabilidades ou obrigações atualmente existentes entre o Usuário e distribuidor de energia.</p>

                <p>O Selo Incentivo disponibiliza ao Usuário um script de programação para inclusão da imagem dinâmica do Selo em seu site de internet. O Selo Incentivo está autorizado exclusivamente ao Usuário que efetuou seu cadastro através do site do Mova e obteve permissão para seu uso. Usuários do Selo Incentivo terão seus nomes divulgados como usuários do Mova nos sites do Mova e da Certificação de Energia Renovável (www.seloenergiarenovavel.com.br). <p>

                <p>O Selo 100% é autorizado ao Usuário que esteja em dia com a contratação dos serviços do Mova, e terá disponível os seguintes produtos em sua área restrita: certificado em formato PDF disponível para impressão pelo Usuário; script de programação para inclusão da imagem dinâmica do Selo em seu site de internet; script de programação para inclusão da assinatura do Selo em e-mails; versões gráficas do Selo e instruções de uso da marca para aplicação do Selo em materiais off-line; links de posts sobre o Mova para que o Usuário possa compartilhar em redes sociais; divulgação do nome da empresa como usuária do Mova nos sites do Mova e da Certificação de Energia Renovável (www.seloenergiarenovavel.com.br). <p>

                <p>A logomarca que caracteriza o Mova não pode, em hipótese alguma, ser utilizada como marca de produto ou empregada na razão social ou nome fantasia da empresa Usuária. <p>

                <p>A logomarca que caracteriza o Mova não deve ser alterada graficamente; somente as dimensões podem ser alteradas, mantendo-se a proporção, desde que a logomarca seja mantida legível. <p>

                <p>O uso do Selo Mova é restrito aos Usuários dos serviços, e o direito de uso deste não deve ser transferido para terceiros, substitutos ou outros, nem ser objeto de cessão ou aquisição. <p>

                <p>Suspensa ou cancelada a autorização de uso do Selo Mova, o Usuário se obriga a cessar, imediatamente, toda e qualquer publicidade ou divulgação que tenha relação com o Selo Mova, inclusive retirando todas as citações e identificações dos materiais e sites no prazo de 30 dias. <p>

                <p>O Usuário é responsável por todas as taxas, custos, despesas, multas, penalidades e outros passivos incorridos pelo Mova e seus desenvolvedores decorrentes da violação destes Termos e / ou seu uso dos serviços por parte do Usuário. <p>

                <p>O Ziit poderá, sem prévio aviso, bloquear e cancelar o acesso ao site e ao Selo quando verificar que o Usuário praticou algum ato ou mantenha conduta que (i) viole as leis e regulamentos federais, estaduais e / ou municipais, (ii) contrarie as regras destes Termos de Uso, ou (iii) viole os princípios da moral e dos bons costumes.</p>

                <p>Toda e qualquer ação executada ou conteúdo publicado pelo Usuário durante o uso do Selo será de sua exclusiva e integral responsabilidade, devendo isentar e indenizar o Mova e seus desenvolvedores de quaisquer reclamações, prejuízos, perdas e danos causados, em decorrência de tais ações ou manifestações.</p>

                <p>Mova usará esforços comercialmente razoáveis para disponibilizar os serviços em todos os momentos exceto para eventual indisponibilidade de rede de dados no local do Usuário ou do provedor de serviço do Mova ou qualquer indisponibilidade devido a força maior. Mova não assumirá responsabilidade perante o Usuário ou qualquer terceiro em relação a sua incapacidade de acessar os serviços a qualquer momento.</p>

                <p>O Usuário autoriza o Mova e seus desenvolvedores ou terceiros por ele indicados, a utilizar, por prazo indeterminado, as informações fornecidas no ato do cadastro para fins estatísticos e envio de material publicitário, newsletters, informes, etc.</p>

                <p>O Usuário é exclusivamente responsável por todo e qualquer conteúdo por ele enviado ou publicado através do site. Ao enviar ou publicar o conteúdo, o Usuário garante que ele não viola quaisquer direitos de terceiros ou leis vigentes e concorda em manter o Mova e seus desenvolvedores isentos de quaisquer reclamações judiciais ou extrajudiciais de terceiros, assumindo-as, caso existentes. <p>

                <p>O Usuário cede irrevogavelmente e autoriza o Mova e seus desenvolvedores a utilizar o conteúdo por ele enviado ou publicado através do registro no site, gratuitamente, por prazo indeterminado e em qualquer território, na página de internet (site) do Ziit, Mova e respectivas redes sociais.</p>

                <p>O Usuário concorda e entende que é responsável por manter a confidencialidade e a segurança de sua senha, que, juntamente com o seu ID de login (endereço de correio eletrônico), permite que o Usuário acesse os serviços do site. Caso o Usuário tome conhecimento de qualquer uso não autorizado de seu registrou ou cadastro, o Usuário concorda em notificar o Mova pelos canais designados no site. <p>

                <p>Ao se registrar no site, independente de fechamento da operação de contratação, o Usuário concorda em receber mensagens e notificações via e-mail ou outros meios ou por meio de redes sociais relativas.</p>

                <p>As informações solicitadas ao Usuário no momento do cadastro serão utilizadas pelo Mova e seus desenvolvedores somente para os fins previstos neste Termo de Uso, e em nenhuma circunstância tais informações serão cedidas ou compartilhadas com terceiros fora dos fins previstos neste Termo de Uso, exceto por ordem judicial ou de autoridade competente, nos moldes da legislação vigente.</p>

                <p>Ao acessar o site e fazer uso do Selo, cabe ao Usuário cumprir todas as leis aplicáveis e quaisquer outras condições ou restrições em qualquer notificação por escrito ou on-line do Mova (incluindo estes Termos). O Usuário concorda que não usará o Selo para qualquer propósito ilegal e ou proibido por estes Termos. Os serviços do Mova são oferecidos para uso comercial, dado que os serviços sempre são contratados em nome de empresas legalmente estabelecidas. O Mova e seus desenvolvedores não concedem ao Usuário quaisquer direitos, expressos ou implícitos, para acessar ou utilizar os serviços para qualquer outra finalidade além daquelas expressas neste termo.</p>

                <p>Além dos Termos já explicitados, o Usuário concorda em não se passar por outra pessoa ou entidade ou empresa, seja real ou fictícia, ou declarar falsamente ou outra forma, deturpar sua afiliação com qualquer pessoa ou entidade ou empresa; não interferir com os direitos de quaisquer outros Usuários à privacidade e publicidade, inclusive por coleta de informações de ou sobre os demais Usuários; não fazer “upload” ou transmitir por qualquer comunicação, software ou materiais que contenha vírus ou que seja prejudicial para os computadores dos servidores do Mova, Usuários e sistemas; não se engajar em atividades de coleta de dados de Usuários do site ou outras informações de poder do Mova e seus desenvolvedores, incluindo, sem limitação, quaisquer informações que residam em qualquer servidor ou banco de dados conectado aos serviços.</p>

                <p>O site do site Mova (incluindo, mas não limitado ao texto, imagens, fotografias, gráficos, interface de Usuário, capturas de tela, desenhos e código de fontes) é protegido sob as leis de direito do Brasil e outros países. Os desenvolvedores do site possuem direitos sobre as marcas, desenhos, programas de computador, métodos desenvolvidos e os conceitos do site e dos serviços fornecidos, devidamente registrados junto aos órgãos e autarquias responsáveis, no Brasil. A menos que expressamente permitido por escrito, o Usuário e qualquer outra pessoa física ou jurídica não pode copiar, reproduzir, distribuir, publicar, entrar em um banco de dados, exibir, executar, modificar, criar obras derivadas, transmitir ou de qualquer forma explorar qualquer parte do website.</p>

                <p>Os desenvolvedores do site Mova não autorizam a utilização do seu nome, marca ou logotipo para quaisquer fins, portanto, não é permitida a publicidade do nome, marca ou logotipo do Mova, exceto se prévia e expressamente autorizado pelos seus representantes legais do e após as devidas negociações.</p>

                <p>O Usuário pode ser capaz de utilizar o website do Mova para acessar websites vinculados à iniciativa. Isto inclui links de anunciantes, patrocinadores e parceiros de negócios que podem utilizar a marca Mova como parte de uma relação de parceria. O Usuário reconhece e concorda que o Mova e seus desenvolvedores não têm responsabilidade sobre a informação, conteúdo, produtos, serviços, publicidade, código ou outros materiais que podem ou não podem ser fornecidos por ou através de sites interligados. Links para tais sites não implicam qualquer endosso pelo Mova e seus desenvolvedores de tais sites ou recursos ou conteúdo, produtos ou serviços disponíveis nesses sites ou recursos. Esses sites não estão sob controle do Mova e seus desenvolvedores, e links para outros sites são fornecidos apenas para conveniência dos Usuários. O Usuário reconhece que quando deixar o site do Mova por qualquer meio, incluindo, mas não limitado a, quando clica em um link existente no site do Mova e deixa o site do Mova, os sites em que Usuário entrará não são controlados pelo Mova e podem aplicar diferentes Termos de condições de uso e privacidade. Se o Usuário optar por usar ou adquirir serviços de terceiros, está sujeito a seus Termos e condições e política de privacidade.</p>

                <p>O uso dos serviços é feito pelo Usuário por sua conta e risco. Os serviços são entregues de forma unilateral por parte do Mova, mediante condições comerciais expressas nos formulários de contratação. O Mova renuncia expressamente a todas as garantias de qualquer tipo, quer expressas, implícitas ou estatutárias, incluindo, mas não limitado a garantias implícitas de comercialização, adequação a uma finalidade específica, título e não violação.</p>

                <p>Mova não garante que (i) os serviços atenderão a todos os requisitos do Usuário, (ii) os serviços serão ininterruptos, seguros ou livre de erros, (iii) os resultados que podem ser obtidos com o uso dos serviços serão precisos ou confiáveis, ou (iv) a qualidade de quaisquer produtos, serviços, informações ou outro material adquirido ou obtido pelo Usuário através dos serviços atenderá às expectativas do Usuário.</p>

                <p>O Usuário expressamente entende e concorda que o cadastro no site e uso do Selo não será responsável por quaisquer danos indiretos, incidentais, especiais, consequenciais, danos por perda de lucros incluindo mas não limitado a, danos por perda de boa vontade, uso, dados ou outras perdas intangíveis (mesmo que os desenvolvedores do aplicativo tenham sido avisados da possibilidade de tais danos), sejam eles baseados em contrato, ato ilícito, negligência, responsabilidade estrita ou outra forma, resultantes de: (i) uso ou incapacidade de uso dos serviços; (ii) o custo de aquisição de substituição de bens e serviços resultantes de quaisquer bens, dados, informações ou serviços comprados ou obtidos ou mensagens recebidas ou transações celebrados através dos ou a partir dos serviços; (iii) acesso não autorizado a informações da sua conta; (iv) declarações ou conduta de terceiros nos serviços; (v) qualquer outra questão relativa aos serviços. <p>

                <p>Todos os riscos derivados da utilização do Mova são do Usuário. Se o seu uso resultar na necessidade de serviços ou reposição de material, propriedade, equipamento ou informação do Usuário, o Mova e seus desenvolvedores não serão responsáveis por tais custos.</p>

                <p>O Mova e seus desenvolvedores se eximem de toda e qualquer responsabilidade pelos danos e prejuízos de qualquer natureza que possam decorrer do acesso, interceptação, eliminação, alteração, modificação ou manipulação por terceiros não autorizados, dos dados do Usuário durante a utilização do site. Sem limitar a generalidade anterior, os desenvolvedores do aplicativo rejeitam qualquer responsabilidade de qualquer natureza, decorrentes do acesso não autorizado ou uso das informações pessoais do Usuário.</p>

                <p>Fica eleito o Foro da Comarca da cidade de São Paulo, Estado de São Paulo, para dirimir quaisquer questões decorrentes destes Termos de Uso, que será regido pelas leis brasileiras.</p>

                <p>Caso haja qualquer dúvida ou sugestão sobre estes Termos de Uso, escreva para: contato@movaenergia.com.br.</p>

                <p>Registrado no Xº Oficial de Registro de Títulos e Documentos, sob registro em microfilme número XXXX.</p>


            </div>
        </div>

        <div class="zb-modal-premium">
            {{-- <button type="button" class="zb-close-modal">X</button> --}}
            <div class="zb-form-grauito-response">
                <span class="zb-loader"></span>
                <p>Por favor, aguarde...</p>
                <button class="zb-btn-ok-premium" type="button">OK</button>
                <button class="zb-btn-fechar" type="button">FECHAR</button>
            </div>
        </div>


        <script type="text/javascript">
            var eolica = {!! $eolica !!};
            var hidrica = {!! $hidrica !!};
            var solar = {!! $solar !!};
            var biomassa = {!! $biomassa !!};
        </script>


        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfMWadtyuU9OiZBvjpTzYQn22YziNKyp4&language=pt&region=BR&" async defer></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/slick.min.js"></script>
        <script src="js/vendor/featherlight.js"></script>
        <script src="js/vendor/slick-animation.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/jquery.inputmask.bundle.min.js"></script>
        <script src="js/inputmask/inputmask.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
