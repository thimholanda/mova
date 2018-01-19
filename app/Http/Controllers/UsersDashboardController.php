<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Notifications\SolicitacaoStatus;
use App\Mail\ContatoMail;

class UsersDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:usuario');
    }

    public function index()
    {
        if(Gate::allows('is-premium'))
        {
            $tipo_assinatura = 'premium';
        }
        else
        {
            $tipo_assinatura = 'gratuita';
        }

        $rec_alocados = \App\RecAlocado::where('user_id', auth()->user()->id);
        $config = \App\Configuracoes::find(1);

        if($rec_alocados)
        {
            $total_recs = $rec_alocados->sum('quantidade');
            $current_year = date('Y');
            $now = Carbon::now('America/Sao_Paulo');
            $initialDate = Carbon::createFromDate($current_year, 1, 1, 'America/Sao_Paulo');
            $seconds = (float)$now->diffInSeconds($initialDate);
            $pattern = (float)0.010416666666667;
            $emissoes_evitadas = $seconds * $pattern * $total_recs;
            $emissoes_evitadas = $emissoes_evitadas;
            $emissoes_evitadas = number_format($emissoes_evitadas);
        }

        else
        {
            $emissoes_evitadas = '';
        }

        $user = auth()->user();
        $assinatura = $user->assinaturas()->where('tipo', $tipo_assinatura)->where('ativa', 1)->first();
        $notifications = $user->notifications()->get();
        $solicitacao = $user->solicitacoes();

    	return view('user-dashboard.index', compact('user', 'notifications', 'assinatura', 'emissoes_evitadas', 'solicitacao'));
    }

    public function produtos()
    {
        if(Gate::allows('is-premium'))
        {
            $tipo_assinatura = 'premium';
        }
        else
        {
            $tipo_assinatura = 'gratuita';
        }

        $user = auth()->user();
        $assinatura = $user->assinaturas()->where('tipo', $tipo_assinatura)->where('ativa', 1)->first();
        $notifications = $user->notifications()->get();
        $solicitacao = $user->solicitacoes();

    	return view('user-dashboard.produtos', compact('user', 'notifications', 'assinatura', 'solicitacao'));
    }

    public function origem()
    {
        $user = auth()->user();
        $assinatura = \App\Assinatura::where('user_id', $user->id)->where('ativa', 1)->with('usina', 'user', 'user.userInfos', 'rec_alocado')->first();
        $notifications = $user->notifications()->get();
        $solicitacao = $user->solicitacoes();

        $rec_alocados = \App\RecAlocado::where('user_id', auth()->user()->id)->get();

        $rec_alocados_sum = $rec_alocados->sum('quantidade');

        $config = \App\Configuracoes::find(1);

        if($rec_alocados)
        {
            $total_recs = $rec_alocados->sum('quantidade');
            $current_year = date('Y');
            $now = Carbon::now('America/Sao_Paulo');
            $initialDate = Carbon::createFromDate($current_year, 1, 1, 'America/Sao_Paulo');
            $seconds = (float)$now->diffInSeconds($initialDate);
            $pattern = (float)0.010416666666667;
            $emissoes_evitadas = $seconds * $pattern * $total_recs;
            $emissoes_evitadas = $emissoes_evitadas;
            $emissoes_evitadas = number_format($emissoes_evitadas);
        }

        else
        {
            $emissoes_evitadas = '';
        }

    	return view('user-dashboard.origem', compact('user', 'notifications', 'assinatura', 'emissoes_evitadas', 'solicitacao', 'rec_alocados_sum'));
    }

    public function faq()
    {
        $user = auth()->user();
        $perguntas = \App\Faq::orderBy('position', 'ASC')->get();
        $notifications = $user->notifications()->get();
        $solicitacao = $user->solicitacoes();


    	return view('user-dashboard.faq', compact('user', 'notifications', 'perguntas', 'solicitacao'));
    }

    public function contato()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->get();
        $contatos = $user->contatos()->with('resposta')->whereHas('resposta')->orderBy('created_at', 'DESC')->get();
        $solicitacao = $user->solicitacoes();

    	return view('user-dashboard.contato', compact('user', 'notifications', 'contatos', 'solicitacao'));
    }

    public function resposta($id)
    {
        $user = auth()->user();
        $notifications = $user->notifications()->get();
        $resposta = \App\Resposta::where('id', $id)->with('contato')->first();
        $solicitacao = $user->solicitacoes();
        return view('user-dashboard.resposta', compact('user', 'notifications', 'resposta', 'solicitacao') );
    }

    public function contato_action(Request $request)
    {

        $emails = ['contato@ziitbusiness.com.br', 'mikelopes@idealista.net.br'];
        // $emails = ['thimholanda@gmail.com'];

        $this->validate($request, \App\Contato::rules(), \App\Contato::messages());

        $data = Input::all();
        $data['user_id'] = auth()->user()->id;

        $contato = \App\Contato::create($data);

        $log = new \App\Log;
        $log->user_id = auth()->user()->id;
        $log->mensagem = 'envio de mensagem';
        $log->url = url('/painel/administrador/mensagens/visualizar', $contato->id);
        $log->save();

        $user = auth()->user();

        \Mail::to($emails)->send( new ContatoMail($user->name, $user->email, $request->assunto, $request->mensagem) );

        $request->session()->flash('alert-success', 'Sua mensagem foi enviada com sucesso! Responderemos em breve.');
        return redirect()->back();
    }

    public function minhaConta()
    {
        $user = auth()->user();
        $logotipo = \App\Logotipo::where('user_id', auth()->user()->id)->first();
        $notifications = $user->notifications()->get();
        $solicitacao = \App\Solicitacao::where('user_id', $user->id)->where('ativa', 1)->with('simulacao', 'meses')->first();

        if($solicitacao)
        {
            if($solicitacao->aprovado)
            {
                $recs = $solicitacao->simulacao->recs;

                $usinas = \App\Usina::where('ativa', 1)->where('recs_disponiveis', '>=', $recs)->groupBy('fonte_energia')->get();
            }

            $media_kwh = ceil($solicitacao->meses->sum('base_calculo') / $solicitacao->meses->count());

            $recs = ceil($media_kwh * 12 / 1000);

            if($recs < 3)
            {
                $recs = 3;
            }

            if($recs > 204)
            {
                $preco = "valor excede o limite";
            }
            else
            {
                $preco = \App\Preco::where('quantidade_recs', $recs)->first();
            }

            $resultado = $preco->preco - $solicitacao->simulacao->preco;

            $boleto = \App\BoletoExtra::where('solicitacao_id',  $solicitacao->id)->first();

        }

        if(Gate::allows('is-premium'))
        {
            $tipo_assinatura = 'premium';
        }
        else
        {
            $tipo_assinatura = 'gratuita';
        }

        $assinatura = $user->assinaturas()->where('tipo', $tipo_assinatura)->where('ativa', 1)->with('usina')->first();


    	return view('user-dashboard.minha-conta', compact('user', 'notifications', 'solicitacao', 'usinas', 'assinatura', 'resultado', 'logotipo', 'recs', 'boleto'));
    }

    public function atualizar_dados(Request $request)
    {
        $this->validate($request, \App\User::rulesConta($request), \App\User::messagesConta());

        $user = \App\User::find(auth()->user()->id);
        $user_infos = \App\UserInfos::where('user_id', $user->id)->first();

        $user->email = $request->email;
        $user->name = $request->nome_empresa;
        $user->save();

        $user_infos->nome_empresa = $request->nome_empresa;
        $user_infos->nome_responsavel = $request->nome_responsavel;
        $user_infos->save();

        $request->session()->flash('alert-success', 'Seus dados foram atualizados com sucesso!');
        return redirect()->back();
    }

    public function removeNotificacao(Request $request)
    {
        $user = auth()->user();
        $user->notifications()->detach($request->id);
    }

    public function ativar_premium()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->get();
        $simulacao = \App\Simulacao::where('user_id', auth()->user()->id)->first();
        $solicitacao = $user->solicitacoes();

        return view('user-dashboard.ativar-premium', compact('user', 'notifications', 'simulacao', 'solicitacao'));
    }

    public function simule_admin($quantidade)
    {
        $recs = ceil($quantidade * 12 / 1000);

        if($recs < 3)
        {
            $recs = 3;
        }

        if($recs > 204)
        {
            return response()->json(['erro' => 'Nosso produto disponibiliza no máximo 17.000 kWh/mês. Por favor, entre em contato para mais informações.' ]);
        }

        $preco = \App\Preco::where('quantidade_recs', $recs)->first();

        $simulacao = \App\Simulacao::where('user_id', auth()->user()->id)->first();

        if(!$simulacao)
        {
            $simulacao = new \App\Simulacao;
            $simulacao->kwh = (float)$quantidade;
            $simulacao->preco = $preco->preco;
            $simulacao->recs = (int)$recs;
            $simulacao->user_id = auth()->user()->id;
            $simulacao->save();

            $log = new \App\Log;
            $log->user_id = auth()->user()->id;
            $log->mensagem = 'simulação: '. $simulacao->kwh .' kWh - R$ ' . $simulacao->preco;
            $log->save();
        }
        else
        {
            $log = new \App\Log;
            $log->user_id = auth()->user()->id;
            $log->mensagem = 'simulação: '. $simulacao->kwh .' kWh - R$ ' . $simulacao->preco;
            $log->save();

            $simulacao->kwh = (float)$quantidade;
            $simulacao->preco = $preco->preco;
            $simulacao->recs = (int)$recs;
            $simulacao->save();
        }

        return response()->json(['preco' => (float)$preco->preco, 'simulacao_id' => $simulacao->id  ]);
    }

    public function enviar_solicitacao(Request $request)
    {
        $emails = ['contato@ziitbusiness.com.br', 'mikelopes@idealista.net.br'];
        // $emails = ['thimholanda@gmail.com'];



        $user = auth()->user();

        if($request->tipo == 1)
        {
            // Ações Histórico
            $this->validate($request, \App\Solicitacao::historicoRules($request), \App\Solicitacao::historicoMessages($request));

            // Armazenamento da imagem
            $conta = $request->file('conta')->store('/public/uploads');

            //Criar solicitação
            $solicitacao = new \App\Solicitacao;
            $solicitacao->tipo = 1;
            $solicitacao->user_id = $user->id;
            $solicitacao->imagem = $conta;
            $solicitacao->simulacao_id = $request->simulacao_id;
            $solicitacao->save();

            $simulacao = \App\Simulacao::find($request->simulacao_id);

            $data = [
                'items' => [
                    [
                        'id' => $solicitacao->id,
                        'description' => 'Conta Premium - Mova',
                        'quantity' => '1',
                        // 'amount' => $simulacao->preco,
                        'amount' => .50,
                    ]
                ],
            ];

            $checkout = \PagSeguro::checkout()->createFromArray($data);
            $credentials = \PagSeguro::credentials()->get();

            try
            {
                $information = $checkout->send($credentials);
            }
            catch(\Exception $e)
            {
                $solicitacao->delete();
                $request->session()->flash('alert-danger', 'Não foi possível enviar sua solicitação. Por favor, tente novamente.');
                return redirect()->back();
            }


            if($information)
            {
                $link_pagamento = $information->getLink();
            }
            else
            {
               $link_pagamento = '0';
            }

            $atualizar_solicitacao = \App\Solicitacao::find($solicitacao->id);
            $atualizar_solicitacao->pagamento_link = $link_pagamento;
            $atualizar_solicitacao->save();

            foreach ($request->mes as $key => $value)
            {
                if($value != null)
                {
                    //Criar mês
                    $label = $key+1;
                    $mes = new \App\Mes;
                    $mes->descricao = $label;
                    $mes->kwh = $value;
                    $mes->base_calculo = $value;
                    $mes->solicitacao_id = $solicitacao->id;
                    $mes->save();
                }

            }
        }

        elseif($request->tipo == 2)
        {
            // Ações Contas
            $this->validate($request, \App\Solicitacao::contasRules($request), \App\Solicitacao::contasMessages($request));

            // Array para armazenar os endereços das imagens
            $path_imagens = [];

            // Armazenamento das imagens
            foreach($request->file() as $file)
            {
                $path_imagens[] = $file->store('/public/uploads');
            }

            //Criar solicitação
            $solicitacao = new \App\Solicitacao;
            $solicitacao->tipo = 2;
            $solicitacao->user_id = $user->id;
            $solicitacao->simulacao_id = $request->simulacao_id;
            $solicitacao->save();

            $simulacao = \App\Simulacao::find($request->simulacao_id);

            $data = [
                'items' => [
                    [
                        'id' => $solicitacao->id,
                        'description' => 'Conta Premium - Ziit Business',
                        'quantity' => '1',
                        'amount' => $simulacao->preco,
                    ]
                ],
            ];

            $checkout = \PagSeguro::checkout()->createFromArray($data);
            $credentials = \PagSeguro::credentials()->get();

            try
            {
                $information = $checkout->send($credentials);
            }
            catch(\Exception $e)
            {
                $solicitacao->delete();
                $request->session()->flash('alert-danger', 'Não foi possível enviar sua solicitação. Por favor, tente novamente.');
                return redirect()->back();
            }


            if($information)
            {
                $link_pagamento = $information->getLink();
            }
            else
            {
               $link_pagamento = '0';
            }

            $atualizar_solicitacao = \App\Solicitacao::find($solicitacao->id);
            $atualizar_solicitacao->pagamento_link = $link_pagamento;
            $atualizar_solicitacao->save();

            //Controle do foreach para atribuir os paths das imagens
            $cf = 0;

            foreach ($request->mes_conta as $key => $value)
            {
                if($value != null)
                {
                    //Criar mês
                    $label = $key+1;
                    $mes = new \App\Mes;
                    $mes->descricao = $label;
                    $mes->kwh = $value;
                    $mes->base_calculo = $value;
                    $mes->solicitacao_id = $solicitacao->id;
                    $mes->imagem = $path_imagens[$cf];
                    $mes->save();
                    $cf++;
                }
            }
        }

        $log = new \App\Log;
        $log->user_id = auth()->user()->id;
        $log->mensagem = 'solicitação de conta premium';
        $log->url = url('/painel/administrador/solicitacao', $solicitacao->id);
        $log->save();

        $user->notifications()->attach(4);

        // Envio do email de atualização da solicitação para o administrador
        $mensagem = 'A solicitação de <strong>'.$user->name.'</strong> está disponível. Acesse o painel de controle para realizar a auditoria';
        $user->notify(new SolicitacaoStatus( 'Administrador', $emails, $mensagem ) );

        $request->session()->flash('alert-success', 'Sua solicitação de ativação de conta Premium foi enviada com sucesso e será auditada após o pagamento. Entre agora na aba do PagSeguro por meio do botão "pagar agora" e efetue o pagamento para que a operação seja completada com sucesso');
        $request->session()->flash('link_pagamento', $link_pagamento);
        return redirect()->action('UsersDashboardController@minhaConta');
    }

    public function pagar_solicitacao(Request $request, $id)
    {
        $solicitacao = \App\Solicitacao::find($id);
        $solicitacao->pagamento_status = 1;
        $solicitacao->save();

        $request->session()->flash('alert-success', 'Pagamento realizado com sucesso!');
        return redirect()->back();
    }

    public function ativar_conta_premium(Request $request)
    {
        $user = \App\User::where('id', auth()->user()->id)->first();

        $user->notifications()->detach();
        $user->notifications()->attach(5);

        $assinatura_old = $user->assinaturas()->where('ativa', 1)->first();
        $assinatura_old->ativa = 0;

        $assinatura_old->save();

        $usina = \App\Usina::where('ativa', 1)->where('fonte_energia', $request->tipo)->where('recs_disponiveis','>=',$request->quantidade_recs)->orderBy('recs_disponiveis', 'DESC')->first();

        $rec_comprados = $usina->rec_comprados()->get();

        $now = Carbon::now('America/Sao_Paulo');
        $validade = $now->addYear();

        // ação para consumir o REC de um lote específico

        foreach ($rec_comprados as $rec_comprado)
        {
            if($rec_comprado->saldo > 0)
            {
                // caso não haja restos
                if(!isset($resto))
                {
                    // define o saldo dos recs

                    $saldo = $rec_comprado->saldo;
                    $saldo -= $request->quantidade_recs;

                    // verifica se ainda existem Recs que precisam ser alocados
                    if($saldo < 0)
                    {
                        // cria variável resto
                        $resto = abs($saldo);

                        // define a quantidade alocada
                        $quantidade_alocada = $rec_comprado->saldo;

                        // atualiza o saldo no banco
                        $rec_comprado->saldo = 0;
                        $rec_comprado->save();

                        // aloca os recs
                        $rec_alocado = new \App\RecAlocado;
                        $rec_alocado->quantidade        = $quantidade_alocada;
                        $rec_alocado->usina_id          = $usina->id;
                        $rec_alocado->user_id           = $user->id;
                        $rec_alocado->rec_comprado_id   = $rec_comprado->id;
                        $rec_alocado->validade          = $validade;
                        $rec_alocado->save();
                    }
                    else
                    {
                        // atualiza o saldo no banco
                        $rec_comprado->saldo = $saldo;
                        $rec_comprado->save();

                        // define a quantidade alocada
                        $quantidade_alocada = $request->quantidade_recs;

                        // aloca os recs
                        $rec_alocado = new \App\RecAlocado;
                        $rec_alocado->quantidade        = $quantidade_alocada;
                        $rec_alocado->usina_id          = $usina->id;
                        $rec_alocado->user_id           = $user->id;
                        $rec_alocado->rec_comprado_id   = $rec_comprado->id;
                        $rec_alocado->validade          = $validade;
                        $rec_alocado->save();

                        // caso não exista resto, o loop é interrompido
                        // dd('break1');
                        break;
                    }
                }
                else
                {
                    // caso haja restos
                    // define o saldo dos recs

                    $saldo = $rec_comprado->saldo;

                    $saldo -= $resto;

                    // verifica se ainda existem Recs que precisam ser alocados
                    if($saldo < 0)
                    {
                        // atualiza variável resto
                        $resto = abs($saldo);

                        // define a quantidade alocada
                        $quantidade_alocada = $rec_comprado->saldo;

                        $rec_comprado->saldo = 0;
                        $rec_comprado->save();

                        // aloca os recs
                        $rec_alocado = new \App\RecAlocado;
                        $rec_alocado->quantidade        = $quantidade_alocada;
                        $rec_alocado->usina_id          = $usina->id;
                        $rec_alocado->user_id           = $user->id;
                        $rec_alocado->rec_comprado_id   = $rec_comprado->id;
                        $rec_alocado->validade          = $validade;
                        $rec_alocado->save();
                    }
                    else
                    {
                        // atualiza o saldo no banco
                        $rec_comprado->saldo = $saldo;
                        $rec_comprado->save();

                        // define a quantidade alocada
                        $quantidade_alocada = $resto;

                        // aloca os recs
                        $rec_alocado = new \App\RecAlocado;
                        $rec_alocado->quantidade        = $quantidade_alocada;
                        $rec_alocado->usina_id          = $usina->id;
                        $rec_alocado->user_id           = $user->id;
                        $rec_alocado->rec_comprado_id   = $rec_comprado->id;
                        $rec_alocado->validade          = $validade;
                        $rec_alocado->save();

                        // caso não exista resto, o loop é interrompido
                        // dd('break2');
                        break;
                    }
                }
            }
        }

        $recs_disponiveis = $rec_comprados->sum('saldo');

        $usina->recs_disponiveis = $recs_disponiveis;
        $usina->save();

        $assinatura = new \App\Assinatura;
        $assinatura->user_id            =  $user->id;
        $assinatura->usina_id           =  $usina->id;
        // to do -> modificar banco para que os recs alocados possuam a referência da assinatura
        $assinatura->rec_alocado_id     =  $rec_alocado->id;
        $assinatura->tipo               =  'premium';
        $assinatura->validade           =   $validade;
        $assinatura->save();

        $log = new \App\Log;
        $log->user_id = auth()->user()->id;
        $log->mensagem = 'conta premium - validade: ' . $validade->format('d/m/Y');
        $log->save();

        $request->session()->flash('alert-success', 'Sua assinatura foi efetivada com sucesso!');
        return redirect()->back();

    }

    public function revisar_solicitacao($id)
    {

        $solicitacao = \App\Solicitacao::where('id', $id)->with('user', 'user.userInfos', 'simulacao', 'meses')->first();
        $user = auth()->user();
        $notifications = $user->notifications()->get();

        return view('user-dashboard.revisar-solicitacao', compact('solicitacao', 'user', 'notifications'));
    }

    public function atualizar_solicitacao(Request $request)
    {
        $emails = ['contato@ziitbusiness.com.br', 'mikelopes@idealista.net.br'];
        // $emails = ['thimholanda@gmail.com'];

        $user = auth()->user();
        $user->notifications()->attach(4);

        if(!$request->meses_info)
        {
            // Somente atualiza a Solicitação
            $solicitacao = \App\Solicitacao::find($request->id_solicitacao);
            $solicitacao->aprovado = 0;     // --> Status de aguardando análise
            $solicitacao->atualizada = 1;   // --> Atualizada
            $solicitacao->mensagem = null;
            $solicitacao->save();

            // Envio do email de atualização da solicitação para o administrador
            $mensagem = 'A solicitação de <strong>'.$user->name.'</strong> foi atualizada e está disponível. Acesse o painel de controle para verificar os dados atualizados.';
            $user->notify(new SolicitacaoStatus( 'Administrador', $emails, $mensagem ) );

            $request->session()->flash('alert-success', 'Sua solicitação foi atualizada com sucesso. Você receberá o retorno em até 7 dias úteis.');
            return redirect()->action('UsersDashboardController@minhaConta');
        }

        if($request->tipo == 1)
        {

            // Ações Histórico
            $this->validate($request, \App\Solicitacao::historicoRulesRevisao($request), \App\Solicitacao::historicoMessagesRevisao($request));

            // Atualizar Solicitação
            $solicitacao = \App\Solicitacao::find($request->id_solicitacao);
            $solicitacao->aprovado = 0;     // --> Status de aguardando análise
            $solicitacao->atualizada = 1;   // --> Atualizada
            $solicitacao->mensagem = null;
            $solicitacao->save();

            // Atualizar meses
            $cl = 0;

            foreach ($request->meses_info['id'] as $id)
            {
                $mes_kwh = $request->mes_valor[$cl];

                $cl++;

               // Recupera o mês
                $mes = \App\Mes::find($id);
                $mes->kwh = $mes_kwh;
                $mes->aprovado = 0; // --> Status de aguardando análise
                $mes->atualizado = 1;
                $mes->save();
            }

            // Envio do email de atualização da solicitação para o administrador
            $mensagem = 'A solicitação de <strong>'.$user->name.'</strong> foi atualizada está disponível. Acesse o painel de controle para verificar os dados atualizados.';
            $user->notify(new SolicitacaoStatus( 'Administrador', $emails, $mensagem ) );

            $request->session()->flash('alert-success', 'Sua solicitação foi atualizada com sucesso. Você receberá o retorno em até 7 dias úteis.');
            return redirect()->action('UsersDashboardController@minhaConta');
        }

        else if($request->tipo == 2)
        {
            // Ações Contas
            $this->validate($request, \App\Solicitacao::contasRulesRevisao($request), \App\Solicitacao::contasMessagesRevisao($request));

            // Array para armazenar os endereços das imagens
            $path_imagens = [];

            // Armazenamento das imagens
            foreach($request->file() as $file)
            {
                $path_imagens[] = $file->store('/public/uploads');
            }

            // Atualizar Solicitação
            $solicitacao = \App\Solicitacao::find($request->id_solicitacao);
            $solicitacao->aprovado = 0; // --> Status de aguardando análise
            $solicitacao->atualizada = 1;   // --> Atualizada
            $solicitacao->mensagem = null;
            $solicitacao->save();

            // Atualizar meses
            $cl = 0;

            foreach ($request->meses_info['id'] as $id)
            {
                $image_path = $path_imagens[$cl];
                $mes_kwh = $request->mes_valor[$cl];

                $cl++;

               // Recupera o mês
                $mes = \App\Mes::find($id);
                $mes->kwh = $mes_kwh;
                $mes->imagem = $image_path;
                $mes->aprovado = 0; // --> Status de aguardando análise
                $mes->atualizado = 1;
                $mes->save();
            }

            // Envio do email de atualização da solicitação para o administrador
            $mensagem = 'A solicitação de <strong>'.$user->name.'</strong> foi atualizada está disponível. Acesse o painel de controle para verificar os dados atualizados.';
            $user->notify(new SolicitacaoStatus( 'Administrador', $emails, $mensagem ) );

            $request->session()->flash('alert-success', 'Sua solicitação foi atualizada com sucesso. Você receberá o retorno em até 7 dias úteis.');
            return redirect()->action('UsersDashboardController@minhaConta');

        }

    }

    public function adicionar_logotipo(Request $request)
    {
        $this->validate($request, \App\Logotipo::rules(), \App\Logotipo::messages());

        $logotipo = \App\Logotipo::where('user_id', auth()->user()->id)->first();

        if(!$logotipo)
        {
            $url_logotipo = $request->file('logotipo')->store('/public/uploads');

            $logotipo = new \App\Logotipo;
            $logotipo->user_id = auth()->user()->id;
            $logotipo->logotipo = $url_logotipo;
            $logotipo->save();

            $log = new \App\Log;
            $log->user_id = auth()->user()->id;
            $log->mensagem = 'envio de logotipo';
            $log->url = url('/painel/administrador/configuracoes/visualizar-logotipo', $logotipo->id);
            $log->save();

            $request->session()->flash('alert-success', 'O logotipo foi inserido com sucesso!');
            return redirect()->back();
        }

        else
        {
            $url_logotipo = $request->file('logotipo')->store('/public/uploads');
            $logotipo->logotipo = $url_logotipo;
            $logotipo->aprovado = 0;
            $logotipo->save();

            $log = new \App\Log;
            $log->user_id = auth()->user()->id;
            $log->mensagem = 'envio de logotipo';
            $log->url = url('/painel/administrador/configuracoes/visualizar-logotipo', $logotipo->id);
            $log->save();

            $request->session()->flash('alert-success', 'O logotipo foi atualizado com sucesso!');
            return redirect()->back();
        }
    }

}
