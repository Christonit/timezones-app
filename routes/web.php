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


Route::middleware('auth')->group( function (){
    Route::get('/user-information', 'HomeController@getUser');

    Route::post('/create-team', 'TeamsController@create');
    Route::get('/list-teams', 'TeamsController@list');

    //Uses ID query parameter, ex: /get-teammate?id=10
    Route::get('/get-teammate','TeamsController@getTeammate');
    
    Route::get('/list-latest-created-team', 'TeamsController@latestCreated');
    Route::get('/list-team-members/{team}', 'TeamsController@getTeamMembers');
    Route::post('/add-team-members','TeamsController@addMembers');
    Route::delete('/team-members/{id}/delete','TeamsController@destroyTeamMember');

});


Route::post('/upload-timezones','TimezonesController@upload');
Route::post('/search-timezones','TimezonesController@search_timezone');
Route::post('/update-user','HomeController@updateUser');
