<?php

use Illuminate\Support\Facades\Route;

use App\Page;

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

// Route::get('/pages', function () {
//     return view('admin.pages.index');
// })->name('admin.pages.index');
//
// Route::get('/pages/create', function () {
//     return view('admin.pages.create');
// })->name('admin.pages.create');
//
// Route::get('/pages/{page}/edit', function () {
//     return view('admin.pages.edit');
// })->name('admin.pages.edit');

Route::resource('pages', 'PageController');

Route::prefix('admin')
->name('admin.')
->namespace('Admin')
->middleware('auth')
->group(function(){
    Route::resource('pages', 'PageController');
    Route::resource('photos', 'PhotoController');
    Route::resource('messages', 'MessageController');
});

//Test PDF page donwloader
Route::get('index', 'NotesController@index');

Route::get('pdf', 'NotesController@pdf')->name('download');

// Rotta per test API js
Route::middleware('api.auth')->get('admin/photos', 'Api\PhotoController@getAll');
