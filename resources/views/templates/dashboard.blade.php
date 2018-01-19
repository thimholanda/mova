<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
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

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body class="zb-bg-dashboard">
        <!--[if lt IE 8]>
             <p class="browserupgrade">Você está utilizando um browser<strong>desatualizado</strong>. Por favor, <a href="http://browsehappy.com/">atualize seu browser</a> para melhorar sua experiência.</p>
        <![endif]-->


        <aside class="zb-menu-lateral">

            <h1><span>Ziit Business</span></h1>

            <div class="zb-container-user-info">

                @cannot('is-premium')

                     @if($solicitacao)

                        @if($solicitacao->count() > 0)


                            @if($solicitacao->first()->aprovado == 1 || $solicitacao->first()->aprovado == 3)

                                @php

                                    switch ($solicitacao->first()->pagamento_status) 
                                    {
                                        case 0:
                                            echo "<a class='zb-conta-premium' href=" . url('painel/usuario/minha-conta') . " title='minha conta'>faça o pagamento para ativar sua conta premium</a>";  
                                            break;

                                        case 1:
                                            echo "<a class='zb-conta-premium' href=" . url('painel/usuario/minha-conta') . " title='minha conta'>faça o pagamento para ativar sua conta premium</a>";  
                                            break;

                                        case 2:
                                            echo "<a class='zb-conta-premium' href=" . url('painel/usuario/minha-conta') . " title='minha conta'>seu pagamento está em análise</a>";  
                                            break;

                                        case 3:
                                            echo "<a class='zb-conta-premium' href=" . url('painel/usuario/minha-conta') . " title='minha conta'>selecione o tipo de energia para ativar sua conta premium</a>";  
                                            break;

                                        case 7:
                                            echo "<a class='zb-conta-premium' href=" . url('painel/usuario/minha-conta') . " title='minha conta'>faça o pagamento para ativar sua conta premium</a>";  
                                            break;
                                    }

                                @endphp

                            @else
                                <a class="zb-conta-premium" href="{{ url('painel/usuario/minha-conta') }}" title="minha conta">aguardando ativação da conta premium</a>
                            @endif                       

                        @else
                            <a class="zb-conta-premium" href="{{ url('painel/usuario/minha-conta') }}" title="minha conta">ative sua conta premium</a>
                        @endif

                    @else
                        <a class="zb-conta-premium" href="{{ url('painel/usuario/minha-conta') }}" title="minha conta">ative sua conta premium</a>
                    @endif

                    
                @endcannot

                <div class="zb-user-info">

                    <span class="zb-user-icon">{{ Helper::getFirstLetter(auth()->user()->name) }}</span>

                    <div class="zb-container-user-infos">                        

                        <span>Bem-vindo(a)</span>
                        <span class="zb-name">{{ auth()->user()->name }}</span>

                        <a class="zb-minha-conta" href="{{ url('painel/usuario/minha-conta') }}" title="minha conta"><i class="fa fa-cog" aria-hidden="true"></i> minha conta</a>

                    </div>

                </div>

            </div>

            <nav class="zb-dash-menu">
                <ul>

                    <li><a class="{{ Request::path() == 'painel/usuario' ? 'active' : '' }}" href="{{ url('painel/usuario') }}" title="HOME"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
                    <li><a class="{{ Request::path() == 'painel/usuario/produtos' ? 'active' : '' }}" href="{{ url('painel/usuario/produtos') }}" title="MEUS PRODUTOS"><i class="fa fa-tags" aria-hidden="true"></i> MEUS PRODUTOS</a></li>
                    <li><a class="{{ Request::path() == 'painel/usuario/origem' ? 'active' : '' }}" href="{{ url('painel/usuario/origem') }}" title="ORIGEM DE SUA ENERGIA"><i class="fa fa-map-marker" aria-hidden="true"></i> ORIGEM DE SUA ENERGIA</a></li>
                    <li><a class="{{ Request::path() == 'painel/usuario/faq' ? 'active' : '' }}" href="{{ url('painel/usuario/faq') }}" title="FAQ"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQ</a></li>
                    <li><a class="{{ Request::path() == 'painel/usuario/contato' ? 'active' : '' }}" href="{{ url('painel/usuario/contato') }}" title="CONTATO"><i class="fa fa-comment" aria-hidden="true"></i> CONTATO</a></li>
                </ul>
            </nav>

        </aside>

        <header class="zb-header-dashboard">
            <h2><i class="fa fa-user" aria-hidden="true"></i> Painel do Usuário</h2>

            <div class="zb-right-dashboard-menu">

                <div class="zb-container-notifications">
                    <button class="zb-btn-notifications"><i class="fa fa-envelope-o" aria-hidden="true"></i><span class="zb-badge {{ $notifications->count() > 0 ? '' : 'zb-badge-gray' }}">{{ $notifications->count() }}</span></button>
                    <nav class="zb-list-notifications">
                        <span class="zb-arrow"></span>

                        <table>
                            <tbody>

                            @forelse($notifications as $notification)
                                <tr class="zb-active">
                                    <td>{!! $notification->text !!}</td>
                                    <td><button notification_id="{{ $notification->id }}" type="button"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>não existem notificações</td>
                                </tr>
                            @endforelse

                            <tr class="zb-no-notifications" style="display: none; border-top: 0;">
                                <td>não existem notificações</td>
                            </tr>
                                
                            </tbody>
                        </table>                        
                            
                    </nav>
                </div>
                
                <button class="zb-button-user">

                    <span class="zb-user-icon">{{ Helper::getFirstLetter(auth()->user()->name) }}</span>
                    <span class="zb-name">{{ title_case(auth()->user()->name) }}</span>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>

                    <div class="zb-cascade-menu">

                        <nav>
                            <ul>
                                @cannot('is-premium')

                                @if($solicitacao)

                                    @if($solicitacao->count() == 0)
                                        <li><a href="{{ url('painel/usuario/minha-conta') }}" title="Ativar Conta"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Ativar Conta</a></li>
                                    @endif

                                @else
                                    <li><a href="{{ url('painel/usuario/minha-conta') }}" title="Ativar Conta"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Ativar Conta</a></li>
                                @endif

                                @endcannot
                                <li><a href="{{ url('painel/usuario/minha-conta') }}" title="Minha Conta"><i class="fa fa-cog" aria-hidden="true"></i> Minha Conta</a></li>
                                <li><a href="{{ route('logout') }}" title="Log Out"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a></li>
                            </ul>
                        </nav>
                    </div>

                </button>

            </div>            
            
        </header>


        @yield('content')


        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn7_h6e8qmhWJ4uMpnh7KY_X2G9lrJ6M0"></script>
        <script src="{{ asset('js/vendor/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('js/vendor/featherlight.js') }}"></script>
        <script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('js/inputmask/inputmask.min.js') }}"></script>
        <script src="{{ asset('js/specs.js') }}"></script>
    </body>
</html>