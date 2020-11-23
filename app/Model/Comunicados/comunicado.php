<?php

namespace App\Model\Comunicados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class comunicado extends Model
{
    use Notifiable;
    
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
