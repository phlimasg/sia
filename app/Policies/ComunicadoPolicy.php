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
    public function sod(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'sod'){
                return $i->name === 'sod';
            }
        }
    }

    public function desconto(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'desconto'){
                return $i->name === 'desconto';
            }
        }
    }

    public function ext(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'ext'){
                return $i->name === 'ext';

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

    public function  supervisao_adm(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'supervisao_adm'){
                return $i->name === 'supervisao_adm';
            }
        }
    }


   

    public function tesouraria(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'tesouraria'){
                return $i->name === 'tesouraria';
            }
        }
    }
    public function central(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'central'){
                return $i->name === 'central';
            }
        }
    }
    public function secretaria(User $user)
    {
        foreach($user->profile as $i){
            if($i->name == 'secretaria'){
                return $i->name === 'secretaria';
            }
        }
    }
}
