<?php 

require 'vendor/autoload.php';

use Yasmin\Response;
use Yasmin\Route;
use Yasmin\Framework;
use Yasmin\Database\Manager;

Manager::add('main', [
    'driver' => 'sqlsrv',
    'host' => 'WAJEK-LAPTOP',
    'username' => 'root',
    'password' => 'RDF?jq8eec',
    'database' => 'ifrs',
    'TrustServerCertificate' => 1
]);

Route::get('/', function() { 
    $db = Manager::get('main');
    $db->connect();
    $result = $db
        ->select(['idPengguna', 'username'])
        ->get('pengguna')->result();
    return new Response(json_encode($result));
});

Route::get('/profil', function() { 
    return new Response('Hello, Profil !');
});

Framework::run();