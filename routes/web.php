<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile');

Route::get('/shift/index', 'ShiftsController@index')->name('shift.index');
Route::get('/shift/create', 'ShiftsController@create');
Route::get('/shift/{shift}/edit', 'ShiftsController@edit')->name('shift.edit');
Route::get('/shift/{shift}', 'ShiftsController@show')->name('shift.show');
Route::delete('/shift/{shift}', 'ShiftsController@destroy')->name('shift.destroy');
Route::patch('/shift/{shift}', 'ShiftsController@update')->name('shift.update');
Route::post('/sh', 'ShiftsController@store');

Route::get('/security', 'SecurityController@index')->name('company.index');
Route::get('/security/create', 'SecurityController@create');
Route::delete('/security/{company}', 'SecurityController@destroy')->name('company.destroy');
Route::get('/security/{company}/edit', 'SecurityController@edit')->name('company.edit');
Route::post('/s', 'SecurityController@store');

Route::get('/guard/{company}/create', 'GuardsController@create');
Route::delete('/guard/{guard}', 'GuardsController@destroy')->name('guard.destroy');
Route::get('/guard/{guard}', 'GuardsController@show')->name('guard.show');
Route::post('/g', 'GuardsController@store');

Route::get('/guarding/index', 'GuardingController@index')->name('guarding.index');
Route::post('/guarding/{shift}', 'GuardingController@store');
Route::patch('/guarding/{shift}', 'GuardingController@update')->name('guarding.update');
Route::delete('/guarding/{shift}', 'GuardingController@destroy')->name('guarding.destroy');

Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('can:manage-users')
    ->group(function () {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
