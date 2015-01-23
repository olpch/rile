<?php


date_default_timezone_set('America/Bogota');
$serverip = strlen($_SERVER['SERVER_ADDR'])>7 ? $_SERVER['SERVER_ADDR'] : 'localhost';

define('BASE_URL', 'http://'.$serverip.'/RILE/');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'default');

define('SESSION_TIME', 15);
define('HASH_KEY', '52e5c95991095');

//companiy info
define('APP_NAME', 'Mi Framework');
define('APP_SLOGAN', 'Bussines application web');
define('APP_COMPANY', 'www.blackcore.com');

//Database
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','123456');
define('DB_NAME','practica_bd');
define('DB_CHAR','utf8');