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
/*Route::get('/solicita_flex',function()
{
    return redirect()->route('portal.index');
});*/
Route::resource('/solicita_flex','Portal\PortalIsencaoDeMensalidade');
Route::post('/verificaCPF','Portal\PortalIsencaoDeMensalidade@verificacfp')->name('verificaCPF');
Route::get('/destroyImage/{id}/{nome}','Portal\PortalIsencaoDeMensalidade@destroyImage')->name('destroyImage');

Route::prefix('bolsa_social')->group(function(){
    Route::get('/renovacao', function(){
        return redirect()->to('http://sbd.lasalle.org.br/colegio-la-salle-abel/renova%C3%A7%C3%A3o-de-bolsa-social')->send();
    });
});

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

        Route::get('extclasse/dashboard', 'AtividadesExtraclasse\Admin\ExtraclasseController@dashboard')->name('extclasse.dashboard'); 
        Route::post('extclasse/relatorio/cancelamentos', 'AtividadesExtraclasse\Admin\ExtraclasseController@ExportCancelamento')->name('extclasse.cancelamentos'); 
        Route::resource('extclasse', 'AtividadesExtraclasse\Admin\ExtraclasseController');
        Route::resource('extclasse/{id}/turma', 'AtividadesExtraclasse\Admin\ExtraclasseTurmaController');

        Route::any('descontos/covid/search', 'Desconto\DescontoCovidController@search')->name('covid.search');
        Route::get('descontos/covid/relatorio', 'Desconto\DescontoCovidController@relatorio')->name('covid.relatorio');
        Route::post('descontos/covid/relatorio', 'Desconto\DescontoCovidController@storeRelatorio')->name('covid.storeRelatorio');
        Route::post('descontos/covid/storeAutorizado', 'Desconto\DescontoCovidController@storeAutorizado')->name('covid.storeAutorizado');
        
        Route::resource('descontos/covid', 'Desconto\DescontoCovidController');

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
            Route::resource('extraclasse_terceirizadas','AtividadesExtraclasse\Admin\ExtraclasseCentral');
            Route::resource('leads','CentralDeAtendiment\Admin\LeadsController');
            Route::resource('RDCrm','CentralDeAtendiment\Admin\RDCrmController');
        });

    });
});
Route::get('listadeespera/donwload','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@downloadLista')->name('downloadLista');
Route::post('portal/pagamento/listadeespera','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@pagamentoListaDeEspera')->name('pagamento.espera');
Route::get('portal/pagamento/listadeespera/{id}','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@exibeListaDeEspera')->name('exibe.espera');

/*Auth admin*/


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mail', 'HomeController@mail');
