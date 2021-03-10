<?php

namespace App\Providers;

use App\Model\Comunicados\comunicado;
use App\Observers\ComunicadosObserver;
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
        comunicado::observe(ComunicadosObserver::class);
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            //echo view('admin.profileMenu');            

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
                        'icon'        => 'fa fa-bullhorn',
                        'can' => 'portal'
                    ],
                    [
                        'text'        => 'Controle de acesso',
                        'url'         => route('acesso.index'),
                        'icon'        => 'fa fa-id-card',
                        'can' => 'portal'
                    ],
                    [
                        'text'        => 'Atividades Extraclasse',
                        //'url'         => route('extraclasse.index'),
                        'icon'        => 'fa fa-futbol',
                        'can' => 'portal',
                        'submenu' => [
                            [
                                'text'        => 'Realizar Inscrição',
                                'url'         => route('extraclasse.index'),
                                'icon'        => 'fa fa-plus',
                            ],
                            [
                                'text'        => 'Minhas inscrições',
                                'url'         => route('aluno.index'),
                                'icon'        => 'fa fa-dollar',
                            ]
                        ]
                    ]
                );
            }
            //$event->menu->add('COMUNICADOS');
            //dd(sizeof(Auth::user()->profile));
            Auth::check() && sizeof(Auth::user()->profile) > 1 ? $event->menu->add('ADMINISTRAÇÃO') : null;            
            if (Gate::check('editor', Auth::user())) {
                $event->menu->add(
                    [
                        'text'        => 'Adm - Comunicados',
                        'url'         => route('comunicados.index'),
                        'icon'        => 'fa fa-bullhorn',
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
                        'icon'        => 'fa fa-dolar',
                        'can' => 'desconto',
                        'submenu' => [
                            [
                                'icon'    => 'fa fa-envelope',
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
                    'icon'        => 'fa fa-cut',
                    'can' => 'tesouraria',
                    'submenu' => [
                        [
                            'icon'    => 'fa fa-pie-chart', 
                            'text' => 'Extraclasse',
                            'url'   => route('tesouraria.index'),
                        ],
                        [
                            'icon'    => 'fa fa-pie-chart', 
                            'text' => 'Terceirizadas',
                            'url'   => route('terceirizadas.index'),
                        ],
                        [
                            'icon'    => 'fa fa-money', 
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
                    'icon'        => 'fa fa-user',
                    'submenu' => [  
                        [
                            'icon'    => 'fa fa-pie-chart', 
                            'text' => 'Alunos Matriculados',
                            'url'   => route('alunos_matriculados.index'),
                        ],                      
                        [
                            'icon'    => 'fa fa-pie-chart', 
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
                    'icon'        => 'fa fa-pencil',
                    'submenu' => [  
                        [
                            'icon'    => 'fa fa-user', 
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
                    'icon'        => 'fa fa-futbol',
                    //'can' => 'ext',
                    'submenu' => [
                        [
                            'icon'    => 'fa fa-line-chart', 
                            'text' => 'Estatísticas',
                            'url'   => route('extclasse.dashboard'),
                        ],
                        [
                            'text' => 'Atividades Cadastradas',
                            'url'   => route('extclasse.index'),
                            'icon' => 'fa fa-graduation-cap',
                        ]
                    ]
                ]);
            }
            if(Gate::check('secretaria',Auth::user()) || Gate::check('central',Auth::user()) || Gate::check('root',Auth::user()) || Gate::check('supervisao_adm',Auth::user())){
                $event->menu->add( [
                    'text'        => 'Inscrições',
                    //'url'         => route('communicated.index'),
                    'icon'        => 'fa fa-graduation-cap',
                    //'can' => 'ext',
                    'submenu' => [
                        [
                            'icon'    => 'fa fa-line-chart', 
                            'text' => 'Estatísticas',
                            'url'   => route('alunos_novos.index'),
                        ],
                        [
                            'text' => 'Listar Inscrições',
                            'url'   => route('alunos_novos.listar'),
                            'icon' => 'fa fa-list',
                        ],                        
                        [
                            'text' => 'Listar Duplicidade',
                            'url'   => route('alunos_novos.listar_duplicidade'),
                            'icon' => 'fa fa-remove',
                            //'can' => 'cut',
                        ],
                        [
                            'text' => 'Lista de Espera',
                            'url'   => route('alunos_novos.espera'),
                            'icon' => 'fa fa-pause-circle',
                        ],
                        
                    ]
                ]);
            }

            if (Gate::check('sod', Auth::user())) {
                $event->menu->add(
                    [
                        'text'    => 'Catraca',
                        'icon'    => 'fa fa-binoculars',
                        'can' => 'sod',
                        'submenu' => [
                            [
                                'icon'    => 'fa fa-home',
                                'text' => 'Dashboard',
                                'url'   => route('sod.index'),
                            ],
                            [
                                'text' => 'Relatório',
                                'url'   => route('sod.relatorio'),
                                'icon' => 'fa fa-line-chart',
                            ]
                        ]
                    ]);
            }

            if (Gate::check('root', Auth::user())) {
                $event->menu->add(
                    [
                        'text'    => 'Suporte',
                        'icon'    => 'fa fa-desktop',
//                      'can' => 'r',                        
                        'url'   => route('filial.index'),
                    ]);
            }
        });

        
    }
}
