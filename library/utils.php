<?php

class Utils {

	public static function cleanEcho( $data )
	{
		$data = htmlspecialchars( $data, ENT_QUOTES );
		$data = strip_tags( $data );
		$data = nl2br( $data );

		return $data;
	}

	public static function filtErrMsg( $msg, $e )
	{
		if( __DEVMODE__ ) {
			return "Application Error: " . $e->getMessage();
		} else {
			return "[".$e->getCode()."]: ".$msg;
		}
	}

	public static function setCSRFToken($action)
	{
		$salt = "AS_funsiestime";
		$time = ceil( time() / 86400 ); // Default: 86400 (1 day)
		$hash = hash_hmac( 'md5', ($action . session_id() . $time), $salt );
		$hash = substr( $hash, 0, 12 );

		$_SESSION[$action.'_csrf_token'] = $hash;
		return $hash;
	}

	public static function verifyCSRFToken( $token, $action )
	{
//		$salt = "AS_funsiestime";
//		$time = ceil( time() / 3600 ); // 1 hour
//		$hash = hash_hmac( 'md5', ($action . session_id() . $time), $salt );
//		$hash = substr( $hash, 0, 12 );

//		if( $hash == $token ) {  // Did this for timeout tokens
		if( isset($_SESSION[$action.'_csrf_token']) && $_SESSION[$action.'_csrf_token'] == $token ) {
			return true;
		}

		return false;
	}

}