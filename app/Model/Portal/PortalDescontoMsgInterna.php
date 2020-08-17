<?php

namespace App\Model\Portal;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PortalDescontoMsgInterna extends Model
{
    protected $fillable = ['msg_interna', 
        'portal_isencao_id',
        'user_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
