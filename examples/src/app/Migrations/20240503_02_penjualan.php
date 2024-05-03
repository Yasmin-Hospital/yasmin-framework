<?php 

use Yasmin\Database\Schema;

return function (Schema $schema, $direction) {

    if($direction == 'up') :
        $schema->addColumn('penjualan', 'INT NOT NULL DEFAULT 0')->alter('kontak');
    endif;

    if($direction == 'down') :
        $schema->dropColumn('penjualan')->alter('kontak');
    endif;

};