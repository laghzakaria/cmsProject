<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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

Route::get('/categories/archive', 'CategoriesController@archive')->name('categories.archive');
Route::get('/categories/all', 'CategoriesController@all')->name('categories.all');
Route::delete('/categories/{id}/delete', 'CategoriesController@delete')->name('categories.delete');
Route::patch('/categories/{id}/restore', 'CategoriesController@restore')->name('categories.restore');
Route::resource('/categories','CategoriesController');
Route::get('/tags/archive', 'TagsController@archive')->name('tags.archive');
Route::get('/tags/all', 'TagsController@all')->name('tags.all');
Route::delete('/tags/{id}/delete', 'TagsController@delete')->name('tags.delete');
Route::patch('/tags/{id}/restore', 'TagsController@restore')->name('tags.restore');
Route::resource('/tags','TagsController');
Route::resource('/posts','PostsController');
Route::resource('/users','UserController');

Route::get('/post/tag/{id}','PostsTagController@index')->name('posts.tag.index');

Route::post('comments/{id}','CommentsController@store')->name('comments.store');