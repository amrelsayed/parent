<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function() {
	Route::get('/add-users-data', 'UsersController@addData');
	Route::get('/users', 'UsersController@index');
});

