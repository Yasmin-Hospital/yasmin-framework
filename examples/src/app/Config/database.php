<?php

use Yasmin\Database\Manager;
use Yasmin\Database\Migration;
use Yasmin\Cli;

$dbConfigFile = BASEPATH.'/private/.DBCONFIG';
$dbConfig = json_decode(file_get_contents($dbConfigFile), true);
Manager::add('main', $dbConfig);

Migration::addMigration('main', BASEPATH.'/app/Migrations');
Cli::register('migrate', Migration::class);