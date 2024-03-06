<?php 

use Yasmin\Database\Schema;


return function (Schema $schema, $direction) {

  if($direction == 'up') :
    $schema->create('transaksi', [
        'idTransaksi' => 'INT IDENTITY(1,1) NOT NULL',
        'tglTransaksi' => 'DATETIME',
        'noRM' => 'VARCHAR(15)',
        'noHP' => 'VARCHAR(50)',
        'kategoriPasien' => 'VARCHAR(15)',
        'idPoliklinik' => 'INT',
        'idDokter' => 'INT',
        'tglPeriksa' => 'DATETIME',
        'idJadwalDokter' => 'INT',
        'harga' => 'MONEY',
        'metodePembayaran' => 'VARCHAR(50)',
        'statusPembayaran' => 'VARCHAR(50)',
        'idRegister' => 'INT'
    ]);
  endif;

  if($direction == 'down') :
    $schema->drop('transaksi');
  endif;

};