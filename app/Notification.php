<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function users()
    {
    	return $this->belongsToMany('\App\User')->withPivot('id', 'read')->wherePivot('read', 0);;
    }
}
