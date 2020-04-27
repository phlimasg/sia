<?php

namespace App\Model\Portal;

use Illuminate\Database\Eloquent\Model;

class PortalIsencao extends Model
{
    protected $fillable = ['cpf', 
        'apelacao',
        'user_token',        
        'motivo_id',
    ];
    public function documentos()
    {
        return $this->hasMany(PortalIsencaoDocumento::class,'portal_isencaos_id','id');
    }
}
