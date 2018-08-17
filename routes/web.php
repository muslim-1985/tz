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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/geodata', 'PlaceController@index')->name('geodata');
    Route::get('/tables', 'HomeController@tables')->name('tables');
    Route::post('/storeGeoData', 'PlaceController@storeGeoData')->name('store');
    Route::delete('/delgeodata/{id}', 'PlaceController@destroyGeoData')->name('destroy');
    Route::get('/editgeodata/{id}', 'PlaceController@editGeoData')->name('edit');
    Route::post('/updategeodata/{id}', 'PlaceController@updateGeoData')->name('update');
    Route::get('/sortData', 'PlaceController@sortGeoData')->name('sort');
});

