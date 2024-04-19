<?php

namespace App\Models;

use Yasmin\Model;
use Yasmin\Database\Manager;

class RuangModel extends Model {

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

    function getRuangAvailable() {
        return $this->db->query(
            'select ruang.KodeKelas, kelas.NamaKelas, ruang.jenisruang, count(ruang.kodekelas) as kapasitas, kelas.Urut
            ,COUNT(case when ruang.IsIsi=0 then 1 else null end) as tersedia
            ,COUNT(case when ruang.IsProsesPulang=1 then 0 else null end) as prosesPulang
            ,(case when ruang.KelompokRuang=\'ANAK\' then \'ANAK\' else \'\' end) as kelompok
    
            from ruang
            inner join Kelas on ruang.KodeKelas = Kelas.KodeKelas
            where ruang.KodeKelas not IN (\'NOKLS\') 
    
            AND 
            ruang.kelompokruang in (\'()\',\'anak\')
            and
            ruang.IsAktif=1
            and
            kelas.IsAktif=1
            and ruang.JenisRuang = \'RAWATINAP\'
    
            and ruang.GrupRuang = \'RAWAT INAP\'
    
    
            group by ruang.KodeKelas, kelas.Namakelas, ruang.JenisRuang, ruang.kelompokruang, Kelas.Urut
    
            UNION ALL
    
            select kodekelas=\'PERIN\', namakelas=\'PERIN\', ruang.jenisruang,  count(ruang.JenisRuang) as kapasitas, urut=10
            ,COUNT(case when ruang.IsIsi=0 then 1 else null end) as tersedia
            ,COUNT(case when ruang.IsProsesPulang=1 then 1 else null end) as prosesPulang
            ,(case when ruang.KelompokRuang=\'ANAK\' then \'ANAK\' else \'\' end) as kelompok
            from ruang
            inner join Kelas on ruang.KodeKelas = Kelas.KodeKelas
            where ruang.KodeKelas not IN (\'NOKLS\') 
            AND 
            ruang.kelompokruang in (\'()\',\'anak\')
            AND 
            ruang.IsAktif=1
            and ruang.JenisRuang = \'PERIN\'
    
            and ruang.GrupRuang = \'RAWAT INAP\'
    
            group by jenisruang, ruang.kelompokruang
            order by Urut'
        )->result();
    }

}