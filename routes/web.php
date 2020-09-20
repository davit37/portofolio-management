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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function() {
    Route::get('plans','PlanController@index');
    Route::get("plans/create","PlanController@create");
    Route::post("plans/store","PlanController@store");
    Route::post("plans/approve/{id}","PlanController@approve");
    Route::post('plans/get-data','PlanController@getData')->name('plan.get-data');
    Route::get("plans/detail/{id}",'PlanController@detail');
    Route::post("plans/save-detail",'PlanController@saveDetail');

    Route::get("role",'RoleController@index');
    Route::get("role/get-data",'RoleController@getData')->name('role.get-data');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
