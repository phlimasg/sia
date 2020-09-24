<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'documentos';
}
