<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logotipo extends Model
{
    public static function rules()
    {
    	return[
    		'logotipo' => 'required|image|max:1000',
    	];
    }

    public static function messages()
    {
    	return[
    		'logotipo.required'    =>  'Selecione o logotipo',
            'logotipo.image'       =>  'Os formatos de imagem aceitos são <strong>jpeg, png, bmp e gif</strong>',
            'logotipo.max'        =>  'O arquivo do logotipo deve ter no máximo <strong>1 MB</strong>',
    	];
    }

    public function user(){
    	return $this->belongsTo('\App\User');
    }
}
