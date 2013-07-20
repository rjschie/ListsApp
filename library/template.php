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

	public function returnData( $data )
	{

	}

	public function output($data = false)
	{

		if( $data ) {
			echo $data;
			return;
		}

		if(!file_exists($this->_file))
		{
			throw new Exception("Template \"" . $this->_file . "\" doesn't exist.");
		}

		extract($this->_data);
		unset($this->_data);

		include(APP . DS . 'views' . DS . 'header.inc.php');
		include($this->_file);
		include(APP . DS . 'views' . DS . 'footer.inc.php');
	}

}