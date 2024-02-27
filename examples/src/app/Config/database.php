<?php

use Yasmin\Database\Manager;

$dbConfigFile = BASEPATH.'/private/.DBCONFIG';
$dbConfig = json_decode(file_get_contents($dbConfigFile), true);
Manager::add('main', $dbConfig);