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

            //if (Gate::check('portal', Auth::user())) {
                /*$event->menu->add('DASHBOARD');
                $event->menu->add([
                'text'        => 'Dashboard',
                'url'         => route('communicated.index'),
                'icon'        => 'home',
                'can' => 'portal'
                ]);*/

            
            if(Gate::check('portal', Auth::user())){
                $event->menu->add('PAINEL DO RESPONSÁVEL');
                $event->menu->add(
                    [
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
                        'icon'        => 'futbol-o',
                        'can' => 'portal',
                        'submenu' => [
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

            if (Gate::check('editor', Auth::user())) {
                $event->menu->add(
                    'ADMINISTRAÇÃO',
                    [
                        'text'        => 'Adm - Comunicados',
                        'url'         => route('comunicados.index'),
                        'icon'        => 'bullhorn',
                        'can' => 'editor'
                    ]
                    
                    /*[
                        'text'        => 'Atividades Extraclasse',
                        //'url'         => route('communicated.index'),
                        'icon'        => 'futbol',
                        'can' => 'portal',
                        'submenu' => [
                            [
                                'icon'    => 'chart-line',
                                'text' => 'Estatísticas',
                                'url'   => route('extclasse.index'),
                            ],
                            [
                                'text' => 'Atividades Cadastradas',
                                'url'   => route('extclasse.index'),
                                'icon' => 'graduation-cap',
                            ]
                        ]
                    ] */
                );
            }
            if (Gate::check('desconto', Auth::user())) {
                $event->menu->add(
                    [
                        'text'        => 'Comissão de descontos',                        
                        'icon'        => 'money',
                        'can' => 'desconto',
                        'submenu' => [
                            [
                                'icon'    => 'envelope',
                                'text' => 'Covid-19',
                                'url'   => route('covid.index'),
                            ],
                        ]
                    ]);
            }
            /*$event->menu->add('ADMINISTRAÇÃO');
            if(Gate::check('editor', Auth::user())){
                $event->menu->add([
                    'text'        => 'Comunicados',
                    'url'         => route('comunicados.index'),
                    'icon'        => 'fa',
                    'can' => 'editor'
                ]);
            }*/
            if(Gate::check('tesouraria',Auth::user())){
                $event->menu->add([
                    'text'        => 'Tesouraria',
                    //'url'         => route('tesouraria.index'),
                    'icon'        => 'cut',
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
                        [
                            'icon'    => 'money', 
                            'text' => 'Desconto Covid 19',
                            'url'   => route('covid.relatorio'),
                        ],
                    ]
                ]);
            }
            if(Gate::check('central',Auth::user())){
                $event->menu->add([
                    'text'        => 'Central de Atendimento',
                    //'url'         => route('tesouraria.index'),
                    'icon'        => 'user',
                    'submenu' => [  
                        [
                            //'icon'    => 'pie-chart', 
                            'text' => 'Alunos Matriculados',
                            'url'   => route('alunos_matriculados.index'),
                        ],                      
                        [
                            //'icon'    => 'pie-chart', 
                            'text' => 'Terceirizadas',
                            'url'   => route('extraclasse_terceirizadas.index'),
                        ],
                    ]
                ]);
            }

            if(Gate::check('soe',Auth::user())){
                $event->menu->add([
                    'text'        => 'Soe',
                    //'url'         => route('tesouraria.index'),
                    'icon'        => 'pencil',
                    'submenu' => [  
                        [
                            'icon'    => 'user', 
                            'text' => 'Alunos Matriculados',
                            'url'   => route('alunos_matriculados.index'),
                        ],                                              
                    ]
                ]);
            }
            if(Gate::check('ext',Auth::user())){
                $event->menu->add( [
                    'text'        => 'Atividades Extraclasse',
                    //'url'         => route('communicated.index'),
                    'icon'        => 'futbol-o',
                    //'can' => 'ext',
                    'submenu' => [
                        [
                            'icon'    => 'line-chart', 
                            'text' => 'Estatísticas',
                            'url'   => route('extclasse.dashboard'),
                        ],
                        [
                            'text' => 'Atividades Cadastradas',
                            'url'   => route('extclasse.index'),
                            'icon' => 'graduation-cap',
                        ]
                    ]
                ]);
            }
            if(Gate::check('secretaria',Auth::user()) || Gate::check('central',Auth::user()) || Gate::check('root',Auth::user()) || Gate::check('supervisao_adm',Auth::user())){
                $event->menu->add( [
                    'text'        => 'Inscrições',
                    //'url'         => route('communicated.index'),
                    'icon'        => 'graduation-cap',
                    //'can' => 'ext',
                    'submenu' => [
                        [
                            'icon'    => 'line-chart', 
                            'text' => 'Estatísticas',
                            'url'   => route('alunos_novos.index'),
                        ],
                        [
                            'text' => 'Listar Inscrições',
                            'url'   => route('alunos_novos.listar'),
                            'icon' => 'list',
                        ],                        
                        [
                            'text' => 'Listar Duplicidade',
                            'url'   => route('alunos_novos.listar_duplicidade'),
                            'icon' => 'remove',
                            //'can' => 'cut',
                        ],
                        [
                            'text' => 'Lista de Espera',
                            'url'   => route('alunos_novos.espera'),
                            'icon' => 'pause-circle',
                        ],
                        
                    ]
                ]);
            }

            if (Gate::check('sod', Auth::user())) {
                $event->menu->add(
                    'SOD',
                    [
                        'text'    => 'Catraca',
                        'icon'    => 'binoculars',
                        'can' => 'sod',
                        'submenu' => [
                            [
                                'icon'    => 'home',
                                'text' => 'Dashboard',
                                'url'   => route('sod.index'),
                            ],
                            [
                                'text' => 'Relatório',
                                'url'   => route('sod.relatorio'),
                                'icon' => 'line-chart',
                            ]
                        ]
                    ]);
            }
        });
    }
}
