<?php

class Template
{
	protected $_file;
	protected $_data = array();

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

	// TODO Fix this area
	public function output($data = null)
	{

		if( !empty($data) ) {
			echo $data;
			return;
		}

		if( !file_exists($this->_file) )
		{
			throw new Exception("Template File: \"" . $this->_file . "\" doesn't exist.");
		}

		extract($this->_data);
		unset($this->_data);

		include_once( APP . '/views/' . 'header.v.php' );
		include_once( $this->_file );
		include_once( APP . '/views/' . 'footer.v.php' );
	}

}