<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $usersPath = '/painel/usuario';
    protected $adminPath = '/painel/administrador';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('usuario'))
        {
            $log = new \App\Log;
            $log->user_id = $user->id;
            $log->mensagem = 'login';
            $log->save();

            $simulacao_count = $user->simulacoes()->count();
            $solicitacao_count = $user->solicitacoes()->count();

            if($simulacao_count > 0 && $solicitacao_count == 0)
            {
                return redirect()->action('UsersDashboardController@ativar_premium');
            }
            else
            {
                return redirect()->intended($this->usersPath);
            }
            
        }

        return redirect()->intended($this->adminPath);
    }
}
