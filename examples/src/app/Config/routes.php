<?php

use Yasmin\Route;
use Yasmin\Database\Manager;
use Yasmin\Response;

Route::get('/', function() { 
    return new Response('Hello There, it Works !');
});

Route::get('/ruang', '\App\Controllers\SampleController@result');

Route::get('/profil', function() { 
    return new Response('Hello, Profil !');
});