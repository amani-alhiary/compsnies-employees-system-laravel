<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeelistController;


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

Route::get('/createcompany', function () {
    return view('dashboard.company.create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/companies', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('companies', CompanyController::class);
Route::get('/editcompany', [CompanyController::class, 'edit']);

Route::resource('employees', EmployeeController::class);
Route::resource('employeeslist', EmployeelistController::class);
Route::get('/editemployee', [EmployeeController::class, 'edit']);

