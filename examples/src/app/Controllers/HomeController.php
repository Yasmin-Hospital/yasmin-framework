<?php 

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\RuangModel;
use Yasmin\Response;
use Yasmin\Uri;
use Yasmin\Controller;

class HomeController extends Controller {

    function __construct(
        private Uri $uri
    ) { }

    function index(HomeModel $homeModel) {
        return new Response(json_encode([
            'name' => $homeModel->getName(),
            'baseUrl' => $this->uri->baseUrl(),
            'currentUrl' => $this->uri->currentUrl(),
            'currentUri' => $this->uri->string(),
            'segments' => $this->uri->segments()
        ], JSON_PRETTY_PRINT));
    }

    function getRuang(RuangModel $ruangModel) {
        $ruang = $ruangModel->getRuangAvailable();
        return new Response(json_encode([
            'data' => $ruang
        ], JSON_PRETTY_PRINT));
    }
    
}