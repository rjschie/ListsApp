<?php

class Template
{
	protected $_file;
	protected $_data = array();
	public $errors = array();
	public $json = array();

	public function __construct($file)
	{
		$this->_file = $file;
	}

	public function __set($key, $value)
	{
		$this->_data[$key] = $value;
	}

	public function __get($key)
	{
		$this->_data[$key];
	}

	public function xhrOutput()
	{
		header( "Content-Type: application/json" );

		$this->json["err"] = 0;

		if( count( $this->errors ) > 0 ) {
			$this->json["err"] = 1;
			$this->json["message"] = implode("<br />", $this->errors);
			echo json_encode( $this->json );
		} else {
			echo json_encode( $this->json );
		}
		exit();
	}

	public function output()
	{
		if( !file_exists($this->_file) )
			throw new Exception("Template File: \"" . $this->_file . "\" doesn't exist.");

		extract($this->_data);
		unset($this->_data);

		include_once( APP . '/views/' . 'header.v.php' );
		if( count($this->errors) > 0 ) include_once( APP . '/views/' . 'error.v.php' );
		include_once( $this->_file );
		include_once( APP . '/views/' . 'footer.v.php' );
	}

}