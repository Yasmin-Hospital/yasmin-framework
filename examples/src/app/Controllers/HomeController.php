<?php 

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\RuangModel;
use Yasmin\Response;
use Yasmin\Uri;
use Yasmin\Controller;
use Yasmin\Request;
use Yasmin\Exception;

class HomeController extends Controller {

    function __construct(
        private Uri $uri,
        private HomeModel $homeModel
    ) { }

    function rowException(string $name) {
        $data = $this->homeModel->row([['name', $name]]);
        if(!$data) {
            throw new Exception('Config not found', 'home/not-found', 404);
        }
        return $data;
    }

    function index() {
        return new Response(json_encode([
            'name' => $this->homeModel->getName(),
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

    function getKelurahan() {
        $kelurahan = $this->homeModel->countKelurahanByKecamatan();
        return new Response(json_encode([
            'data' => $kelurahan
        ], JSON_PRETTY_PRINT));
    }

    function setValue(Request $request, HomeModel $homeModel) {
        $name = $request->get('name');
        if($name != null) {
            $config = $this->rowException($name);
        }
        $data = json_decode($request->raw(), true);     
    }
    
}