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
        $ruang = $db->query('exec Pr_TampilRuang \'RAWAT INAP\', \'RAWATINAP\''); 
        // $ruang = $db->query('select nama, namakelas from vruangkelas where jenisruang=\'RAWATINAP\''); 
        // $db->order(['nama' => 'ASC'])->limit(10)->select(['nama','jenisruang'])
        //         ->where([['jenisruang', '=', 'RAWATINAP'], ['kodekelas','=','RI-VB']])->get('ruang');
        return new Response(json_encode(['data' => $ruang->result()], JSON_PRETTY_PRINT));
    }

    function allroom(){
        $db = Manager::get('main');
        $allroom = $db->query('select * from masteruser ');
        return new Response(json_encode(['data' => $allroom->result()], JSON_PRETTY_PRINT));

    }

}
Route::get('/allroom', 'MainController@allroom');
Route::get('/ruang', '\\App\\Controllers\\HomeController@getRuang');
Route::get('/', 'MainController@index');
// Route::get('/{idPoliklinik}', 'MainController@index');
// Route::get('/{idPoliklinik}', 'MainController@index');
// Route::get('/', 'MainController@index');
