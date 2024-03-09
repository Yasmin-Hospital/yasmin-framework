<?php

use Yasmin\Database\Manager;
use Yasmin\Route;
use Yasmin\Response;
use Yasmin\Exception;

class MainController {

    function index() {
        // $db = Manager::get('main');
        // $update = $db->where([
        //     ['idPoliklinik', $idPoliklinik]
        // ])->update('poliklinik', [
        //     'nmPoliklinik' => 'Bedah'
        // ]);
        return new Response('Hello there, it works !');
    }

}

Route::get('/', 'MainController@index');