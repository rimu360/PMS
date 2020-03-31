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
Route::get('/admin/add_category', 'Admin\AdminController@add_category')->name('add_category');
Route::post('/admin/add_category_post', 'Admin\AdminController@add_category_post')->name('add_category_post');
Route::get('/admin/category_list', 'Admin\AdminController@category_list')->name('category_list');
Route::get('/admin/update_category/{id}', 'Admin\AdminController@update_category')->name('update_category');
Route::post('/admin/update_category_post/{id}', 'Admin\AdminController@update_category_post')->name('update_category_post');
Route::get('/admin/add_medicine', 'Admin\AdminController@add_medicine')->name('add_medicine');
Route::post('/admin/add_medicine_post', 'Admin\AdminController@add_medicine_post')->name('add_medicine_post');
Route::get('/admin/medicine_list', 'Admin\AdminController@medicine_list')->name('medicine_list');
Route::get('/admin/update_medicine/{id}', 'Admin\AdminController@update_medicine')->name('update_medicine');
Route::post('/admin/update_medicine_post/{id}', 'Admin\AdminController@update_medicine_post')->name('update_medicine_post');
Route::post('/admin/delete_medicine', 'Admin\AdminController@delete_medicine')->name('delete_medicine');




});

// ------------------------Pharmacist---------------------------------------
Route::group(['middleware' => ['pharmacist']], function () {
Route::get('/pharmacist', 'Pharmacist\PharmacistController@index')->name('pharmacist');

});

// ------------------------Customer---------------------------------------
Route::group(['middleware' => ['customer']], function () {
Route::get('/customer', 'Customer\CustomerController@index')->name('customer');
Route::get('/customer/medicine_list_customer', 'Customer\CustomerController@medicine_list_customer')->name('medicine_list_customer');


});
