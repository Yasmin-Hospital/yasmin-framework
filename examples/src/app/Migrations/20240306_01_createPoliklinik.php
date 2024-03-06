<?php 

return function($schema, $direction) {

    if($direction == 'up') :
        $schema->create('poliklinik', [
            'idPoliklinik' => 'INT IDENTITY(1,1) NOT NULL',
            'nmPoliklinik' => 'VARCHAR(150) NULL',
            'deskripsi' => 'TEXT',
            'icon' => 'TEXT',
            'banner' => 'TEXT',
            'idRuang' => 'INT',
            'aktif' => 'BIT'
        ]);
    endif;

    if($direction == 'down') :
        $schema->drop('poliklinik');
    endif;
    
};