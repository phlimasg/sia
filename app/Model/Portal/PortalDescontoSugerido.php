<?php

namespace App\Model\Portal;

use Illuminate\Database\Eloquent\Model;

class PortalDescontoSugerido extends Model
{
    protected $fillable = ['ra', 
        'percentual',
        'portal_isencao_id',
        'user_id',
    ];
}
