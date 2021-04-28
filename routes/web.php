<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/telegram', 'Telegram\NotificationController@toTelegram');


Route::prefix('bolsa_social')->group(function(){
        Route::get('/renovacao', function(){
            return redirect()->to('http://sbd.lasalle.org.br/colegio-la-salle-abel/renova%C3%A7%C3%A3o-de-bolsa-social')->send();
        });
    });
    Route::get('/solicita_flex', function(){
        return redirect()->to('http://sbd.lasalle.org.br/')->send();
    });
    


Route::get('/', function () {
    return redirect()->route('portal.index');
});
Route::post('senderror', 'Mail\MailController@senderror')->name('senderror');

Auth::routes();
/*Auth Responsáveis*/

Route::get('portal/login','Portal\PortalLoginController@index')->name('portal.index');
Route::post('portal/auth','Portal\PortalLoginController@auth')->name('portal.auth');
//google login
Route::get('/portal/google/login','Auth\GoogleLoginController@login')->name('gLogin');


Route::post('/verificaCPF','Portal\PortalIsencaoDeMensalidade@verificacfp')->name('verificaCPF');
Route::get('/destroyImage/{id}/{nome}','Portal\PortalIsencaoDeMensalidade@destroyImage')->name('destroyImage');

Route::get('telegram/comunicados/{id}', 'Portal\PortalComunicadosController@show')->name('comunicadosTelegram');

//Tv La Salle Publico
Route::resource('tv/','tv\portal\TVController');

