<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->middleware('guest')->name('auth.login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('auth.login');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('auth.logout');

Route::prefix('home')->middleware('auth')->as('home.')->group(function() {
    Route::get('/', 'App\Http\Controllers\Home\HomeController@index')->name('index');

    Route::prefix('participant')->middleware('auth')->as('participant.')->group(function() {
        Route::get('/', 'App\Http\Controllers\Home\ParticipantController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\Home\ParticipantController@create')->name('create');
        Route::post('/create', 'App\Http\Controllers\Home\ParticipantController@store')->name('store');
        Route::get('/show/{id}', 'App\Http\Controllers\Home\ParticipantController@show')->name('show');
        Route::get('/edit/{id}', 'App\Http\Controllers\Home\ParticipantController@edit')->name('edit');
        Route::put('/edit/{id}', 'App\Http\Controllers\Home\ParticipantController@update')->name('update');
        Route::post('/delete/{id}', 'App\Http\Controllers\Home\ParticipantController@destroy')->name('delete');
    });
});
