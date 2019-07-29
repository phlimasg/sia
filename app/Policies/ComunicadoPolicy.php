<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class ComunicadoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function portal(User $user){
        //Gate::define('portal', function($user){
           //dd($user->profile);
            foreach($user->profile as $i){
                if($i->name == 'portal'){
                    return $i->name === 'portal';
                }
            }
        //});
    }
    public function editor(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'editor'){
                return $i->name === 'editor';
            }
        }
    }
    public function root(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'root'){
                return $i->name === 'root';
            }
        }
    }
}
