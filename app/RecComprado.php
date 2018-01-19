<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecComprado extends Model
{
    public static function rules()
    {
    	return [
    		'quantidade'		=>	'required',
    	];
    }

    public static function messages()
    {
    	return [
    		'quantidade.required'	=>	'O campo <strong>quantidade</strong> é obrigatório',
    	];
    }
}
