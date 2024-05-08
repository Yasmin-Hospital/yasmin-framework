<?php

use Yasmin\Response;
use Yasmin\Route;

Route::get('/', function () {
    return new Response('Hello World !');
});

Route::get('/kontak', '\\App\\Controllers\\KontakController@result');
Route::get('/kontak/{idKontak}', '\\App\\Controllers\\KontakController@row');
Route::post('/kontak', '\\App\\Controllers\\KontakController@insert');
Route::patch('/kontak/{idKontak}', '\\App\\Controllers\\KontakController@update');
Route::delete('/kontak/{idKontak}', '\\App\\Controllers\\KontakController@delete');

Route::get('/grup', '\\App\\Controllers\\GrupController@result');