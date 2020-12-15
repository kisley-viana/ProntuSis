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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

//Route::get('/','HomeController@index')->name('login');
Route::get('/', function() {
    return view('paginas.login');
});
//Admin
//Route::get('/admin','HomeController@index')->name('admin');
Route::get('/admin','ProntuarioController@listar')->name('admin');
Route::post('/admin/salvar','ProntuarioController@salvar')->name('salvar');
Route::post('admin/deletar','ProntuarioController@deletar')->name('deletar');
//Route::get('admin/vizualizar','ProntuarioController@listar')->name('vizualizar');

//Pesquisa
Route::get('/admin/pesquisa','ProntuarioController@pesquisa')->name('pesquisa');
//Filtro
Route::get('/admin/filtro','ProntuarioController@filtro')->name('filtro');
//Imprime
Route::get('/admin/imprime', 'ProntuarioController@imprime')->name('imprime');
Route::get('/admin/imprime/todos','ProntuarioController@imprimeTodos')->name('imprime.todos');