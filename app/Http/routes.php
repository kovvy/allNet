<?php


//Route::auth();

Route::get('/', ['as' => 'home', 'uses' => 'InternetControllers\MainController@index']);

Route::group(['prefix' => 'internet'], function() {
    Route::get('', ['as' => 'allCity', 'uses' => 'MainController@allCityProviders']);
    Route::get('{city}', ['as' => 'city', 'uses' => 'MainController@cityProviders']);
    Route::get('{city}/{provider_name}', ['as' => 'provider', 'uses' => 'MainController@provider']);

    Route::post('search', ['as' => 'search', 'uses' => 'MainController@searchProviders']);

});

Route::resource('/providers', 'ProviderController');
Route::resource('/cities', 'CityController');
Route::resource('/services', 'ServiceController');
Route::resource('/connection', 'ConnectionController');
Route::resource('/tarifs', 'TarifController');
Route::resource('/reviews', 'ReviewController');