<?php 

namespace App\Models;

use Yasmin\Model;
use Yasmin\Database\Manager;

class Kontak extends Model {

    private $db;

    function __construct() {
        $this->db = Manager::get('main');
    }

    function result() {
        return $this->db->get('kontak')->result();
    }

    function row($where) {
        return $this->db->where($where)
            ->get('kontak')->row();
    }

}