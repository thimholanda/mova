<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usina extends Model
{
    protected $fillable = [
        'nome', 'inicio_operacao', 'fonte_energia', 'endereco', 'lat', 'lng', 'prioridade'
    ];

    public static function rules()
    {
    	return [
    		'nome'				=>	'required',
    		'inicio_operacao'	=>	'required|date',
    		'fonte_energia'		=>	'required',
    		'endereco'			=>	'required',
    		'lat'				=>	'required',
    		'lng'				=>	'required',
    	];
    }

    public static function messages()
    {
    	return [
    		'nome.required'	=>	'O campo <strong>nome da usina</strong> é obrigatório',
    		'inicio_operacao.required'	=>	'O campo <strong>quando começou a operar</strong> é obrigatório',
    		'fonte_energia.required'	=>	'O campo <strong>fonte de energia</strong> é obrigatório',
    		'endereco.required'	=>	'O campo <strong>endereço</strong> é obrigatório',
    		'lat.required'	=>	'A <strong>latitude</strong> é obrigatória (tente inserir o endereço novamente e aguarde o carregamento do mapa)',
    		'lng.required'	=>	'A <strong>longitude</strong> é obrigatória (tente inserir o endereço novamente e aguarde o carregamento do mapa)',
    	];
    }

    public function rec_comprados()
    {
    	return $this->hasMany('\App\RecComprado');
    }
}
