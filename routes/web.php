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

Route::get('/shift/index', 'ShiftsController@index')->middleware('can:view-shifts')->name('shift.index');
Route::get('/shift/create', 'ShiftsController@create')->middleware('can:create-shifts');
Route::get('/shift/{shift}/edit', 'ShiftsController@edit')->middleware('can:edit-shifts')->name('shift.edit');
Route::get('/shift/{shift}', 'ShiftsController@show')->name('shift.show');
Route::delete('/shift/{shift}', 'ShiftsController@destroy')->name('shift.destroy');
Route::patch('/shift/{shift}', 'ShiftsController@update')->name('shift.update');
Route::post('/sh', 'ShiftsController@store');

Route::get('/active-shift/index', 'ActiveShiftsController@index')->name('active-shift.index');
Route::get('/active-shift/create/{shift}', 'ActiveShiftsController@create')->name('active-shift.create');
Route::post('/as', 'ActiveShiftsController@store');
Route::patch('/active-shift/{shift}/confirm', 'ActiveShiftsController@confirmActiveShift');
Route::delete('/active-shift/{activeShift}', 'ActiveShiftsController@destroy')->name('active-shift.destroy');

Route::get('/security', 'SecurityController@index')->middleware('can:manage-security')->name('company.index');
Route::get('/security/create', 'SecurityController@create')->middleware('can:manage-security');
Route::delete('/security/{company}', 'SecurityController@destroy')->middleware('can:admin')->name('company.destroy');
Route::get('/security/{company}/edit', 'SecurityController@edit')->middleware('can:manage-security')->name('company.edit');
Route::post('/s', 'SecurityController@store')->middleware('can:manage-security');

Route::get('/guard/{company}/create', 'GuardsController@create');
Route::delete('/guard/{guard}', 'GuardsController@destroy')->name('guard.destroy');
Route::get('/guard/{guard}', 'GuardsController@show')->name('guard.show');
Route::post('/g', 'GuardsController@store');
Route::post('/guard/{guard}', 'GuardsController@exportCsv')->name('guard.exportCsv');

Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('can:admin')
    ->group(function () {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
