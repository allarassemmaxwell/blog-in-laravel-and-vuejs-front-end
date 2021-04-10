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



Route::get('/', 'BlogController@index');
Route::get('/blogs', 'BlogController@allBlogs');
Route::get('/blog/{slug}', 'BlogController@blogSingle');
Route::get('/category/{categoryName}/{id}', 'BlogController@categoryIndex');
Route::get('/tag/{tagName}/{id}', 'BlogController@tagIndex');
Route::get('/search', 'BlogController@search');

