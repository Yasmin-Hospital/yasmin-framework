<?php

$mysqlConfig = json_decode(file_get_contents(BASEPATH. '/private/.DBCONFIG_MYSQL'), true);
Yasmin\Database\Manager::add('mysql', $mysqlConfig);
Yasmin\Database\Migration::addMigration('mysql', BASEPATH.'/app/Migrations/MySQL');
Yasmin\Cli::register('migrate', Yasmin\Database\Migration::class);