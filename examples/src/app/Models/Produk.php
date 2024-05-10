<?php 

namespace App\Models;

use Yasmin\Database\Manager;
use Yasmin\Database\Schema;
use Yasmin\Model;

class Produk extends Model {
    
    private Schema $db;

    function __construct() {
        $this->db = Manager::get('main');
    }

    function row(array $where) {
        return $this->db->where($where)->get("produk")->row();
    }

    function result() {
        return $this->db->get("produk")->result();
    }

    function insert(array $data) {
        if($this->db->insert("produk", $data) !== false) {
            return $this->db->lastId();
        }
        return false;
    }

    function update(array $where, array $data) {
        return $this->db->where($where)->update("produk",$data);
    }

    function delete(array $where){
        return $this->db->where($where)->delete("produk");    
    }
}