<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('dashboard', 'App\Http\Controllers\DashBoardController@dashboard')->middleware('auth');
Route::get('profile/{id}', 'App\Http\Controllers\DashBoardController@profile')->name('profile')->middleware('auth');
Route::get('subscribers', 'App\Http\Controllers\DashBoardController@subscribers')->name('subscribers')->middleware('auth');
Route::get('authors', 'App\Http\Controllers\DashBoardController@authors')->name('authors')->middleware('auth');
Route::post('authors', 'App\Http\Controllers\DashBoardController@newAuthor')->name('new-author')->middleware('auth');
Route::get('pet-channels', 'App\Http\Controllers\DashBoardController@petChannels')->name('pet-channels')->middleware('auth');
Route::post('pet-channels', 'App\Http\Controllers\DashBoardController@newPetChannels')->name('new-channel')->middleware('auth');
Route::post('subscribe-to-channel', 'App\Http\Controllers\DashBoardController@subscribeToChannel')->middleware('auth');

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
});
