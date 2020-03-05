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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//test
Route::get('/test', 'HomeController@test')->name('test');


// ------------------------Admin---------------------------------------
Route::group(['middleware' => ['admin']], function () {
Route::get('/admin', 'Admin\AdminController@index')->name('admin');

});

// ------------------------Pharmacist---------------------------------------
Route::group(['middleware' => ['pharmacist']], function () {
Route::get('/pharmacist', 'Pharmacist\PharmacistController@index')->name('pharmacist');

});

// ------------------------Customer---------------------------------------
Route::group(['middleware' => ['customer']], function () {
Route::get('/customer', 'Customer\CustomerController@index')->name('customer');

});
