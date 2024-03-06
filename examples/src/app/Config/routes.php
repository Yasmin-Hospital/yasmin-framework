<?php

use Yasmin\Database\Manager;
use Yasmin\Route;
use Yasmin\Response;

Route::get('/', function() { 
    var_dump(Manager::get('main')->error());
    return new Response('Hello there, it works !');
});
