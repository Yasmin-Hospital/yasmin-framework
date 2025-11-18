<?php

use Yasmin\Database\Manager;
use Yasmin\Database\Migration;
use Yasmin\Cli;

$mysqlConfig = json_decode(file_get_contents(BASEPATH. '/private/.DBCONFIG_MYSQL'), true);
$mssqlConfig = json_decode(file_get_contents(BASEPATH. '/private/.DBCONFIG_SQLSRV'), true);
// Manager::add('mysql', $mysqlConfig);
// Manager::add('sqlsrv', $mssqlConfig);
Manager::add('main', $mssqlConfig);

Migration::addMigration('main', [BASEPATH. '/app/Migrations']);
// Migration::addMigration('mysql', [BASEPATH.'/app/Migrations/MySQL']); 
// Migration::addMigration('sqlsrv', [BASEPATH.'/app/Migrations/MySQL']);

Cli::register('migrate', Migration::class);