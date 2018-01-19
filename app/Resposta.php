<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    public static function rules()
    {
    	return [
    		'resposta'	=>	'required|min:3'
    	];
    }

    public static function messages()
    {
    	return [
    		'resposta.required'	=>	'Por favor, insira sua <strong>resposta</strong>',
    		'resposta.min'	=>	'Insira pelo menos <strong>3 caracteres</strong>',
    	];
    }

    public function contato()
    {
        return $this->belongsTo('\App\Contato');
    }
}
