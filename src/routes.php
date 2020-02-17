<?php

Route::get('/permissions', '\Salyam\CobaltBlue\Controllers\PermissionController@index');
Route::post('/permissions/store', '\Salyam\CobaltBlue\Controllers\PermissionController@store');
Route::post('/permissions/update/{id}', '\Salyam\CobaltBlue\Controllers\PermissionController@update');
Route::post('/permissions/destroy/{id}', '\Salyam\CobaltBlue\Controllers\PermissionController@destroy');

Route::get('/roles', '\Salyam\CobaltBlue\Controllers\RoleController@index');
Route::post('/roles/store', '\Salyam\CobaltBlue\Controllers\RoleController@store');
Route::post('/roles/update/{id}', '\Salyam\CobaltBlue\Controllers\RoleController@update');
Route::post('/roles/destroy/{id}', '\Salyam\CobaltBlue\Controllers\RoleController@destroy');