<?php

//include_once("C:/Web/http/__repository/php/console/phpConsole.php");
//PHPConsole::start();

define("DS", DIRECTORY_SEPARATOR);
define("HOME", realpath(dirname(dirname(__FILE__))));
define("APP", HOME . DS . 'application' );

$url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$url = substr( $url, 0, strrpos($url, '/') );
$url = substr( $url, 0, strrpos( $url, '/' ) + 1 );
define("PUBLIC_HTML", $url);
unset($url);

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

require_once(HOME . DS . 'library' . DS . 'config.php');
require_once(HOME . DS . 'library' . DS . 'bootstrap.php');


function __autoload($class)
{
	if( file_exists( HOME . DS . 'library' . DS . strtolower( $class ) . '.php' ))
		require_once( HOME . DS . 'library' . DS . strtolower( $class ) . '.php' );
	elseif( file_exists( APP . DS . 'models' . DS . strtolower( $class ) . '.php' ) )
		require_once( APP . DS . 'models' . DS . strtolower( $class ) . '.php' );
	elseif( file_exists( APP . DS . 'controllers' . DS . strtolower( $class ) . '.php' ) )
		require_once( APP . DS . 'controllers' . DS . strtolower( $class ) . '.php' );
}

//return;