<?php 

namespace App\Models;

use Yasmin\Model;
use Yasmin\Request;

class HomeModel extends Model {

    function __construct(
        private Request $request
    ) { }

    function getName() {
        return 'Rizal';
    }

}