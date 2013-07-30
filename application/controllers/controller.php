<?php

class Controller
{
	protected $_model;
	protected $_template;
	protected $_modelName;
	protected $_controllerName;
	protected $_action;

	public function __construct( $model, $action )
	{
		$this->_controllerName = ucwords( __CLASS__ );
		$this->_action = $action;
		$this->_modelName = $model;

		$this->_setTemplate( $action );
	}

	protected function _setModel( $modelName )
	{
		$modelName .= 'Model';
		$this->_model = new $modelName();
	}

	protected function _setTemplate( $action )
	{
		$this->_template = new Template(
			APP . '/views/' . strtolower( $this->_modelName ) . '/' . $action . '.v.php'
		);
	}

	protected function _isAjax( $action )
	{
		$headers = apache_request_headers();
		if( !isset($headers['X-CSRF-Token']) || empty($headers['X-CSRF-Token']) ) {
			return false;
		}

		return Utils::verifyCSRFToken( $headers['X-CSRF-Token'], $action );
	}
}