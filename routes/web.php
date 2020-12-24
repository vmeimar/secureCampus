<?php

use App\Mail\NewUserRegisterMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
    return redirect('/home');
})->name('home');

Route::get('/email', 'AppController@createUsersFromImport');

Route::get('/set/password/{token}', 'PasswordSetupController@getSetPassword');
Route::post('/set/password', 'PasswordSetupController@postSetPassword');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'ProfilesController@index')->middleware('can:use-application')->name('profile');

Route::get('/shift/index', 'ShiftsController@index')->middleware('can:view-shifts')->name('shift.index');
Route::get('/shift/create', 'ShiftsController@create')->middleware('can:create-shifts');
Route::get('/shift/{shift}/edit', 'ShiftsController@edit')->middleware('can:edit-shifts')->name('shift.edit');
Route::post('/sh', 'ShiftsController@store')->middleware('can:create-shifts');
Route::patch('/shift/{shift}', 'ShiftsController@update')->middleware('can:edit-shifts')->name('shift.update');
Route::delete('/shift/{shift}', 'ShiftsController@destroy')->middleware('can:admin')->name('shift.destroy');

Route::get('/active-shift/index', 'ActiveShiftsController@index')->middleware('can:view-shifts')->name('active-shift.index');
Route::get('/active-shift/create/{shift}', 'ActiveShiftsController@create')->middleware('can:assign-shifts')->name('active-shift.create');
Route::get('/active-shift/edit/{activeShift}', 'ActiveShiftsController@edit')->middleware('can:edit-shifts')->name('active-shift.edit');
Route::post('/active-shift/{location}/export-pdf', 'ActiveShiftsController@exportPdf')->name('active-shift.export-pdf');
Route::post('/active-shift/export-committee-pdf', 'ActiveShiftsController@exportCommitteePdf')->name('active-shift.export-committee-pdf');
Route::post('/active-shift/show-by-location', 'ActiveShiftsController@showByLocation')->middleware('can:view-shifts')->name('active-shift.show-by-location');
Route::post('active-shift/index/fetch', 'ActiveShiftsController@fetch')->name('active-shift.fetch');       //   AJAX
Route::post('/as', 'ActiveShiftsController@store')->middleware('can:assign-shifts');
Route::post('/as/{location}/export-by-location', 'ActiveShiftsController@exportByLocation')->middleware('can:view-shifts')->name('active-shift.export-by-location');
Route::patch('/active-shift/{shift}/confirm-supervisor', 'ActiveShiftsController@confirmActiveShiftSupervisor')->middleware('can:confirm-shifts');
Route::patch('/active-shift/{location}/confirm-all-supervisor', 'ActiveShiftsController@confirmAllSupervisor')->middleware('can:supervisor');
Route::patch('/active-shift/{shift}/confirm-steward', 'ActiveShiftsController@confirmActiveShiftSteward')->middleware('can:confirm-shifts-steward');
Route::patch('/as/{activeShift}', 'ActiveShiftsController@update')->middleware('can:confirm-shifts')->name('active-shift.update');
Route::delete('/active-shift/{activeShift}', 'ActiveShiftsController@destroy')->middleware('can:assign-shifts')->name('active-shift.destroy');

Route::get('/security/index', 'SecurityController@index')->middleware('can:manage-security')->name('company.index');
Route::get('/security/choose-company', 'SecurityController@chooseCompany')->middleware('can:epitropi')->name('security.choose-company');
Route::get('/security/create', 'SecurityController@create')->middleware('can:manage-security');
Route::get('/security/{company}/edit', 'SecurityController@edit')->middleware('can:manage-security')->name('company.edit');
Route::post('/s', 'SecurityController@store')->middleware('can:manage-security');
Route::post('/security/choose-export', 'SecurityController@chooseExport')->middleware('can:epitropi')->name('security.choose-export');
Route::post('/security/{company}/show-overtime', 'SecurityController@showOvertime')->middleware('can:epitropi')->name('security.show-overtime');
Route::patch('/s/{company}', 'SecurityController@update')->middleware('can:manage-security');
Route::delete('/security/{company}', 'SecurityController@destroy')->middleware('can:admin')->name('company.destroy');

