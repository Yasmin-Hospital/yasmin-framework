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

    function welcome() {
        return new Response('Routes work');
    }

    function getRuang() {
        $db = Manager::get('main');
        $ruang = $db->order(['nama' => 'ASC'])->limit(10)->get('ruang');
        return new Response(json_encode(['data' => $ruang->result()], JSON_PRETTY_PRINT));
    }

    function allroom(){
        $db = Manager::get('main');
        $allroom = $db->query('select * from masteruser ');


        return new Response(json_encode(['data' => $allroom->result()], JSON_PRETTY_PRINT));

    }

}
Route::get('/allroom', 'MainController@allroom');

//Route::get('/ruang', 'MainController@getRuang');
// Route::get('/{idPoliklinik}', 'MainController@index');
// Route::get('/', 'MainController@index');
