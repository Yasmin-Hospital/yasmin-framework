<?php 

return function ($schema, $direction) {

  if($direction == 'up') :
    $schema->create('dokter', [
        'idDokter' => 'INT IDENTITY(1,1) NOT NULL',
        'idPoliklinik' => 'INT NOT NULL',
        'nmDokter' => 'VARCHAR(150)',
        'foto' => 'TEXT',
        'kodeDokter' => 'VARCHAR(7)',
        'status' => 'BIT'
    ]);
  endif;

  if($direction == 'down') :
    $schema->drop('dokter');
  endif;

};