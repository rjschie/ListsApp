<?php

$controller = "index";
$action = "index";
$query = array();

if( isset($_GET['load']) ) {
	$params = array();
	$params = explode( '/', $_GET['load'] );

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
	call_user_func_array( array( $load, $action ), $query );
} else {
	die( 'Invalid method. Please check URL.' );
}
