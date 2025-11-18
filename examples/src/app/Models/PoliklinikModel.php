<?php

namespace App\Models;
use Yasmin\Database\Manager;

class PoliklinikModel {

    private $db;

    function __construct() {
        $this->db = Manager::get('main');
    }

    function count($where = [], $orWhere = []) {
        return $this->db->select('COUNT(poliklinik.idPoliklinik) as jmlPoliklinik')
            ->where($where)->orWhere($orWhere)
            ->get('poliklinik')->row()->jmlPoliklinik;
    }

    function result($where = [], $orWhere = [], $order = [], $limit = -1, $offset = 0) {
        if($limit > -1) {
            $this->db->limit($limit)->offset($offset);
        }
        return $this->db->where($where)->orWhere($orWhere)
            ->order($order)->get('poliklinik')->result();
    }

    function row($where) {
        return $this->db->where($where)->get('poliklinik')->row();
    }

    function insert($data) {
        $insert = $this->db->insert('poliklinik', $data);
        if($insert === true) {
            return $this->db->lastid();
        }
        return false;
    }

    function update($where, $data) {
        return $this->db->where($where)->update('poliklinik', $data);
    }

    function delete($where) {
        return $this->db->where($where)->delete('poliklinik');
    }

}