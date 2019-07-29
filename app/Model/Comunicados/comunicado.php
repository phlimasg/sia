<?php

namespace App\Model\Comunicados;

use Illuminate\Database\Eloquent\Model;

class comunicado extends Model
{
    protected $fillable = ['titulo', 
    'descricao',
    'user_id',
];
    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}
