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
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/unapproved', 'UnapprovedUserController@index')->name('unapproved');
Route::get('/approved', 'ApprovedUserController@index')->name('approved');

Route::get('/admin/unapproved/{user}', 'AdminController@unApprove')->name('unapprove_user');
Route::get('/admin/approved/{user}', 'AdminController@approve')->name('approve_user');
