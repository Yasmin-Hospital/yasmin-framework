<?php 

namespace App\Controllers;

use App\Models\Ruang;
use Yasmin\Exception;
use Yasmin\Response;
use Yasmin\Uri;
use Yasmin\Controller;
use Yasmin\Request;

class SampleController extends Controller {

    function __construct(
        private Uri $uri,
        private Ruang $ruang
    ) { }

    function index() {
        return new Response(json_encode($this->ruang->count(), JSON_PRETTY_PRINT));
    }

    function result() {
        return new Response(json_encode($this->ruang->result(), JSON_PRETTY_PRINT));
    }
    
    function getHeader(Request $request) {
        var_dump($request->header());
        // throw new Exception('Exception works', 'sample/exception-test', 403);
        // return new Response(json_encode($request->header(), JSON_PRETTY_PRINT));
    }
}