<?php session_start(); ?>
<?php
//FRONT CONTROLLER

//Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Vladivostok');

//Подключение файлов системы
define('ROOT',dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php'); //автоозагрузка классов
//require_once(ROOT.'/components/Router.php');
//require_once(ROOT.'/components/Db.php');

//Вызов Router
$router = new Router();
$router->run();

?>