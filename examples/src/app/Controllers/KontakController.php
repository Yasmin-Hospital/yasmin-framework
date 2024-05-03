<?php 

namespace App\Controllers;

use Yasmin\Controller;
use App\Models\Kontak;

class KontakController extends Controller {

    function __construct(
        private Kontak $Kontak
    ) { }

    function result() {
        $data = $this->Kontak->result();
        return jsonResponse($data);
    }

    function row() {

    }

}