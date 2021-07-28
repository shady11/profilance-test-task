<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('index');
Route::post('/shorten-link', 'IndexController@shortenLink')->name('shorten-link');
