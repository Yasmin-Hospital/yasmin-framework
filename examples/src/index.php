<?php 
use Yasmin\Framework;

require 'vendor/autoload.php';
define('BASEPATH', __DIR__);

date_default_timezone_set('Asia/Jakarta');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization, authorization");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PATCH, DELETE");

require BASEPATH.'/app/Config/routes.php';
require BASEPATH.'/app/Config/database.php';

Framework::run();