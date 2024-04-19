<?php 

namespace App\Controllers;

use App\Models\RuangModel;
use Yasmin\Exception;
use Yasmin\Response;
use Yasmin\Uri;
use Yasmin\Controller;
use Yasmin\Request;

class SampleController extends Controller {

    function __construct(
        private Uri $uri,
        private RuangModel $ruangModel
    ) { }

    function index() {
        return new Response(json_encode($this->ruangModel->count(), JSON_PRETTY_PRINT));
    }

    function result() {
        return new Response(json_encode($this->ruangModel->result(), JSON_PRETTY_PRINT));
    }
    
    function getHeader(Request $request) {
        return new Response(json_encode($request->header(), JSON_PRETTY_PRINT));
    }
}