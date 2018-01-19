<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    public function simulacao()
    {
    	return $this->belongsTo('\App\Simulacao');
    }

    public function boleto()
    {
        return $this->hasOne('\App\BoletoExtra', 'solicitacao_id');
    }

    public function user()
    {
    	return $this->belongsTo('\App\User');
    }

    public function meses()
    {
    	return $this->hasMany('\App\Mes');
    }

    public static function historicoRules($request)
    {
        $rules = [
            'conta' => 'required|image|max:1000',
        ];

        $y = 1;

        foreach($request->mes as $key => $val)
        {
            if($y <= 9)
            {
                $rules['mes.'.$key] = 'required';
            }
            else
            {
                break;
            }

            $y++;
        }

        return $rules;
    }

    public static function contasRules($request)
    {
        $rules = [];

        for($i = 1; $i <= 9; $i++)
        {
            $rules['imagem'.$i] = 'required|image|max:1000';
        }

        $y = 1;

        foreach($request->mes_conta as $key => $val)
        {
            if($y <= 9)
            {

                $rules['mes_conta.'.$key] = 'required';
            }
            else
            {
                break;
            }

            $y++;
        }

        return $rules;
    }

    public static function historicoMessages($request)
    {
        $messages = [ 
            'conta.required'    =>  'O campo <strong>conta</strong> é obrigatório',
            'conta.image'       =>  'Os formatos de imagem aceitos são <strong>jpeg, png, bmp e gif</strong>',
            'conta.max'        =>  'O arquivo da conta deve ter no máximo <strong>1 MB</strong>',
        ];

        $y = 1;

        foreach($request->mes as $key => $val)
        {
            if($y <= 9)
            {
                $messages['mes.'.$key.'.required'] = 'O mês <strong>' . ($key+1) . ' </strong> é obrigatório';
            }
            else
            {
                break;
            }

            $y++;
        }

        return $messages;
    }

    public static function contasMessages($request)
    {   
        $messages = [];

        for($i = 1; $i <= 9; $i++)
        {
            $messages['imagem'.$i.'.required'] = 'O campo <strong>Imagem '.$i.' </strong> é obrigatório';
            $messages['imagem'.$i.'.image'] = 'Os formatos de imagem aceitos são <strong>jpeg, png, bmp e gif</strong>';
            $messages['imagem'.$i.'.max'] = 'O arquivo da conta deve ter no máximo <strong>1 MB</strong>';
        }

        $y = 1;

        foreach($request->mes_conta as $key => $val)
        {
            if($y <= 9)
            {
                $messages['mes_conta.'.$key.'.required'] = 'O mês <strong>' . ($key+1) . ' </strong> é obrigatório';
            }
            else
            {
                break;
            }

            $y++;
           
        }

        return $messages;
    }

    public static function contasRulesRevisao($request)
    {
        $rules = [];

         foreach ($request->meses_info['desc'] as $descricao) 
         {
             $rules['imagem_'.$descricao] = 'required';
         }

        foreach($request->mes_valor as $key => $val)
        {
           $rules['mes_valor.'.$key] = 'required';
        }

        return $rules;
    }

    public static function contasMessagesRevisao($request)
    {   
        $messages = [];

        foreach ($request->meses_info['desc'] as $descricao) 
        {
            $messages['imagem_'.$descricao.'.required'] = 'O campo <strong>Imagem '.$descricao.' </strong> é obrigatório';
            $messages['imagem_'.$descricao.'.image'] = 'Os formatos de imagem aceitos são <strong>jpeg, png, bmp e gif</strong>';
            $messages['imagem_'.$descricao.'.max'] = 'O arquivo da conta deve ter no máximo <strong>1 MB</strong>';
        }

        foreach($request->mes_valor as $key => $val)
        {
           $messages['mes_valor.'.$key.'.required'] = 'O mês <strong>' . $request->meses_info['desc'][$key] . ' </strong> é obrigatório';
        }

        return $messages;
    }

    public static function historicoRulesRevisao($request)
    {
        $rules = [];

        foreach($request->mes_valor as $key => $val)
        {
           $rules['mes_valor.'.$key] = 'required';
        }

        return $rules;
    }

    public static function historicoMessagesRevisao($request)
    {   
        $messages = [];

        foreach($request->mes_valor as $key => $val)
        {
           $messages['mes_valor.'.$key.'.required'] = 'O mês <strong>' . $request->meses_info['desc'][$key] . ' </strong> é obrigatório';
        }

        return $messages;
    }
}
