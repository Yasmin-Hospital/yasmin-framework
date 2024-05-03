<?php 

namespace App\Controllers;

use Yasmin\Controller;
use App\Models\Grup;

class GrupController extends Controller {

    function __construct(
        private Grup $Grup
    ) { }

    function result() {
        $data = $this->Grup->result();
        return jsonResponse($data);
    }

    function row() {

    }

}