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
                ],
                [
                    'text'        => 'Atividades Extraclasse',
                    //'url'         => route('extraclasse.index'),
                    'icon'        => 'soccer-ball-o',
                    'can' => 'portal',
                    'submenu' =>[
                        [
                            'text'        => 'Realizar Inscrição',
                            'url'         => route('extraclasse.index'),
                            'icon'        => 'plus',
                        ],
                        [
                            'text'        => 'Minhas inscrições',
                            'url'         => route('aluno.index'),
                            'icon'        => 'money',
                        ]
                    ]
                ]
                );                
            }
            //$event->menu->add('COMUNICADOS');
            $event->menu->add('ADMINISTRAÇÃO');
            if(Gate::check('editor', Auth::user())){
                $event->menu->add([
                    'text'        => 'Comunicados',
                    'url'         => route('comunicados.index'),
                    'icon'        => 'fa',
                    'can' => 'editor'
                ]);
            }
            if(Gate::check('tesouraria',Auth::user())){
                $event->menu->add([
                    'text'        => 'Tesouraria',
                    //'url'         => route('tesouraria.index'),
                    'icon'        => 'scissors',
                    'can' => 'tesouraria',
                    'submenu' => [
                        [
                            //'icon'    => 'pie-chart', 
                            'text' => 'Extraclasse',
                            'url'   => route('tesouraria.index'),
                        ],
                        [
                            //'icon'    => 'pie-chart', 
                            'text' => 'Terceirizadas',
                            'url'   => route('terceirizadas.index'),
                        ],
                    ]
                ]);
            }
            if(Gate::check('central',Auth::user())){
                $event->menu->add([
                    'text'        => 'Central de Atendimento',
                    //'url'         => route('tesouraria.index'),
                    'icon'        => 'user',
                    'can' => 'central',
                    'submenu' => [                        
                        [
                            //'icon'    => 'pie-chart', 
                            'text' => 'Terceirizadas',
                            'url'   => route('terceirizadas.index'),
                        ],
                    ]
                ]);
            }
            if(Gate::check('ext',Auth::user())){
                $event->menu->add( [
                    'text'        => 'Atividades Extraclasse',
                    //'url'         => route('communicated.index'),
                    'icon'        => 'soccer-ball-o',
                    //'can' => 'ext',
                    'submenu' => [
                        [
                            'icon'    => 'pie-chart', 
                            'text' => 'Estatísticas',
                            'url'   => route('extclasse.index'),
                        ],
                        [
                            'text' => 'Atividades Cadastradas',
                            'url'   => route('extclasse.index'),
                            'icon' => 'graduation-cap',
                        ]
                    ]
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
