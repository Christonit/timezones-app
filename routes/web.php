<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;


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

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', function () {

    return view('index');

})->middleware(['verified']);



Route::get('/home', 'HomeController@index')->name('home');


Route::post('/check-email','Auth\RegisterController@findUser');

Route::get('/login','Auth\LoginController@showRegistrationForm')->name('login');
Route::post('/login','Auth\LoginController@login');

Route::post('/register','Auth\RegisterController@create');

Route::get('/logout', function (){
    Auth::logout();

    return redirect('/login'); 
});

Route::post('/upload-timezones','TimezonesController@upload');