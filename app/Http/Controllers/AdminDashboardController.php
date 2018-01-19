<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Notifications\SolicitacaoStatus;
use App\Mail\RespostaMail;

class AdminDashboardController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('role:administrador');
	}

    public function index()
    {	
    	$usuarios = new \App\User;
    	$count_usuarios = $usuarios->getUsers()->count();
        $rec_alocados = \App\RecAlocado::all();
        $mensagens = \App\Contato::with('user', 'resposta')->orderBy('created_at', 'DESC')->get();
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

        $solicitacoes = \App\Solicitacao::with('user', 'simulacao', 'boleto')->get();

    	return view('admin-dashboard.index', compact('count_usuarios', 'rec_alocados', 'mensagens', 'emissoes_evitadas', 'solicitacoes'));
    }

    public function clientes()
    {
        $users = \App\User::with('assinaturas', 'recs_alocados', 'assinaturas.usina', 'roles', 'userInfos')->whereHas('roles', function($query){
            $query->where('roles.description', 'usuario');
        })->orderBy('id', 'desc')->get();

        return view('admin-dashboard.clientes', compact('users'));
    }

    public function visualizar_cliente($id)
    {
        $cliente = \App\User::where('id', $id)->with('userInfos', 'assinatura_ativa', 'assinatura_ativa.rec_alocado', 'assinatura_ativa.usina', 'recs_alocados')->first();

        return view('admin-dashboard.visualizar-clientes', compact('cliente'));
    }

    public function usinas()
    {
        $usinas = \App\Usina::orderBy('id','desc')->paginate(15);

        return view('admin-dashboard.usinas', compact('usinas'));
    }

    public function cadastro_usinas()
    {
        return view('admin-dashboard.cadastro-usinas');
    }

    public function cadastro_usinas_action(Request $request)
    {   
        $this->validate($request, \App\Usina::rules(), \App\Usina::messages());

        switch ($request->fonte_energia) {

            case 'Eólica':
                $prioridade = 1;
                break;

            case 'Hídrica':
                $prioridade = 2;
                break;

            case 'Solar':
                $prioridade = 3;
                break;

            case 'Biomassa':
                $prioridade = 4;
                break;
        }

        $input = Input::all();
        $input['prioridade'] = $prioridade;        

        \App\Usina::create( $input );

        $request->session()->flash('alert-success', 'A usina foi adicionada com sucesso!');

        return redirect()->action('AdminDashboardController@usinas');
    }

    public function atualizar_usinas(Request $request, $id)
    {
        $this->validate($request, \App\Usina::rules(), \App\Usina::messages());

        switch ($request->fonte_energia) {

            case 'Eólica':
                $prioridade = 1;
                break;

            case 'Hídrica':
                $prioridade = 2;
                break;

            case 'Solar':
                $prioridade = 3;
                break;

            case 'Biomassa':
                $prioridade = 4;
                break;
        }

        $input = Input::all();
        $input['prioridade'] = $prioridade;    

        $usina = \App\Usina::find($id);
        $usina->fill($input);
        $usina->save();

        $request->session()->flash('alert-success', 'Os dados da usina foram atualizados com sucesso!');
        return redirect()->back();
    }

    public function inativar_usinas(Request $request, $id)
    {
        $usina = \App\Usina::find($id);
        $usina->ativa = 0;
        $usina->save();

        $request->session()->flash('alert-success', 'A usina foi desativada com sucesso!');
        return redirect()->back();
    }

    public function ativar_usinas(Request $request, $id)
    {
        $usina = \App\Usina::find($id);
        $usina->ativa = 1;
        $usina->save();

        $request->session()->flash('alert-success', 'A usina foi ativada com sucesso!');
        return redirect()->back();
    }

    public function cadastro_recs($id)
    {      
        $usina = \App\Usina::find($id);
        return view('admin-dashboard.cadastro-recs', compact('usina'));
    }

    public function cadastro_recs_action(Request $request, $id)
    {
        $this->validate($request, \App\RecComprado::rules(), \App\RecComprado::messages());

        $rec_comprado = new \App\RecComprado;
        $rec_comprado->quantidade = $request->quantidade;
        $rec_comprado->saldo = $request->quantidade;
        $rec_comprado->usina_id = $id;
        $rec_comprado->save();

        $usina = \App\Usina::find($id);
        $recs_disponiveis = $usina->recs_disponiveis;
        $usina->recs_disponiveis += $request->quantidade;
        $usina->save();

        $request->session()->flash('alert-success', 'Os RECs foram adicionados com sucesso!');
        return redirect()->action('AdminDashboardController@visualizar_usinas', ['id' => $id]);
    }

    public function excluir_recs_action(Request $request, $id_rec, $id_usina)
    {
        $rec_comprado = \App\RecComprado::find($id_rec);
        $usina = \App\Usina::find($id_usina);
        $recs_disponiveis = $usina->recs_disponiveis;
        $recs_disponiveis = $recs_disponiveis - $rec_comprado->quantidade;

        if($recs_disponiveis < 0)
        {
            $request->session()->flash('alert-warning', 'Não há saldo suficiente para excluir este pacote de RECs.');
            return redirect()->back();
        }

        $usina->recs_disponiveis = $recs_disponiveis;
        $usina->save();
        $rec_comprado->delete();

        $request->session()->flash('alert-success', 'O pacote de RECs foi excluído com sucesso!');
        return redirect()->back();
    }

    public function visualizar_usinas($id)
    {   
        $usina = \App\Usina::where('id', $id)->with('rec_comprados')->first();

        $rec_alocados = \App\RecAlocado::where('usina_id', $id)->with('user')->get();

        return view('admin-dashboard.visualizar-usinas', compact('usina', 'rec_alocados'));
    }

    public function excluir_mensagem_action(Request $request, $id)
    {
        \App\Contato::destroy($id);
        $request->session()->flash('alert-success', 'A mensagem foi excluída com sucesso!');
        return redirect()->back();
    }

    public function configuracoes()
    {
        $logotipos = \App\Logotipo::with('user')->get();

        $users = \App\User::with('roles')->whereHas('roles', function($query){
            $query->where('roles.description', 'editor')->orWhere('roles.description', 'consultor');
        })->orderBy('id', 'desc')->get();

        return view('admin-dashboard.configuracoes', compact('logotipos', 'users'));
    }

    public function faq()
    {
        $perguntas = \App\Faq::orderBy('position', 'ASC')->get();
        return view('admin-dashboard.faq', compact('perguntas'));
    }

    public function cadastro_faq()
    {
        return view('admin-dashboard.cadastro-faq');
    }

    public function cadastro_faq_action(Request $request)
    {   
        $this->validate($request, \App\Faq::rules(), \App\Faq::messages());

        $data = Input::all();
        $data['position'] = 1;

        \App\Faq::increment('position');

        $faq = \App\Faq::create($data);

        $request->session()->flash('alert-success', 'A pergunta foi inserida com sucesso!');
        return redirect()->action('AdminDashboardController@faq');
    }

    public function atualizar_faq($id)
    {
        $pergunta = \App\Faq::find($id);
        return view('admin-dashboard.atualizar-faq', compact('pergunta'));
    }

    public function atualizar_faq_action(Request $request, $id)
    {
        $this->validate($request, \App\Faq::rules(), \App\Faq::messages());
        $pergunta = \App\Faq::find($id);
        $pergunta->fill(Input::all());
        $pergunta->save();
        $request->session()->flash('alert-success', 'A pergunta foi atualizada com sucesso!');
        return redirect()->action('AdminDashboardController@faq');
    }

    public function excluir_faq_action(Request $request, $id)
    {
        \App\Faq::destroy($id);
        $request->session()->flash('alert-success', 'A pergunta foi excluída com sucesso!');
        return redirect()->back();
    }

    public function fator_medio_anual_action(Request $request)
    {   
        $this->validate($request, ['fator_medio_anual' => 'required'], ['fator_medio_anual.required' => 'Insira o valor do <strong>fator médio anual</strong>']);

        $fator = \App\Configuracoes::all();
        
        if($fator->count() == 0)
        {
            // create
            $config = new \App\Configuracoes;
            $config->fator_medio_anual = $request->fator_medio_anual;
            $config->save();
            $request->session()->flash('alert-success', 'O valor foi inserido com sucesso!');
            return redirect()->back();
        }
        else
        {
            $config = \App\Configuracoes::find(1);
            $config->fator_medio_anual = $request->fator_medio_anual;
            $config->save();
            $request->session()->flash('alert-success', 'O valor foi atualizado com sucesso!');
            return redirect()->back();
        }
    }

    public function visualizar_solicitacao(Request $request, $id)
    {
        $solicitacao = \App\Solicitacao::where('id', $id)->with('user', 'user.userInfos', 'simulacao', 'meses')->first();

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

        // geração do boleto extra

        if($resultado > 0)
        {
            // verifica se já existe algum boleto extra gerado

            $boleto_existente = \App\BoletoExtra::where('solicitacao_id', $id)->first();

            if(!$boleto_existente)
            {
                // gera boleto extra
                $boleto = new \App\BoletoExtra();
                $boleto->solicitacao_id = $id;
                $boleto->valor = $resultado;
                $boleto->save();
            }
            else
            {
                // considera o boleto existente
                $boleto = $boleto_existente;
            }            
        }

        return view('admin-dashboard.visualizar-solicitacao', compact('solicitacao', 'media_kwh', 'preco', 'resultado', 'boleto'));
    }

    public function atualizar_boleto(Request $request)
    {
        // confirma pagamento do boleto

        $boleto = \App\BoletoExtra::find($request->boleto_id);
        $boleto->status_pagamento = 1;
        $boleto->save();
        return response()->json(['request' => '1']);
    }

    public function aprovar_solicitacao(Request $request, $id)
    {

        $solicitacao = \App\Solicitacao::find($id);
        $meses = $solicitacao->meses()->get();
        $tem_divergencia = false;

        foreach ($meses as $mes) 
        {
            if($mes->aprovado == 0)
            {
                $request->session()->flash('alert-warning', 'Esta auditoria não pode ser finalizada até que todos os meses sejam verificados.');
                return redirect()->back();
            }
            else
            {
                if($mes->aprovado == 2)
                {
                    $tem_divergencia = true;
                    break;
                }
            }
        }

        // 0 = aguardando aprovação
        // 1 = aprovado
        // 2 = reprovado
        // 3 = aprovado com divergências

        if($tem_divergencia)
        {
            $status = 3;
            $mensagem = 'Sua solicitação foi <strong>aprovada com divergências</strong>. Acesse seu painel para saber mais';

            $log = new \App\Log;
            $log->user_id = $solicitacao->user_id;
            $log->mensagem = 'solicitação aprovada com divergências';
            $log->url = url('/painel/administrador/solicitacao', $id);
            $log->save();
        }
        else
        {
            $status = 1;
            $mensagem = 'Sua solicitação foi <strong>aprovada</strong>. Acesse seu painel para saber mais.';

            $log = new \App\Log;
            $log->user_id = $solicitacao->user_id;
            $log->mensagem = 'solicitação aprovada';
            $log->url = url('/painel/administrador/solicitacao', $id);
            $log->save();
        }

        $solicitacao->aprovado = $status;
        $solicitacao->atualizada = 0;
        $solicitacao->mensagem = $request->mensagem;
        $solicitacao->save();

        $user = \App\User::find($solicitacao->user_id);
        $user->notifications()->attach(3);

        // Envio do email de atualização da solicitação para o usuário
        $user->notify(new SolicitacaoStatus( ucwords ( mb_strtolower($user->name, 'UTF-8') ), $user->email, $mensagem ) );

        $request->session()->flash('alert-success', 'A solicitação foi aprovada com sucesso!');
        return redirect()->back();
    }

    public function reprovar_solicitacao(Request $request, $id)
    {
        $solicitacao = \App\Solicitacao::find($id);
        $solicitacao->aprovado = 2;
        $solicitacao->atualizada = 0;
        $solicitacao->mensagem = $request->mensagem;
        $solicitacao->save();

        $user = \App\User::find($solicitacao->user_id);
        $user->notifications()->attach(2);

        // Envio do email de atualização da solicitação para o usuário
        $mensagem = 'Sua solicitação foi <strong>reprovada</strong>. Acesse seu painel para revisá-la.';
        $user->notify(new SolicitacaoStatus( ucwords ( mb_strtolower($user->name, 'UTF-8') ), $user->email, $mensagem ) );

        $request->session()->flash('alert-success', 'A auditoria foi finalizada com sucesso!');
        return redirect()->back();
    }

    public function aprovar_mes(Request $request)
    {
        $mes = \App\Mes::find($request->mes_id);
        $mes->aprovado = 1;
        $mes->base_calculo = $mes->kwh;
        $mes->valor_retificado = null;
        $mes->mensagem = null;
        $mes->atualizado = 0;
        $mes->save();

        return response()->json(['request' => $mes->aprovado]);
    }

    public function reprovar_mes(Request $request)
    {
        $mes = \App\Mes::find($request->mes_id);
        $mes->aprovado = 2;
        $mes->mensagem = $request->mensagem;
        $mes->valor_retificado = (float)$request->valor_retificado;
        $mes->base_calculo = (float)$request->valor_retificado;
        $mes->atualizado = 0;
        $mes->save();

        return response()->json(['request' => $mes->aprovado]);
    }

    public function atualizar_posicao(Request $request)
    {

        if( Input::has('faq') )
        {
            $i = 0;

            foreach (Input::get('faq') as $id) {
                
                $i++;
                $pergunta = \App\Faq::find($id);
                $pergunta->position = $i;
                $pergunta->save();
            }

            return response()->json(['msg' => 'success']);
        }

        return response()->json(['msg' => 'error']);

    }

    public function desativar_cliente(Request $request)
    {
        $cliente = \App\User::find($request->user_id);
        $cliente->ativo = 0;
        $cliente->save();

        $request->session()->flash('alert-success', 'O usuário foi desativado com sucesso!');
        return redirect()->back();
    }

    public function ativar_cliente(Request $request)
    {
        $cliente = \App\User::find($request->user_id);
        $cliente->ativo = 1;
        $cliente->save();

        $request->session()->flash('alert-success', 'O usuário foi ativado com sucesso!');
        return redirect()->back();
    }

    public function mensagens()
    {
        $mensagens = \App\Contato::with('user', 'resposta')->orderBy('created_at', 'DESC')->get();
        return view('admin-dashboard.mensagens', compact('mensagens'));
    }

    public function visualizar_mensagens($id)
    {
        $mensagem = \App\Contato::where('id', $id)->with('user', 'user.userInfos', 'resposta')->first();
        return view('admin-dashboard.visualizar-mensagens', compact('mensagem'));
    }

    public function responder_cliente(Request $request)
    {
        $user = \App\User::find($request->user_id);
        $contato = \App\Contato::find($request->contato_id);

        $this->validate($request, \App\Resposta::rules(), \App\Resposta::messages());

        $resposta = new \App\Resposta;
        $resposta->mensagem = $request->resposta;
        $resposta->contato_id = (int)$request->contato_id;
        $resposta->save();

        $user->notifications()->attach(6);

        \Mail::to($user)->send( new RespostaMail($user->name, $contato->mensagem, $contato->assunto, $request->resposta) );

        $log = new \App\Log;
        $log->user_id = $contato->user_id;
        $log->mensagem = 'envio de resposta';
        $log->url = url('/painel/administrador/mensagens/visualizar', $contato->id);
        $log->save();

        $request->session()->flash('alert-success', 'Sua resposta foi enviada com sucesso!');
        return redirect()->back();
    }

    public function visualizar_logs($id)
    {
        $cliente = \App\User::find($id);
        $logs = \App\Log::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('admin-dashboard.visualizar-logs', compact('cliente', 'logs'));
    }

    public function visualizar_logotipo($id)
    {
        $logotipo = \App\Logotipo::with('user')->where('id', $id)->first();
        return view('admin-dashboard.visualizar-logotipo', compact('logotipo'));
    }

    public function atualizar_logotipo(Request $request)
    {
        $logotipo = \App\Logotipo::where('id', $request->logotipo_id)->first();
        $logotipo->aprovado = $request->status;
        $logotipo->save();

        $request->session()->flash('alert-success', 'O status do logotipo foi atualizado com sucesso!');
        return redirect()->action('AdminDashboardController@configuracoes');
    }

    public function criar_usuario()
    {
        return view('admin-dashboard.criar-usuario');
    }

    public function criar_usuario_action(Request $request)
    {
        $this->validate($request, \App\User::rules_usuario(), \App\User::messages_usuario());

        $pass = str_random(8);
        $pass_hash = \Hash::make($pass); 

        // Criação do usuário em caso de sucesso
        $user = \App\User::create([
            'name' => ucwords ( mb_strtolower($request->nome, 'UTF-8') ),
            'email' => $request->email,
            'password' => $pass_hash,
        ]);

        $user->roles()->attach($request->perfil);

        \Mail::to($user)->send( new \App\Mail\NovoUsuarioMail($user, $pass) );

        $request->session()->flash('alert-success', 'O usuário foi criado com sucesso!');
        return redirect()->action('AdminDashboardController@configuracoes');
    }

    public function visualizar_usuario($id)
    {
        $user = \App\User::where('id', $id)->with('roles')->first();
        return view('admin-dashboard.visualizar-usuarios', compact('user'));
    }

    public function excluir_usuario_action(Request $request)
    {
        \App\User::destroy($request->id);
        $request->session()->flash('alert-success', 'O usuário foi excluído com sucesso!');
        return redirect()->action('AdminDashboardController@configuracoes');
    }
}