//Guards Routes
Route::prefix('/guard')->group(function () {
    Route::get('/{company}/index', 'GuardsController@index')->middleware('can:manage-security')->name('guard.index');
    Route::get('/{company}/create', 'GuardsController@create')->middleware('can:create-guard');
    Route::get('/{guard}/edit', 'GuardsController@edit')->middleware('can:manage-security')->name('guard.edit');
    Route::get('/{guard}', 'GuardsController@show')->middleware('can:manage-security')->name('guard.show');
    Route::get('/{company}/export-by-month', 'GuardsController@exportByMonth')->middleware('can:manage-security')->name('guard.export-by-month');
    Route::post('/{guard}/custom-range', 'GuardsController@showCustomRangeShifts')->name('guard.custom-range');
    Route::post('/{company}/import', 'GuardsController@import')->name('guard.import');
    Route::post('/{guard}/export', 'GuardsController@export')->name('guard.export');
    Route::post('/{company}/export-all-guards', 'GuardsController@exportAllGuards')->name('guard.export-all-guards');
    Route::post('/{company}/export-all-guards-pdf', 'GuardsController@exportAllGuardsPdf')->name('guard.export-all-guards-pdf');
    Route::post('/{company}/export-committee', 'GuardsController@exportCommittee')->middleware('can:epitropi')->name('guard.export-committee');
    Route::post('/store', 'GuardsController@store')->middleware('can:create-guard')->name('guard.store');
    Route::patch('/update/{guard}', 'GuardsController@update')->middleware('can:create-guard')->name('guard.update');
    Route::delete('/destroy/{guard}', 'GuardsController@destroy')->middleware('can:admin')->name('guard.destroy');
//    Unused CSV Export
//    Route::post('/exportcsv/{guard}', 'GuardsController@exportCsv')->middleware('can:manage-shifts')->name('guard.exportCsv');
});

//App Routes
Route::prefix('/app')->group(function () {
    Route::get('/index', 'AppController@index')->middleware('can:doy')->name('app.index');
    Route::get('/populate-days-table', 'AppController@populateDaysTable')->name('app.populate-days');
    Route::post('/holidays/import', 'AppController@import')->name('holidays.import');
    Route::post('/user-emails/import', 'AppController@userEmailsImport')->name('user-emails.import');
});

//Factors Routes
Route::prefix('/factor')->group(function () {
    Route::get('/index', 'FactorsController@index')->name('factor.index');
    Route::get('/edit/{factor}', 'FactorsController@edit')->name('factor.edit');
    Route::patch('/update/{factor}', 'FactorsController@update')->name('factor.update');
});

//Location Routes
Route::prefix('/location')->group(function () {
    Route::get('/create', 'LocationsController@create')->name('location.create');
    Route::post('/store', 'LocationsController@store')->name('location.store');
});

//Contract Routes
Route::prefix('/contract')->group(function () {
    Route::get('/index', 'ContractsController@index')->middleware('can:doy')->name('contract.index');
    Route::get('/create', 'ContractsController@create')->middleware('can:doy')->name('contract.create');
    Route::get('/edit/{contract}', 'ContractsController@edit')->middleware('can:doy')->name('contract.edit');
    Route::post('/store', 'ContractsController@store')->middleware('can:doy')->name('contract.store');
    Route::patch('/update/{contract}', 'ContractsController@update')->middleware('can:doy')->name('contract.update');
    Route::delete('/delete/{contract}', 'ContractsController@destroy')->middleware('can:doy')->name('contract.destroy');
});

//Admin Routes
Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('can:admin')
    ->group(function () {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
