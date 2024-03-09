<?php

namespace App\Models;

use Yasmin\Model;
use Yasmin\Database\Manager;

class Ruang extends Model {

    private $db;

    function __construct() {
        $this->db = Manager::get('main');
        $this->db->connect();
    }

    function count() {
        return $this->db->select('COUNT(idRuang) as jmlRuang')->get('ruang')->row()->jmlRuang;
    }

    function result() {
        return $this->db->get('ruang')->result();
    }

}