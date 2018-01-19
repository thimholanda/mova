<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    protected $usersPath = '/painel/usuario';
    protected $adminPath = '/painel/administrador';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if(!$user->ativo)
        {
            auth()->logout();
            return redirect('/');
        }

        if (!$user->hasRole($role))
        {

            foreach($user->roles()->get() as $role)
            {
                switch ($role->description) {
                    case 'usuario':                       

                        return redirect($this->usersPath);
                        break;
                    
                    case 'administrador':
                        return redirect($this->adminPath);
                        break;
                } 
            }

                       
        }

        return $next($request);

    }
}
