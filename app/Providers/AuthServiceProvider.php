<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        try
        {
            $roles = \App\Role::all();

            foreach ($roles as $role) 
            {
                if($role->description == 'free' || $role->description == 'premium' || $role->description == 'administrador' || $role->description == 'editor' || $role->description == 'consultor')
                {                   
                    Gate::define($role->description, function ($user) use ($role)
                    {                    
                        return $user->hasRole($role->description);
                    });
                }
            }
        }

        catch(\Exception $e)
        {
            return $e;
        }

        try
        {
            Gate::define('is-premium', function ($user)
            {                    
                return $user->hasAssinatura('premium');
            });
        }

        catch(\Exception $e)
        {
            return $e;
        }

        

        
    }
}
