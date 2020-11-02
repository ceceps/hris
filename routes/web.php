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
Auth::routes();

Route::get('/', 'Admin\LoginController@index')->name('login');
Route::post('/loginPost', 'Admin\LoginController@loginPost');
Route::get('/logout', 'Admin\LoginController@destroy');

//Route Dasbor
Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/dasbor', 'Admin\DasborController@dasbor')->name('dashboard');
        Route::get('/habiskontrak', 'Admin\DasborController@jsonHabisKontrak');
        Route::get('/user', 'Admin\UserController@index');
        Route::get('/jobs', 'Admin\JobController@index');
        Route::get('/joblevels', 'Admin\JobLevelController@index');
        Route::get('/categories', 'Admin\CategoryController@index');
        Route::get('/departements', 'Admin\DepartementController@index');
        Route::resource('/employees', 'Admin\EmployeeController')->except(['create','edit']);

        Route::post('/attendances-import', 'Admin\AttendanceController@fileImport');
        Route::resource('/attendances', 'Admin\AttendanceController')->except(['create','edit']);
        Route::resource('workplans', 'Admin\WorkplanController')->except(['create','edit']);
        Route::get('payrolljson', 'Admin\PayrollController@json');
        Route::resource('payrolls', 'Admin\PayrollController')->except(['create','edit']);

    }
);



