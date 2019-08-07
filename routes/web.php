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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Basic crud with larvael pagination and laravel validation
Route::get('/display','ProductController@index')->name('display');
Route::get('/addproduct','ProductController@add');
Route::post('/create','ProductController@create');
Route::get('/edit/{id}','ProductController@edit');
Route::get('/delete/{id}','ProductController@delete');

//Blog search
Route::get('/blog','BlogController@index')->name('blog');
Route::get('/addblog','BlogController@add');
Route::post('/createblog','BlogController@create');
Route::post('/search','BlogController@search');
