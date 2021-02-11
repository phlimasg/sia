<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Model\Comunicados\comunicado;
use App\Policies\ComunicadoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy', 
        comunicado::class => ComunicadoPolicy::class,       
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();    
        
        Gate::define('portal','App\Policies\ComunicadoPolicy@portal');
        Gate::define('editor','App\Policies\ComunicadoPolicy@editor');
        Gate::define('sod','App\Policies\ComunicadoPolicy@sod');
        Gate::define('soe','App\Policies\ComunicadoPolicy@soe');
        Gate::define('ext','App\Policies\ComunicadoPolicy@ext');
        Gate::define('root','App\Policies\ComunicadoPolicy@root');

        Gate::define('desconto','App\Policies\ComunicadoPolicy@desconto');
        Gate::define('supervisao_adm','App\Policies\ComunicadoPolicy@supervisao_adm');

        Gate::define('tesouraria','App\Policies\ComunicadoPolicy@tesouraria');
        Gate::define('secretaria','App\Policies\ComunicadoPolicy@secretaria');
        Gate::define('central','App\Policies\ComunicadoPolicy@central');
        

        
        //$this->UserProfile();

        /*Gate::define('portal', function($user){
            foreach($user->profile as $i){
                if($i->name == 'portal'){
                    return $i->name == 'portal';
                }
            }
        });
        Gate::define('editor', function($user){
            foreach($user->profile as $i){
                if($i->name == 'editor'){
                    return $i->name == 'editor';
                }
            }
        });*/
        
    }
}
