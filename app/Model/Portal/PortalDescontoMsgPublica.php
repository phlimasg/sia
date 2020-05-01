<?php

namespace App\Model\Portal;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PortalDescontoMsgPublica extends Model
{
    protected $fillable = ['msg_usuario', 
        'portal_isencao_id',
        'user_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}

