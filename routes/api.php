<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth',function(){
    Route::get('/province', 'Api\ProvinceController@index' );
    Route::get('/city', 'Api\CityController@index' );
    Route::get('/district', 'Api\DistrictController@index' );
    Route::get('/village', 'Api\VillageController@index' );

    Route::get('/cities/{provid}', 'Api\CityController@cities');
    Route::get('/districts/{cityId}', 'Api\DistrictController@districts');
    Route::get('/villages/{districtId}', 'Api\VillageController@villages');

    Route::get('/userjson', 'Api\UserController@json');
    Route::post('/user', 'Api\UserController@store');
    Route::post('/statususer', 'Api\UserController@status');
    Route::get('/jobsjson', 'Api\JobController@json');
    Route::delete('/jobs', 'Api\JobController@destroy');
    Route::resource('jobs', 'Api\JobController')->except(['create','edit']);

    Route::get('/joblevelsjson', 'Api\JobLevelController@json');
    Route::delete('/joblevels', 'Api\JobLevelController@destroy');
    Route::resource('joblevels', 'Api\JobLevelController')->except(['create','edit']);

    Route::get('/categoryjson', 'Api\CategoryController@json');
    Route::delete('/categories', 'Api\CategoryController@destroy');
    Route::resource('categories', 'Api\CategoryController')->except(['create','edit']);

    Route::get('/departementjson', 'Api\DepartementController@json');
    Route::resource('/departements', 'Api\DepartementController')->except(['create','edit']);

    Route::get('/employeejson', 'Api\EmployeeController@json');
    Route::resource('/employees', 'Api\EmployeeController')->except(['create','edit']);

    Route::get('/banks', 'Api\BankController@index');

    Route::get('/attendancesjson', 'Api\AttendanceController@json');
    Route::resource('/attendances', 'Api\AttendanceController');
    Route::get('/workplans', 'Api\WorkplanController@index');


// });
