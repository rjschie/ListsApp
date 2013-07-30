<?php

$controller = "Index";
$action = "index";
$query = array();

if( isset($_GET['r']) ) {
	$params = array();
	$params = explode( '/', $_GET['r'] );

	$controller = ucwords( $params[0] );
	array_shift( $params );

	if( isset($params[0]) && !empty($params[0]) ) {
		$action = $params[0];
		array_shift( $params );
	}

	if( !empty($params) ) {
		$query = $params;
	}
}

$modelName = $controller;
$controller .= 'Controller';
$load = new $controller($modelName, $action);

if( method_exists( $load, $action ) ) {
	call_user_func( array( $load, $action ), $query );
} else {
	die( 'Invalid action. Please check URL.' ); // ERROR create proper error
}