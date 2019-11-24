<?php

Route::resource('/', 'SifaController')->middleware('auth');;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
