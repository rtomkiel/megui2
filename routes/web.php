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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return redirect('/home');
    });
    Route::get('/home', 'HomeController@index');
    Route::get('/sair', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::Auth();
});

/* User Manager */
Route::group(["prefix" => "usuarios", 'middleware' => ['auth','auth.admin']], function() {
    Route::get('/', 'UserController@listUsers')->name('usuarios');
    Route::get('/novo', 'UserController@getCreate')->name('novo');
    Route::post("/novo/store", "UserController@postCreate");
    Route::get("/delete/{user}", "UserController@getDelete");
    
});
Route::group(['prefix' => 'usuarios', 'middleware' => ['auth']], function() {
    Route::get('{user}/perfil', 'UserController@getEdit')->name('perfil');
    Route::post("/store", "UserController@postEdit");
});

Route::group(['prefix' => 'teste', 'middleware' => ['auth'], 'name' => 'teste'], function() {
    Route::get('/', 'DashController@getDatabaseUSe');
});