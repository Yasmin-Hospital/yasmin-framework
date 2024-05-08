<?php 

namespace App\Models;

use Yasmin\Database\Manager;
use Yasmin\Database\Schema;

use Yasmin\Model;

class Grup extends Model {

    private Schema $db;

    function __construct() {
        $this->db = Manager::get('main');    
    }

    function result($where = []) {
        $a = $this->db->select([
            'grup.idGrup',
            'COUNT(kontak.idKontak) AS jmlKontak',
            'SUM(kontak.penjualan) AS penjualan'
        ])
        ->leftJoin('kontak', 'kontak.idGrup = grup.idGrup')
        ->where(['kontak.idKontak NOT IN (1, 4)'])
        ->groupBy(['grup.idGrup'])
        ->getSql('grup');

        return $this->db->select([
            'grup.*',
            'a.jmlKontak',
            'a.penjualan'
        ])
        ->innerJoin('('.$a.') a', 'grup.idGrup = a.idGrup')
        ->where($where)
        ->get('grup')->result();
    }

    function row($where) {
        return $this->db->where($where)->get('grup')->row();
    }

}