Route::group(['middleware' => ['auth']], function () {    
    Route::post('ckeditor/image_upload', 'Comunicados\CKEditorController@upload')->name('upload');
    Route::prefix('portal')->group(function(){
        Route::resource('communicated', 'Portal\PortalComunicadosController');
        //Atividades Extraclasses
        Route::resource('extraclasse/aluno', 'AtividadesExtraclasse\Portal\PortalExtraclasseAlunoController');
        Route::resource('extraclasse', 'AtividadesExtraclasse\Portal\PortalExtraclasseController')->except(['create']);        
        Route::get('extraclasse/create/{id}', 'AtividadesExtraclasse\Portal\PortalExtraclasseController@create')->name('extraclasse.create');
        Route::get('extraclasse/details/{id}', 'AtividadesExtraclasse\Portal\PortalExtraclasseController@details')->name('extraclasse.details');
        Route::resource('cart', 'AtividadesExtraclasse\Portal\PortalCarrinhoController')->except(['create']);
        Route::post('pagamento','GetnetController@CredPayment')->name('pagamento');
        Route::post('inscricao','AtividadesExtraclasse\Portal\PortalCarrinhoController@inscricaoZero')->name('inscricao');        
        Route::post('inscricaoTerceirizadas','AtividadesExtraclasse\Portal\PortalCarrinhoController@inscricaoTerceirizadas')->name('inscricaoTerceirizadas');
        //Controle de acesso
        Route::get('acesso','Portal\PortalCatracaController@index')->name('acesso.index');
    });
    Route::prefix('abel')->group(function(){
        Route::resource('comunicados', 'Comunicados\ComunicadosController');        
        Route::get('sod/relatorio', 'Sod\CatracaController@relatorio')->name('sod.relatorio');
        Route::post('sod/relatorio', 'Sod\CatracaController@relatorio_gerar');
        Route::resource('sod', 'Sod\CatracaController');
        
        Route::any('descontos/covid/search', 'Desconto\DescontoCovidController@search')->name('covid.search');
        Route::get('descontos/covid/relatorio', 'Desconto\DescontoCovidController@relatorio')->name('covid.relatorio');
        Route::post('descontos/covid/relatorio', 'Desconto\DescontoCovidController@storeRelatorio')->name('covid.storeRelatorio');
        Route::post('descontos/covid/storeAutorizado', 'Desconto\DescontoCovidController@storeAutorizado')->name('covid.storeAutorizado');
        Route::resource('descontos/covid', 'Desconto\DescontoCovidController');

        Route::get('extclasse/dashboard', 'AtividadesExtraclasse\Admin\ExtraclasseController@dashboard')->name('extclasse.dashboard'); 
        Route::post('extclasse/relatorio/cancelamentos', 'AtividadesExtraclasse\Admin\ExtraclasseController@ExportCancelamento')->name('extclasse.cancelamentos'); 
        Route::resource('extclasse', 'AtividadesExtraclasse\Admin\ExtraclasseController');
        Route::resource('extclasse/{id}/turma', 'AtividadesExtraclasse\Admin\ExtraclasseTurmaController');
        Route::get('extclasse/{id}/relatorio/{turma}', 'AtividadesExtraclasse\Admin\ExtraclasseController@ExportInscritos')->name('extclasse.inscritos'); 
        

        //lista de espera
        Route::post('extraclasse/listadeespera/autoriza','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@autorizaInscricao')->name('listadeespera.autorizaInscricao');
        Route::put('extraclasse/listadeespera/troca','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@troca')->name('listadeespera.troca');
        Route::resource('listadeespera','AtividadesExtraclasse\Admin\ExtraclasseEsperaController');

        Route::resource('inscricao','AtividadesExtraclasse\Admin\ExtraclasseInscricaoController');
        
        Route::post('tesouraria/cancelamento','AtividadesExtraclasse\Admin\ExtraclasseTesourariaController@cancelamento')->name('inscricao.cancelamento');
        Route::post('tesouraria/pagamento','AtividadesExtraclasse\Admin\ExtraclasseTesourariaTerceirizadas@pagamento')->name('terceirizadas.pagamento');
        Route::prefix('tesouraria')->group(function(){
            Route::resource('tesouraria','AtividadesExtraclasse\Admin\ExtraclasseTesourariaController');
            Route::resource('terceirizadas','AtividadesExtraclasse\Admin\ExtraclasseTesourariaTerceirizadas');
        });
        Route::post('central/pagamento','AtividadesExtraclasse\Admin\ExtraclasseCentral@pagamento')->name('extraclasse_terceirizadas.pagamento');
        Route::prefix('central')->group(function(){            
            Route::resource('alunos_matriculados','CentralDeAtendiment\Admin\AlunosController');
            Route::resource('extraclasse_terceirizadas','AtividadesExtraclasse\Admin\ExtraclasseCentral');
            Route::resource('leads','CentralDeAtendiment\Admin\LeadsController');
            Route::resource('RDCrm','CentralDeAtendiment\Admin\RDCrmController');
        });
        Route::prefix('alunos_novos')->namespace('Inscricao')->group(function(){
            Route::get('/listar','InscricaoController@listar')->name('alunos_novos.listar');
            Route::get('/espera','InscricaoController@espera')->name('alunos_novos.espera');
            Route::post('/espera','InscricaoController@habilitarEspera')->name('alunos_novos.habilitarEspera');
            Route::get('/listar_duplicidade','InscricaoController@listar_duplicidade')->name('alunos_novos.listar_duplicidade');
            Route::post('/listar_duplicidade','InscricaoController@cancelar_duplicidade')->name('alunos_novos.cancelar_duplicidade');
            Route::resource('/candidato','InscricaoController', [
                'names' => [
                    'index' => 'alunos_novos.index',
                    'show' => 'alunos_novos.show',
                    'update' => 'alunos_novos.update'
                ]
            ]);
        });

    });

    //Suporte tecnico
    Route::prefix('suporte')->namespace('Sup')->group(function(){
        Route::resource('/filial','SupFilialController');
        Route::resource('/filial/{filial}/salas','SupSalaController');
    });

    
});
Route::get('listadeespera/donwload','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@downloadLista')->name('downloadLista');
Route::post('portal/pagamento/listadeespera','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@pagamentoListaDeEspera')->name('pagamento.espera');
Route::get('portal/pagamento/listadeespera/{id}','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@exibeListaDeEspera')->name('exibe.espera');

/*Auth admin*/


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mail', function(){
    return view('mail.Comunicado');
});
