<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
	protected $fillable = [
	    'assunto', 'mensagem', 'user_id'
	];

    public static function rules()
    {
    	return [
    		'assunto'	=>	'required',
    		'mensagem'	=>	'required'
    	];
    }

    public static function messages()
    {
    	return [
    		'assunto.required'	=> 'Por favor, selecione um <strong>assunto</strong>',
    		'mensagem.required'	=>	'Por favor, escreva uma <strong>mensagem</strong>'
    	];
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function resposta()
    {
        return $this->hasOne('\App\Resposta');
    }
}
