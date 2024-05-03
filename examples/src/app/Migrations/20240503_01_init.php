<?php

use Yasmin\Database\Schema;

return function (Schema $schema, $direction) {

    if($direction == 'up') :
        $schema->create('grup', [
            'idGrup' => 'INT IDENTITY(1,1) PRIMARY KEY',
            'nmGrup' => 'VARCHAR(150)'
        ]);

        $schema->create('kontak', [
            'idKontak' => 'INT IDENTITY(1,1) PRIMARY KEY',
            'nmKontak' => 'VARCHAR(150)',
            'idGrup' => 'INT'
        ]);
    endif;

    if($direction == 'down') :
        $schema->drop('kontak');
        $schema->drop('grup');
    endif;

};