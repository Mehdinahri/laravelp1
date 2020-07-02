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
Route::resource('commande', 'CommandeController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes(['verify'=> true]);


Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');

Route::get('/fillable', 'CrudController@getOffers');


    //Route::get('store', 'CrudController@store');
Route::group([
    'prefix'=>LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],function(){
    Route::group(['prefix'=>'commands'],function(){        
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('commands.store');

    });
});


