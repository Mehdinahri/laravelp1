<?php

use Illuminate\Support\Facades\Route;
use APP\Http\Controllers\Auth\CustemAuthController;
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
Route::get('mini', function () {
    return 'your age is les than 15 yo';
})->name('mini');
Route::resource('commande', 'CommandeController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes(['verify'=> true]);


Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');

Route::get('/fillable', 'CrudController@getOffers');




    
Route::group([
    'prefix'=>LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],function(){
        Route::group(['prefix'=>'commands'],function(){   

            Route::get('create', 'CrudController@create');
            //Route::get('store', 'CrudController@store');
            Route::get('index', 'CrudController@getall')->name('command.index');

            Route::get('edit/{cmd_id}', 'CrudController@editcmd');
            Route::get('delete/{cmd_id}', 'CrudController@deletecmd')->name('command.delete');
            Route::post('update/{cmd_id}', 'CrudController@updatecmd')->name('commands.update');

            Route::post('store', 'CrudController@store')->name('commands.store');

        });
        Route::get('youtube', 'CrudController@getvideo')->middleware('auth');
});

////// ajax rout

Route::group(['prefix'=>'ajax-commands'],function(){

    Route::get('create', 'CommandController@create');
    Route::post('store', 'CommandController@store')->name('ajax-command.store');
    Route::get('index', 'CommandController@getall')->name('ajax-command.index');;
    Route::post('delete', 'CommandController@deletecmd')->name('ajax-command.delete');
    Route::get('edit/{cmd_id}', 'CommandController@editcmd')->name('ajax-command.edit');
    Route::post('update', 'CommandController@updatecmd')->name('ajax-command.update');

});



////// end ajax rout
/////// authentication et guards
Route::group(['middleware'=>'CheckAge','namespace' => 'Auth'],function(){
    Route::get('/adults', 'CustemAuthController@adolt')->name('adults');
});

Route::get('site', 'Auth\CustemAuthController@getsite')->middleware('auth:web')->name('site');

Route::get('admin', 'Auth\CustemAuthController@getadmin')->middleware('auth:admin')->name('admin');
Route::get('admin/login', 'Auth\CustemAuthController@adminLogin')->name('admin.login');
Route::post('admin/login', 'Auth\CustemAuthController@chackAdmin')->name('save.admin.login');
/////// fin authentication et guards


/////// relations one to one root

 Route::get('has-one', 'RelationsController@hasOne');
 Route::get('has-one-reverse', 'RelationsController@Reverse');
 Route::get('user-phone', 'RelationsController@hasPhone');
 Route::get('user-notphone', 'RelationsController@nothasPhone');

 /////// relations one to many root
 Route::get('hopital-has-many', 'RelationsController@getD');
 Route::get('doctors/{hospital_id}', 'RelationsController@getDoctors')->name('hos.doctors');
 Route::get('hopital', 'RelationsController@getHopitals')->name('all.hopitals');
 Route::get('hopital-has-doctors', 'RelationsController@Hopitalshasdoctors');
 Route::get('hopital-has-doctors-male', 'RelationsController@Hopitalshasdoctorsmale');
 Route::get('hopital-hasnot-doctors', 'RelationsController@Hopitalsnotdoctors');
 Route::get('delete-hopital/{hospital_id}', 'RelationsController@deletehos')->name('delete.hos');

 /////// relations many to many root
 Route::get('doctor-services', 'RelationsController@doctorservices');
 Route::get('doctor-where-services', 'RelationsController@doctorwhereservices');
 Route::get('doc-services/{doctor_id}', 'RelationsController@docservices')->name('Services.doc');
 Route::post('save-service', 'RelationsController@saveservicetodoctor')->name('add.service');
 ///////// has One Throuh
 Route::get('HasOneThrouh-Patien', 'RelationsController@getpetiendoctor');


/////// end relations root

