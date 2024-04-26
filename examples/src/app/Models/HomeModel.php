<?php 

namespace App\Models;

use Yasmin\Model;
use Yasmin\Request;
use Yasmin\Database\Manager;

class HomeModel extends Model {

    private $db;

    function __construct(
        private Request $request
    ) {
        $this->db = Manager::get('main');
        $this->db->connect();
    }

    function getName() {
        return 'Rizal';
    }

    function getKelurahan() {
        return $this->db->select([
            'kelurahan.NamaKelurahan',
            'kecamatan.NamaKecamatan'
        ])->leftJoin('kecamatan', 'kecamatan.IdKecamatan = kelurahan.IdKecamatan')->get('kelurahan')->result();
    }

    function countKelurahanByKecamatan() {
        return $this->db->select([
            'kelurahan.IdKecamatan',
            'count(kelurahan.IdKelurahan) AS jmlKelurahan',
            'kecamatan.NamaKecamatan'
        ])->leftJoin('kecamatan', 'kecamatan.IdKecamatan = kelurahan.IdKelurahan')->groupBy(['kelurahan.IdKecamatan', 'kecamatan.NamaKecamatan'])->get('kelurahan')->result();
    }

    function row(array $where) {
        return $this->db->where($where)->get('config')->row();
    }

    function getValue(string $name) {
        $row = $this->row([['name', $name]]);
        return $row->value;
    }

    function setValue(string $name, string $value) {
        $row = $this->row([['name', $name]]);
        if(!$row) {
            return $this->insert([
                'name' => $name,
                'value' => $value
            ]);
        } else {
            return $this->update([['name', $name]], [
                'value' => $value
            ]);
        }
    }

    function lastid() {
        $query = $this->db->query('SELECT @@IDENTITY AS lastid');
        return $query->row()->lastid;
    }

    function insert(Array $data) {
        if($this->db->insert('config', $data)) {
            return $this->lastid();
        }
        return false;
    }

    function update(Array $where, Array $data) {
        return $this->db->where($where)->update('config', $data);
    }

}