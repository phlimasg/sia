<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            
            if(Gate::check('portal', Auth::user())){
                /*$event->menu->add('DASHBOARD');
                $event->menu->add([
                'text'        => 'Dashboard',
                'url'         => route('communicated.index'),
                'icon'        => 'home',
                'can' => 'portal'
                ]);*/
                $event->menu->add('PAINEL DO RESPONSÁVEL');
                $event->menu->add([
                'text'        => 'Comunicados',
                'url'         => route('communicated.index'),
                'icon'        => 'bullhorn',
                'can' => 'portal'
                ],
                [
                    'text'        => 'Controle de acesso',
                    'url'         => route('acesso.index'),
                    'icon'        => 'id-card',
                    'can' => 'portal'
                    ]);                
            }
            //$event->menu->add('COMUNICADOS');
            if(Gate::check('editor', Auth::user())){
                $event->menu->add('COMUNICADOS',[
                'text'        => 'Comunicados',
                'url'         => route('comunicados.index'),
                'icon'        => 'fa',
                'can' => 'editor'
                ]);
            }
            if(Gate::check('sod', Auth::user())){
                $event->menu->add('SOD',                
                [
                    'text'    => 'Catraca',
                    'icon'    => 'binoculars',                    
                    'can' => 'sod',
                    'submenu' => [
                        [
                            'icon'    => 'dashboard', 
                            'text' => 'Dashboard',
                            'url'   => route('sod.index'),
                        ],
                        [
                            'text' => 'Relatório',
                            'url'   => route('sod.relatorio'),
                            'icon' => 'pie-chart',
                        ],                        
                    ],
                ]);
            }

        });
    }
}
