<?php 

namespace App\Models;

use Yasmin\Database\Manager;
use Yasmin\Database\Schema;

class Kontak {

    private Schema $db;

    function __construct() {
        $this->db = Manager::get('main');
    }

    function count(Array $where = [], Array $orWhere = []) {
        return $this->db->select(['COUNT(kontak.idKontak) as jmlKontak'])
            ->where($where)->orWhere($orWhere)
            ->get('kontak')->row()->jmlKontak;
    }

    function result(Array $where = [], Array $orWhere, Array $order = [], int $limit = -1, int $offset = 0) {
        if($limit > -1) {
            $this->db->limit($limit)->offset($offset);
        }
        
        return $this->db->select([
            'kontak.*'
        ])
            ->where($where)->orWhere($orWhere)
            ->get('kontak')->result();
    }

    function row($where) {
        return $this->db->where($where)
            ->get('kontak')->row();
    }

    function lastid() {
        $query = $this->db->query('SELECT @@IDENTITY AS lastid');
        return $query->row()->lastid;
    }

    function insert(Array $data) {
        if($this->db->insert('kontak', $data)) {
            return $this->lastid();
        }
        return false;
    }

    function update(Array $where, Array $data) {
        return $this->db->where($where)->update('kontak', $data);
    }

    function delete(Array $where) {
        return $this->db->where($where)->delete('kontak');
    }

}