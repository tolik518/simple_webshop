<?php
declare(strict_types=1);
namespace webShop;

//$start = microtime();

use Slim\Factory\AppFactory;

// Directories
const DR = DIRECTORY_SEPARATOR;
define('ROOT',    dirname(__DIR__)   . DR);
define('APP',           ROOT  . 'src'     . DR);
define('VENDOR',        ROOT  . 'vendor'  . DR);
define('HTML',          ROOT  . 'html'    . DR);
define('DATABASE',       APP  . 'database'. DR);
define('PUBLICFOLDER',  ROOT  . 'public'  . DR);
define('TRANSLATION',   PUBLICFOLDER  . 'translation_files'. DR);
define('PRODUCTIMAGES',   PUBLICFOLDER .
                           DR . 'assets'  .
                           DR . 'img'     .
                           DR . 'product' . DR);

require_once VENDOR.'autoload.php';

//Programm
session_start();
$mySQLConnector = new MySQLConnector();

//setcookie("currency","CNY");

$app = AppFactory::create();
$factory = new Factory();

$factory->createApplication($mySQLConnector)->start($app);

$app->run();

//var_dump(microtime()-$start);
