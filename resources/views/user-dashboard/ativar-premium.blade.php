@extends('templates.dashboard')

@section('title', 'Ziit Business - Minha Conta')

@section('content')

<section class="zb-section-dashboard">

    <div class="row">
        <div class="col-md-12">
            <h1 class="zb-dashboard-regular-title"><a class="zb-breadcrumbs" href="{{ url('painel/usuario/minha-conta') }} ">Minha Conta</a> > Ativar Conta Premium</h1>
        </div>
        <div class="col-md-12">
          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
          </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <h3><strong>Passo 1</strong></h3>
            <p>Primeiro, vamos fazer uma simulação para saber qual será o valor investido:</p>
            <br>

        </div>
        
    </div>

    <div class="row">

        <div class="col-md-12">

            <p>
                <i class="fa fa-usd" aria-hidden="true"></i> <strong>Simulação</strong>
            </p>

            <div class="zb-white-container">

            <form>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('kwh') ? ' has-error' : '' }}">
                            <label>Quantos kWh (quilo Watt hora) sua empresa usa por mês? <a href="#" data-featherlight="{{ asset('img/img-simulacao.jpg') }}">ver como <i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                            <input type="text" class="form-control" name="kwh" value="{{ $simulacao->kwh or '' }}">
                        </div>

                    </div>

                </div>

                <br>
                <div class="row zb-dashboard-centered">

                    <button class="btn btn-success btn-simular-usuario" type="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>simular</strong></button>

                </div>

                <br>

                <div class="row zb-investimento-resultado">

                    <div class="col-md-12">

                        <label>O investimento estimado será de:</label>
                        <div class="zb-investimento">R$ <strong>{{ $simulacao ? str_replace('.', ',', $simulacao->preco) : '' }}</strong> POR ANO</div>
                        <input type="hidden" name="investimento" value="{{ $simulacao->preco or '' }}">

                    </div>

                    
                    <div class="col-md-12">
                        <div class="row zb-dashboard-centered">
                            <br>
                            <button class="btn btn-success btn-prosseguir" type="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>quero prosseguir</strong></button>

                        </div>
                    </div>
                    
                </div>               

            </form>

            </div>
        </div>
        
    </div>

    <div class="row passo2">
        
        <div class="col-md-12">
            <h3><strong>Passo 2</strong></h3>
            <p>
                Precisamos de algo que comprove o consumo que você informou. Para isso, utilizaremos as imagens das contas de luz de sua empresa. Temos duas opções, qual você prefere?
            </p>
            <br>
        </div>

        <div class="col-md-12">
            <div class="row zb-dashboard-centered">
                <br>

                <div class="zb-wrap-button-user">
                    <button class="btn btn-success btn-historico" type="submit"><strong>Enviar histórico de consumo <br>(apenas 1 conta é necessária)</strong></button>
                    <a href="#" data-featherlight="{{ asset('img/img-historico.jpg') }}">ver como <i class="fa fa-question-circle" aria-hidden="true"></i></a>
                </div>

                <div class="zb-wrap-button-user">
                    <button class="btn btn-success btn-contas" type="submit"><strong>Enviar contas<br>(precisaremos das 12 últimas contas)</strong></button>
                    <a href="#" data-featherlight="{{ asset('img/img-avulsa.jpg') }}">ver como <i class="fa fa-question-circle" aria-hidden="true"></i></a>
                </div>

            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
        </div>
    </div>

    <input type="hidden" name="old_tipo" value="{{ old('tipo') }}">

    <div class="row passo3-contas" id="passo3">

        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger container-erros" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-md-12">
            <h3><strong>Passo 3 - enviar contas</strong></h3>
                <p>
                    Caso não tenha a conta física em mãos, entre no site de sua distribuidora de energia elétrica e verifique as instruções para consultar os dados de consumo. Insira os dados de pelo menos 9 meses anteriores ao mês vigente. Caso algum mês fique em branco, o sistema atribuirá a média automaticamente.
                </p>
            <br>
        </div>

        <div class="col-md-12">
            <div class="zb-white-container">

                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Importante: </strong>o seu consumo deve ser reportado referente a 12 meses anteriores ao mês vigente.<br><br></p>
                    </div>
                </div>

                <form id="form-contas" action="{{ route('enviar_solicitacao') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="2">

                    <input type="hidden" name="simulacao_id" value="{{ $simulacao->id or '' }}">

                    <div class="row">

                        @for($i = 1; $i <= 12; $i++)
                        <?php $select = $i-1; ?>


                        <div class="col-md-7">                                
                            <div class="form-group{{ $errors->has('mes_conta.'.$select) ? ' has-error' : '' }}">
                                <label>Mês {{ $i }}</label>
                                <input type="text" class="form-control mascara-input" name="mes_conta[]"  placeholder="kWh" value="{{ old('mes_conta.'.$select) }}">
                            </div>
                        </div>

                        <div class="col-md-5">                                
                            
                                <label>Imagem Mês {{ $i }}</label>
                                <input class="zb-input-contas" id="file{{ $i }}" type="file" name="imagem{{$i}}" >
                                <label for="file{{ $i }}"><span><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp;clique aqui e selecione o arquivo</span></label>
                        </div>

                        @endfor

                    </div>

                    <br>
                    <div class="row zb-dashboard-centered">

                        <button class="btn btn-success zb-btn-submit-pano btn-submit-contas" type="submit"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>solicitar ativação</strong></button>

                    </div>


                </form>


            </div>
        </div>

    </div>

    <div class="row passo3-historico" id="passo3">

        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger container-erros" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-md-12">
            <h3><strong>Passo 3 - enviar histórico de consumo</strong></h3>
            <p>
                Caso não tenha a conta física em mãos, entre no site de sua distribuidora de energia elétrica e verifique as instruções para consultar os dados de consumo. Insira os dados de pelo menos 9 meses anteriores ao mês vigente. Caso algum mês fique em branco, o sistema atribuirá a média automaticamente.
            </p>
            <br>
        </div>



        <div class="col-md-12">
            <div class="zb-white-container">

                <form id="form-historico" action="{{ route('enviar_solicitacao') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="1">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('conta') ? ' has-error' : '' }}">
                                <label for="conta">Por favor, faça o upload da conta com a informação do histórico de consumo</label>
                                <br>
                                <input class="zb-input-contas" id="conta" type="file" name="conta">
                                <label for="conta"><span><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp;clique aqui e selecione o arquivo</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Importante: </strong>o seu consumo deve ser reportado referente a 12 meses anteriores ao mês vigente.<br><br></p>
                        </div>
                    </div>

                    <div class="row">


                        @for($i = 1; $i <= 12; $i++)

                        <?php $select = $i-1; ?>
                        <div class="col-md-4">                            
                            <div class="form-group{{ $errors->has('mes.'.$select) ? ' has-error' : '' }}">
                                <label>Mês {{ $i }}</label>

                                <input type="text" class="form-control mascara-input" name="mes[]"  placeholder="kWh" value="{{ old('mes.'.$select) }}">
                            </div>
                        </div>

                        @endfor

                    </div>
                    

                    <input type="hidden" name="simulacao_id" value="{{ $simulacao->id or '' }}">

                    <br>
                    <div class="row zb-dashboard-centered">

                        <button class="btn btn-success btn-submit-contas" type="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong>solicitar ativação</strong></button>

                    </div>

            </form>

            </div>
        </div>

    </div>

</section>

<div class="zb-confirmacao-meses">
    <h1>
        Confira o valor consolidado de sua assinatura anual baseado nos dados informados:
    </h1>    
    <p class="zb-confirmacao-preco"><strong>R$ 100,00/ano</strong></p>
    <p class="zb-confirmacao-consumo">Média mensal de consumo: <strong>444 kWh</strong></p>
    <button type="button" class="btn btn-large btn-success zb-confirm">finalizar ativação</button>
    <button type="button" class="btn btn-danger zb-cancel btn-cancelar-solicitacao">cancelar</button>
    
</div>
<div class="zb-pano-confirmacao-meses"></div>

@include('app.submit-loader')

@endsection



