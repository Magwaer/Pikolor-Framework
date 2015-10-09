<?php
/**
 * Pikolor Engine - by Pikolor
 *
 * @package		Pikolor Custom CMS
 * @author		Buzco Stanislav
 * @copyright	Copyright (c) 2008 - 2014, Pikolor
 * @link		http://pikolor.com
 * @ Version : 1
 * @index
 */

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
{
	define('ENGINE_PATH', ROOT . DS . 'engine' . DS );
}

if (!defined('APP_PATH'))
{
	define('APP_PATH', ROOT . DS . 'app' . DS );
}

require_once(ENGINE_PATH . 'core' . DS . "Class.Core.php");

$pikolor = new pikolor_core();
