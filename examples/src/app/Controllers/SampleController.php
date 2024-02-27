<?php 

namespace App\Controllers;

use App\Models\Ruang;
use Yasmin\Response;
use Yasmin\Uri;
use Yasmin\Controller;

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
    
}