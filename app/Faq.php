<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	public $fillable = [
		'titulo','resposta', 'position'
	];

    public static function rules()
    {
    	return [
    		'titulo'	=>	'required',
    		'resposta'	=>	'required',
    	];
    }

    public static function messages()
    {
    	return [
    		'titulo.required'	=>	'Insira o <strong>título da pergunta</strong>.',
    		'resposta.required'	=>	'Insira a <strong>resposta da pergunta</strong>.',
    	];
    }
}
