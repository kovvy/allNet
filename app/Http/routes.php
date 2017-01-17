<?php




Route::resource('/providers', 'ProviderController');
Route::resource('/cities', 'CityController');
Route::resource('/services', 'ServiceController');
Route::resource('/connection', 'ConnectionController');
Route::resource('/tarifs', 'TarifController');
Route::resource('/reviews', 'ReviewController');