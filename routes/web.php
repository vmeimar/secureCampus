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
Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', 'HomeController@index');

Route::get('/profile/{user}', 'ProfilesController@index')->middleware('can:use-application')->name('profile');

Route::get('/shift/index', 'ShiftsController@index')->middleware('can:view-shifts')->name('shift.index');
Route::get('/shift/create', 'ShiftsController@create')->middleware('can:create-shifts');
Route::get('/shift/{shift}/edit', 'ShiftsController@edit')->middleware('can:edit-shifts')->name('shift.edit');
Route::post('/sh', 'ShiftsController@store')->middleware('can:create-shifts');
Route::patch('/shift/{shift}', 'ShiftsController@update')->middleware('can:edit-shifts')->name('shift.update');
Route::delete('/shift/{shift}', 'ShiftsController@destroy')->middleware('can:admin')->name('shift.destroy');

Route::get('/active-shift/index', 'ActiveShiftsController@index')->middleware('can:view-shifts')->name('active-shift.index');
Route::get('/active-shift/create/{shift}', 'ActiveShiftsController@create')->middleware('can:edit-shifts')->name('active-shift.create');
Route::post('/as', 'ActiveShiftsController@store')->middleware('can:edit-shifts');
Route::patch('/active-shift/{shift}/confirm', 'ActiveShiftsController@confirmActiveShift')->middleware('can:confirm-shifts');
Route::delete('/active-shift/{activeShift}', 'ActiveShiftsController@destroy')->middleware('can:admin')->name('active-shift.destroy');

Route::get('/security/index', 'SecurityController@index')->middleware('can:manage-security')->name('company.index');
Route::get('/security/create', 'SecurityController@create')->middleware('can:manage-security');
Route::get('/security/{company}/edit', 'SecurityController@edit')->middleware('can:manage-security')->name('company.edit');
Route::post('/s', 'SecurityController@store')->middleware('can:manage-security');
Route::patch('/s/{company}', 'SecurityController@update')->middleware('can:manage-security');
Route::delete('/security/{company}', 'SecurityController@destroy')->middleware('can:admin')->name('company.destroy');

Route::get('/guard/{company}/index', 'GuardsController@index')->middleware('can:manage-security')->name('guard.index');
Route::get('/guard/{company}/create', 'GuardsController@create')->middleware('can:create-guard');
Route::get('/guard/{guard}/edit', 'GuardsController@edit')->middleware('can:manage-security')->name('guard.edit');
Route::get('/guard/{guard}', 'GuardsController@show')->middleware('can:manage-shifts')->name('guard.show');
Route::post('/guard/{guard}', 'GuardsController@exportCsv')->middleware('can:manage-shifts')->name('guard.exportCsv');
Route::post('/g', 'GuardsController@store')->middleware('can:create-guard');
Route::patch('/g/{guard}', 'GuardsController@update')->middleware('can:create-guard');
Route::delete('/guard/{guard}', 'GuardsController@destroy')->middleware('can:admin')->name('guard.destroy');

Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('can:admin')
    ->group(function () {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
