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
    Route::post('/edit-team-name', 'TeamsController@edit');
    Route::delete('/delete-team/{id}','TeamsController@destroy');

    Route::get('/list-teams', 'TeamsController@list');

    //Gets team's projects from query parameter
    Route::get('/{team_name}/team','TeamsController@allProjectGroups');


    //Uses ID query parameter, ex: /get-teammate?id=10
    Route::get('/get-teammate','TeamsController@getTeammate');
    
    Route::get('/list-latest-created-team', 'TeamsController@latestCreated');
    Route::get('/list-team-members/{team}', 'TeamsController@getTeamMembers');
    Route::post('/add-team-members','TeamsController@addMembers');
    Route::delete('/team-members/{id}/delete','TeamsController@destroyTeamMember');

    Route::post('/upload-timezones','TimezonesController@upload');
    Route::post('/search-timezones','TimezonesController@search_timezone');
    Route::post('/update-user','HomeController@updateUser');

    //Gets project category owner from team ID as query parameter, ex: team?id=5. 
    Route::get('/project-category/team','ProjectsGroupController@ownerTeam');

    //Gets all info pertaing a project category by query parametters.
    #Example url: /{team name}/project?name={project category name}&id={project id}
    #Has multiple optional query parameters: only_clients and only_teammates.
    #Example url: /claro-team/project?name=grupo-1&id=14&only_clients=true
    Route::get('/{team_name}/project','ProjectsGroupController@membersOfGroup');
    Route::post('/create-project-category/team/{team}','ProjectsGroupController@createGroup');
    Route::put('/update-project-category/{project}','ProjectsGroupController@changeName');
    Route::put('/update-project-category-members/{project}','ProjectsGroupController@updateGroup');
    Route::delete('/delete-project-category/{project}','ProjectsGroupController@destroy');

    #Search keyboards from a team by an url with query parameters, ex: /search?team={id}&q={stuff to search}
    Route::get('/search','SearchController@searchbar');
    Route::post('/search-keywords','SearchController@searchQuery');

});


