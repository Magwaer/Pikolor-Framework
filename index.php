<?php
/*
* Pikolor Engine - by Pikolor Lab
*
* @package		Pikolor Engine
* @author		Pikolor Lab
* @copyright	Copyright (c) 2008 - 2016, Pikolor Lab
* @link		http://pikolor.com
* @ Version : 2 Beta
* @index
*/

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

session_start();
$_SESSION['time_start_script'] = microtime(true);

if (!defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);

if (!defined('ROOT'))
	define('ROOT', dirname(__FILE__));

if (!defined('ADR'))
{
	$adr=str_replace("/index.php" , "" ,$_SERVER['PHP_SELF']);
	define('ADR', $adr);
}

if (!defined('ENGINE_PATH'))
	define('ENGINE_PATH', ROOT . DS . 'engine' . DS );

if (!defined('ADMIN_PATH'))
	define('ADMIN_PATH', ROOT . DS . 'admin' . DS );

require_once(ENGINE_PATH . 'core' . DS . "Core.php");

$pikolor = new pikolor_core();
$pikolor->init_core();