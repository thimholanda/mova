<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userInfos()
    {
        return $this->hasOne('\App\UserInfos');
    }

    public function roles()
    {
        return $this->belongsToMany('\App\Role');
    }

    public function assinaturas()
    {
        return $this->hasMany('\App\Assinatura');
    }

    public function assinatura_ativa()
    {
        return $this->assinaturas()->where('ativa', 1);
    }

    public function hasAssinatura($assinatura)
    {
        $user_assinaturas = $this->assinaturas()->where('ativa', 1)->get();

        foreach ($user_assinaturas as $user_assinatura) 
        {
            if($assinatura == $user_assinatura->tipo)
            {
                return true;
            }
        }

        return false;
    }

    public function recs_alocados()
    {
        return $this->hasMany('\App\RecAlocado');
    }

    public function notifications()
    {
        return $this->belongsToMany('\App\Notification')->withPivot('id')->orderBy('notification_user.id', 'DESC');
    }

    public function hasRole($role)
    {
        $user_roles = $this->roles()->get();

        foreach ($user_roles as $user_role)
        {
            if($role == $user_role->description)
            {
                return true;
            }
        }       

        return false;
    }

    public function getUsers()
    {
        return $this->with('roles')->whereHas('roles', function($query){ 
            $query->where('roles.description', 'usuario');
        })->has('assinaturas')->get();
    }

    public function simulacoes()
    {
        return $this->hasMany('\App\Simulacao')->get();
    }

    public function solicitacoes()
    {
        return $this->hasMany('\App\Solicitacao')->where('ativa', 1)->get();
    }

    public function contatos()
    {
        return $this->hasMany('\App\Contato');
    }

    public static function rulesConta($request)
    {   
        $data = [];
        
        $user = \App\User::find(auth()->user()->id);

        if($user->email != $request->email)
        {
            $data['email'] = 'required|string|email|max:255|unique:users';
        }

        $data['nome_empresa'] = 'required|max:255';
        $data['nome_responsavel'] = 'required|max:255';

        return $data;
    }

    public static function messagesConta()
    {
        return [
            'email.required' => 'O <strong>email</strong> é obrigatório',
            'email.email' => 'Insira um <strong>email</strong> válido',
            'email.unique' => 'Este <strong>email</strong> já está sendo utilizado por outro usuário',
            'nome_empresa.required' => 'O <strong>nome da empresa</strong> é obrigatório',
            'nome_responsavel.required' => 'O <strong>nome do responsável</strong> é obrigatório',
        ];
    }

    public function logotipo(){
        return $this->hasOne('\App\Logotipo');
    }

    public static function rules_usuario()
    {
        return [

            'email'     =>  'required|string|email|max:255|unique:users',
            'nome'      =>  'required|max:255',
            'perfil'    =>  'required',

        ];        
    }

    public static function messages_usuario()
    {
        return [
            'email.required' => 'O <strong>email</strong> é obrigatório',
            'email.email' => 'Insira um <strong>email</strong> válido',
            'email.unique' => 'Este <strong>email</strong> já está sendo utilizado por outro usuário',
            'nome.required' => 'O <strong>nome</strong> é obrigatório',
            'perfil.required' => 'O <strong>perfil</strong> é obrigatório',
        ];
    }

}
