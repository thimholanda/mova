<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    public function usina()
    {
    	return $this->belongsTo('\App\Usina');
    }

    public function user()
    {
    	return $this->belongsTo('\App\User');
    }

    public function rec_alocado()
    {
    	return $this->belongsTo('\App\RecAlocado');
    }
}
