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
        Route::get('acesso','Portal\PortalCatracaController@index')->name('acesso.index');
    });
    Route::prefix('abel')->group(function(){
        Route::resource('comunicados', 'Comunicados\ComunicadosController');
        
    });
});

/*Auth admin*/


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mail', 'HomeController@mail');
