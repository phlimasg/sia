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
        //Controle de acesso
        Route::get('acesso','Portal\PortalCatracaController@index')->name('acesso.index');
    });
    Route::prefix('abel')->group(function(){
        Route::resource('comunicados', 'Comunicados\ComunicadosController');        
        Route::get('sod/relatorio', 'Sod\CatracaController@relatorio')->name('sod.relatorio');
        Route::post('sod/relatorio', 'Sod\CatracaController@relatorio_gerar');
        Route::resource('sod', 'Sod\CatracaController');
        Route::resource('extclasse', 'AtividadesExtraclasse\Admin\ExtraclasseController');
        Route::resource('extclasse/{id}/turma', 'AtividadesExtraclasse\Admin\ExtraclasseTurmaController');
        Route::resource('listadeespera','AtividadesExtraclasse\Admin\ExtraclasseEsperaController');
        Route::resource('inscricao','AtividadesExtraclasse\Admin\ExtraclasseInscricaoController');
    });
});
Route::get('listadeespera/donwload','AtividadesExtraclasse\Admin\ExtraclasseEsperaController@downloadLista')->name('downloadLista');

/*Auth admin*/


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mail', 'HomeController@mail');
