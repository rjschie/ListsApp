<?php

define("DS", DIRECTORY_SEPARATOR);
define("HOME", realpath(dirname(dirname(__FILE__))));
define("APP", HOME . '/application' );



$deploy = false;

if( $deploy ) {
	define("__DEVMODE__", false);
	define("PUBLIC_HTML", 'http://ryanschie.com/listsapp/');
	error_reporting(0);
	ini_set("display_errors", 0);
} else {
	define("__DEVMODE__", true);
	define("PUBLIC_HTML", 'http://localhost/creations/listsapp/');
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}
unset($deploy);

session_start();

require_once(HOME . '/library/' . 'config.php');
require_once(HOME . '/library/' . 'bootstrap.php');

function __autoload($class)
{
	if( file_exists( HOME . '/library/' . strtolower( $class ) . '.php' ))
		require_once( HOME . '/library/' . strtolower( $class ) . '.php' );
	elseif( file_exists( APP . '/models/' . strtolower( $class ) . '.php' ) )
		require_once( APP . '/models/' . strtolower( $class ) . '.php' );
	elseif( file_exists( APP . '/controllers/' . strtolower( $class ) . '.php' ) )
		require_once( APP . '/controllers/' . strtolower( $class ) . '.php' );
}
