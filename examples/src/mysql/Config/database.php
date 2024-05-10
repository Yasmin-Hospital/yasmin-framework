<?php

$mysqlConfig = json_decode(file_get_contents(BASEPATH. '/../private/.DBCONFIG_MYSQL'), true);
Yasmin\Database\Manager::add('main', $mysqlConfig);
Yasmin\Database\Migration::addMigration('main', BASEPATH.'/Migrations');
Yasmin\Cli::register('migrate', Yasmin\Database\Migration::class);