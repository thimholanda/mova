<?php

namespace App\Http\Controllers;

use App\User;
use App\UserInfos;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use App\Notifications\DefinePassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{    
    use ResetsPasswords;
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        // no middleware
    }  


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // rotina para importação dos preços
        // $excel = \Excel::load('file.xls', function($reader){
        //     $reader->each(function($row){
        //         $arr = $row->toArray();

        //         $preco = new \App\Preco;
        //         $preco->quantidade_recs = (int)$arr[3];
        //         $preco->preco = $arr['99.90000000000001'];
        //         $preco->save();
        //     });
        // })->get();       
        
        $current_year = date('Y');
        $now = Carbon::now('America/Sao_Paulo');
        $initialDate = Carbon::createFromDate($current_year, 1, 1, 'America/Sao_Paulo');
        $seconds = (float)$now->diffInSeconds($initialDate);
        $pattern = (float)0.010416666666667;
        $emissoes_evitadas = $seconds * $pattern;
        $emissoes_evitadas = $emissoes_evitadas;
        $emissoes_evitadas = number_format($emissoes_evitadas);

        $perguntas = \App\Faq::orderBy('position', 'ASC')->get();
        $usinas = \App\Usina::where('ativa', 1)->get();

        $eolica = $usinas->filter(function($value, $key){
            return $value->fonte_energia == 'Eólica';
        })->toJson();

        // $eolica = $eolica->toJson();

        $hidrica = $usinas->filter(function($value, $key){
            return $value->fonte_energia == 'Hídrica';
        })->toJson();

        $solar = $usinas->filter(function($value, $key){
            return $value->fonte_energia == 'Solar';
        })->toJson();

        $biomassa = $usinas->filter(function($value, $key){
            return $value->fonte_energia == 'Biomassa';
        })->toJson();

        $rec_alocados = \App\RecAlocado::all();
        $config = \App\Configuracoes::find(1);

        if($rec_alocados)
        {
            $total_kwh = number_format( $rec_alocados->sum('quantidade')*1000, 0, ',', '.' );
        }

        else
        {
            $total_kwh = '';
        }

        $logotipos = \App\Logotipo::with('user')->where('aprovado', 1)->get();

        return view('home', compact('perguntas', 'eolica', 'hidrica', 'solar', 'biomassa', 'emissoes_evitadas', 'total_kwh', 'logotipos'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'nome_empresa' => 'required|max:255',
            'site_empresa' => 'required|string|max:255|url|unique:user_infos',
            'nome_responsavel' => 'required|max:255',
            'aceite' => 'required',
        ], $this->messages());
    }

    protected function create(Request $data)
    {
        // validação do formulário da home
        $validator = $this->validator($data->all());

        // regra em caso de falha
        if ($validator->fails())
        {   
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()

            ), 400);
        }

        // Criação do usuário em caso de sucesso
        $user = User::create([
            'name' => ucwords ( mb_strtolower($data['nome_empresa'], 'UTF-8') ),
            'email' => $data['email'],
            'password' => Hash::make(str_random(8)),
        ]);

        // Inserção dos dados adicionais
        $user_infos = new UserInfos();
        $user_infos->site_empresa = mb_strtolower($data['site_empresa'], 'UTF-8');
        $user_infos->nome_empresa = ucwords ( mb_strtolower($data['nome_empresa'], 'UTF-8') );
        $user_infos->nome_responsavel = ucwords ( mb_strtolower($data['nome_responsavel'], 'UTF-8') );
        $user_infos->user_id = $user->id;

        $user_infos->save();

        $user->roles()->attach(3);
        $user->notifications()->attach(1);

        // verfica se possue dados premium

        if(isset($data->watt_hora) && isset($data->investimento))
        {
            // insere simulação
            $recs = ceil($data->watt_hora * 12 / 1000);

            if($recs < 3)
            {
                $recs = 3;
            }

            $preco = \App\Preco::where('quantidade_recs', $recs)->first();

            $simulacao = new \App\Simulacao;
            $simulacao->kwh = $data->watt_hora;
            $simulacao->preco = $preco->preco;
            $simulacao->recs = (int)$recs;
            $simulacao->user_id = $user->id;
            $simulacao->save();
        }

        // criação do token para definição de senha
        $token = $this->broker()->createToken($user);

        // envio do email de definição de senha
        $user->notify(new DefinePassword( ucwords ( mb_strtolower($data['nome_responsavel'], 'UTF-8')), $user->email, $token) );

        // retorno em caso de sucesso
        return response()->json(array('success' => true), 200);
    }

    public function broker()
    {
        return Password::broker();
    }

    public function criarSenha($token, $email)
    {
        // retono da view e passagem de parâmetros
        return view('app.define-password', ['token'=>$token, 'email'=>$email]);
    }

    public function reset(Request $request)
    {   

        // validação do formulário de definição de senha
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // recuperação do usuário
        $user = User::where('email', $request->email)->first();

        // lógica para criação de assinatura e alocação de RECs
        $usinas = \App\Usina::where('ativa', 1)->orderBy('prioridade', 'ASC')->orderBy('recs_disponiveis', 'DESC')->get();

        foreach ($usinas as $usina) {
            if($usina->recs_disponiveis >= 1)
            {
                $usina_id = $usina->id;
                break;
            }            
        }

        if(!isset($usina_id))
        {
            $request->session()->flash('alert-danger', 'Desculpe, não foi possível efetivar seu cadastro, pois, não existem RECs disponíveis no momento. Por favor, entre em contato pelo e-mail contato@movaenergia.com.br para mais informações.');
            return redirect()->back();
        }


        //ação para definição de senha
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        //retorno da ação de definição de senha e direcionamento do usuário
        if($response == Password::PASSWORD_RESET)
        {                   

            // $user->id
            // $usina_id

            $usina = \App\Usina::find($usina_id);

            $rec_comprados = $usina->rec_comprados()->get();

            $recs_disponiveis = $rec_comprados->sum('saldo');

            // ação para consumir o REC de um lote específico

            foreach ($rec_comprados as $rec_comprado) 
            {
                if($rec_comprado->saldo > 0)
                {
                    $rec_comprado_id = $rec_comprado->id;
                    break;
                }
            }

            $rec_comprado_atualizado = \App\RecComprado::find($rec_comprado_id);

            $rec_comprado_atualizado->saldo = $rec_comprado_atualizado->saldo - 1;

            $rec_comprado_atualizado->save();

            $recs_disponiveis -= 1;

            $usina->recs_disponiveis = $recs_disponiveis;

            $usina->save();

            $now = Carbon::now('America/Sao_Paulo');

            // definição da validade

            $validade = $now->addMonth(3);

            $rec_alocado = new \App\RecAlocado;
            $rec_alocado->quantidade        = 1;
            $rec_alocado->usina_id          = $usina_id;
            $rec_alocado->user_id           = $user->id;
            $rec_alocado->rec_comprado_id   = $rec_comprado_id;
            $rec_alocado->validade          = $validade;

            $rec_alocado->save();

            $assinatura = new \App\Assinatura;
            $assinatura->user_id            =  $user->id;
            $assinatura->usina_id           =  $usina_id;
            $assinatura->rec_alocado_id     =  $rec_alocado->id;
            $assinatura->tipo               =  'gratuita';
            $assinatura->validade           =   $validade;
            $assinatura->save();

            $simulacao_count = $user->simulacoes()->count();
            $solicitacao_count = $user->solicitacoes()->count();

            if($simulacao_count > 0 && $solicitacao_count == 0)
            {
                return redirect()->action('UsersDashboardController@ativar_premium');
            }
            else
            {
                return redirect('painel/usuario'); // redirect em caso de sucesso
            }
        }
        else
        {
            return Redirect::route('home');
        }
    }

    public function messages()
    {
        return [
            'email.required'                => 'O campo "e-mail" é obrigatório',
            'email.email'                   => 'Por favor, insira um e-mail válido',
            'email.unique'                  => 'O e-mail informado já está sendo utilizado por outro usuário',
            'site_empresa.required'         => 'O campo "site da empresa" é obrigatório',
            'site_empresa.max'              => 'O campo "site da empresa" deve ter no máximo 255 caracteres',
            'site_empresa.unique'           => 'O site informado já está sendo utilizado por outro usuário',
            'site_empresa.url'           => 'Insira um endereço de site válido. É obrigatório conter o prefixo http:// ou https://',
            'nome_empresa.required'         => 'O campo "nome da empresa" é obrigatório',
            'nome_empresa.max'              => 'O campo "nome da empresa" deve ter no máximo 255 caracteres',
            'nome_responsavel.required'     => 'O campo "nome do responsável" é obrigatório',
            'nome_responsavel.max'          => 'O campo "nome do responsável" deve ter no máximo 255 caracteres',
            'aceite.required'               => 'Para efetuar o cadastro você deve aceitar os "termos de uso"',
        ];
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function widget()
    {   
        $assinatura = \App\Assinatura::where('id', Input::get('account'))->where('ativa', 1)->with('usina', 'user', 'user.userInfos')->first();

        if(!$assinatura)
        {
            $html = "<p class='zb-assinatura-warning' style='font-size: 15px; color: gray; width=200px; font-family: helvetica, arial, sans-serif'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Esta assinatura expirou.</p>";

            return response()->json(['html' => $html])->setCallback(Input::get('jsonp'));
        }

        $validade = \App\Helpers\Helper::dateTimeCreate($assinatura->validade);
        $validade_formated = \App\Helpers\Helper::dateTimeCreate($assinatura->validade)->format('d/m/Y');
        $now = Carbon::now('America/Sao_Paulo');

        if($validade >= $now)
        {
            $is_valid = true;
        }
        else
        {
            $is_valid = false;
        }

        if(!$is_valid)
        {
            $html = "<p class='zb-assinatura-warning' style='font-size: 15px; color: gray; width=200px; font-family: helvetica, arial, sans-serif'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Esta assinatura expirou.</p>";

            return response()->json(['html' => $html])->setCallback(Input::get('jsonp'));
        }

        // $fonte_energia = $assinatura->usina->fonte_energia;
        $fonte_energia = str_slug($assinatura->usina->fonte_energia);
        $site_empresa = parse_url($assinatura->user->userInfos->site_empresa);
        $origin = parse_url(Input::get('origin'));      

        $site_empresa = preg_replace( '/^www./', '', $site_empresa['host'] );
        $origin = preg_replace( '/^www./', '', $origin['host'] );

        if($site_empresa != $origin)
        {
            $html = "<p class='zb-assinatura-warning' style='font-size: 15px; color: gray; width=200px; font-family: helvetica, arial, sans-serif'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Esta assinatura não é compatível com  este site.</p>";
        }

        else
        {
            $bg = asset('img') . "/assinaturas/{$assinatura->tipo}/{$fonte_energia}.gif";

            $html = "<a href='http://ziitbusiness.com.br' title='Ziit Business' target='_blank'><div class='zb-assinatura-in' style='width:350px; height:141px; background: url({$bg}) no-repeat center; background-size: 100%; position: relative; display: block;'><span style='display:block; position: absolute; bottom: 5px; right: 30px; color: white; font-size: 10px; font-weight: 700; font-family: helvetica, arial, sans-serif;'>VAL: {$validade->format('d/m/Y')}</span></div></a>"; 
        }        

        return response()->json(['html' => $html])->setCallback(Input::get('jsonp')); 
    }

    public function simule($quantidade)
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

        return response()->json(['preco' => (float)$preco->preco ]);
    }
}
