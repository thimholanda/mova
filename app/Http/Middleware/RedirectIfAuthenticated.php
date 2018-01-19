<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    protected $usersPath = '/painel/usuario';
    protected $adminPath = '/painel/administrador';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) 
        {
            $user = auth()->user();

            if ($user->hasRole('usuario'))
            {
                return redirect($this->usersPath);
            }

            return redirect($this->adminPath);
        }

        return $next($request);
    }
}
