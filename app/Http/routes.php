<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'custom.auth'], function () {

  Route::get('headers', ['as' => 'header::all', 'uses' => 'ServiceItemController@getAll']);

  Route::group(['prefix' => 'headers/{id}', 'as'=> 'header'], function () {
    Route::get('/', ['as' => '::get', 'uses' => 'ServiceItemController@get']);
    Route::get('report', ['as' => '::getReport', 'uses' => 'ServiceItemController@getReport']);
    Route::get('resume', ['as' => '::getResume', 'uses' => 'ServiceItemController@getResume']);
    Route::post('validate', ['as' => '::postValidate', 'uses' => 'ServiceItemController@postValidate']);
    Route::get('interventions', ['as' => '::getIntervention', 'uses' => 'ServiceItemController@getIntervention']);
    Route::post('interventions', ['as' => '::addIntervention', 'uses' => 'ServiceItemController@addIntervention']);
    Route::post('interventions/{intervId}', ['as' => '::deleteIntervention', 'uses' => 'ServiceItemController@deleteIntervention']);
  });

  Route::group(['prefix' => 'header/{headerId}/lines/{resId}', 'as' => 'header::lines'], function () {
    Route::get('/', ['as' => '::get', 'uses' => 'ServiceLineController@get']);
    Route::post('/', ['as' => '::post', 'uses' => 'ServiceLineController@post']);
    Route::post('comment', ['as' => '::addComment', 'uses' => 'ServiceLineController@addComment']);
    Route::get('fluid', ['as' => '::fluid', 'uses' => 'ServiceLineController@getFluid']);
    Route::post('fluid', ['as' => '::fluid', 'uses' => 'ServiceLineController@postFluid']);
    Route::post('mailing', ['as' => '::sendMail', 'uses' => 'ServiceLineController@sendMail']);
  });

  Route::group(['prefix' => 'users', 'as' => 'user'], function () {
    Route::get('/profile', ['as' => '::getProfile', 'uses' => 'UserController@getProfile']);
    Route::post('/profile', ['as' => '::postProfile', 'uses' => 'UserController@postProfile']);
    Route::get('/logout', ['as' => '::logout', 'uses' => 'UserController@logout']);
    Route::get('/signature', ['as' => '::signature', 'uses' => 'UserController@signature']);
    Route::post('/signature', ['as' => '::postSignature', 'uses' => 'UserController@postSignature']);
  });

  Route::group(['prefix' => 'api', 'as' => 'api'], function () {
    Route::get('/items', ['as' => '::getItem', 'uses' => 'ItemController@get']);
    Route::get('/resources', ['as' => '::getResource', 'uses' => 'ResourceControllger@get']);
  });
});

Route::get('/users/login',  ['as' => 'user::login', 'uses' => 'UserController@login']);
Route::post('/users/login', ['as' => 'user::doLogin', 'uses' => 'UserController@doLogin']);

//404 redirection
Route::any('{all}', function($uri)
{
  $messages = [];
  $messages[]='Page introuvable, retour à la liste des commandes...';
  return Redirect::route('header::all')->with(['error' => false, 'messages' =>$messages]);;
})->where('all', '.*');
