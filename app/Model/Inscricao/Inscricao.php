<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'inscricaos';

    public function Getnet()
    {
        return $this->hasOne(getnet_return::class,'inscricaos_id','id');
    }
}
